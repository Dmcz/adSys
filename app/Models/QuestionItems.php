<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionItems extends Model
{
    use SoftDeletes;

    const STATUS_SHOW = 0;
    const STATUS_HIDE = 1;
    const STATUS_TEXT = [
        self::STATUS_SHOW => '显示',
        self::STATUS_HIDE => '隐藏',
    ];
    const STATUS_LABEL = [
        self::STATUS_SHOW => 'primary',
        self::STATUS_HIDE => 'default',
    ];

    protected $fillable = ['title', 'value', 'status'];

    public function question()
    {
        return $this->belongsTo(Questions::class, 'question_id');
    }

    
}
