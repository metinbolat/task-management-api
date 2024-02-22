<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'title',
        'body',
        'status',
        'assigned_date',
        'due_date',
        'completed_date',
    ];

    protected $dates = ['deleted_at'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
