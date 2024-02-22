<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiBaseFilter;

class UsersFilter extends ApiBaseFilter
{
    protected $allowedParms = [
        'name' => ['eq'],
        'email' => ['eq'],
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
    ];

}
