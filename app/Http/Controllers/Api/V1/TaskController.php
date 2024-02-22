<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\TasksFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\StoreTaskRequest;
use App\Http\Requests\Api\V1\UpdateTaskRequest;
use App\Http\Resources\V1\TaskCollection;
use App\Http\Resources\V1\TaskResource;
use App\Models\Task;
use App\Models\User;
use App\Notifications\SendTaskCreatedEmail;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!auth()->user()->tokenCan('list-tasks')) {
            abort(403, 'Forbidden.');
        }
        $filter = new TasksFilter();
        $queryItems = $filter->transform($request);

        $includeUsers = $request->has('include_users');
        $tasks = Task::where($queryItems);
        if ($includeUsers) {
            $tasks = $tasks->with('users');
        }

        return new TaskCollection($tasks->paginate()->appends($request->query()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        if (!auth()->user()->tokenCan('store-task')) {
            abort(403, 'Forbidden.');
        }
        $task = Task::create($request->all());

        $userIds = $request->input('user_ids', []);

        $changes = $task->users()->sync($userIds);

        foreach ($changes['attached'] as $userId) {
            $user = User::find($userId);
            $user->notify(new SendTaskCreatedEmail($task));
        }

        return new TaskResource($task->load('users'));

    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        if (!auth()->user()->tokenCan('view-tasks')) {
            abort(403, 'Forbidden.');
        }
        return new TaskResource($task->load('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        if (!auth()->user()->tokenCan('update-tasks')) {
            if ($request->isMethod('PUT')) {
                abort(403, 'Forbidden.');
            } else {
                $task->status = $request->input('status');
                $task->save();
                return null;
            }
        }
        $task->update($request->all());
        $userIds = $request->input('user_ids', []);

        $changes = $task->users()->sync($userIds);

        foreach ($changes['attached'] as $userId) {
            $user = User::find($userId);
            $user->notify(new SendTaskCreatedEmail($task));
        }
        return new TaskResource($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        if (!auth()->user()->tokenCan('delete-task')) {
            abort(403, 'Forbidden.');
        }

        $task->delete();

        return response()->json(null, 204);
    }

    public function restore($taskId)
    {
        if (!auth()->user()->tokenCan('restore-task')) {
            abort(403, 'Forbidden.');
        }

        $task = Task::onlyTrashed()->where('id', $taskId)->firstOrFail();
        $task->restore();

        return new TaskResource($task);
    }
}
