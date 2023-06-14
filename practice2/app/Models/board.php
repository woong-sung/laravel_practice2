<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class board extends Model
{
    use HasFactory;
    // 대량 할당이 가능하도록 하는 것
    // $fillable 은 입력이 가능한 컬럼을 지정
    // $guarded 는 입력이 불가능한 컬럼을 지정
    // 동시사용 불가

    protected $fillable = [
        'title', 'content', 'user_id', 'user_name'
    ];

}
