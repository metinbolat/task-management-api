<?php

namespace App\Filters\V1;

use App\Filters\ApiBaseFilter;
class TasksFilter extends ApiBaseFilter
{
    protected $allowedParms = [
        'title' => ['eq'],
        'body' => ['eq'],
        'status' => ['eq', 'ne'],
        'assigned_date' => ['eq', 'lt', 'gt', 'lte', 'gte'],
        'due_date' => ['eq', 'lt', 'gt', 'lte', 'gte'],
        'completed_date' => ['eq', 'lt', 'gt', 'lte', 'gte'],
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
        'ne' => '!=',
    ];

}
