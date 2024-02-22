<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\UsersFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\V1\UserCollection;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!auth()->user()->tokenCan('list-users')) {
            abort(403, 'Forbidden.');
        }
        $filter = new UsersFilter();
        $queryItems = $filter->transform($request);

        $tasks = $request->query('include_tasks');
        $users = User::where($queryItems);
        if ($tasks) {
            $users = $users->with('tasks');
        }

        return new UserCollection($users->paginate()->appends($request->query()));
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        if (!auth()->user()->tokenCan('view-users')) {
            abort(403, 'Forbidden.');
        }

        return new UserResource($user->load('tasks'));
    }

}
