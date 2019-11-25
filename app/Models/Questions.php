<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Questions extends Model
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

    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function item()
    {
        return $this->hasMany(QuestionItems::class, 'question_id');
    }

    public static function buildNo()
    {
        while(true){
            $random = Str::random('10');
            if(empty(static::where('no', $random)->first())){
                break;
            }
        }
        
        return $random;
    }
}
