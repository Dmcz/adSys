<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionResults extends Model
{
    /**
     * 应该被转化为原生类型的属性
     *
     * @var array
     */
    protected $casts = [
        'content' => 'array',
    ];
}
