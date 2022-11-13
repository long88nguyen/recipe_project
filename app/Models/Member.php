<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = ['id','user_id','name','phone','gender','birtday','image'];

    public function Posts()
    {
        return $this->hasMany(Post::class, 'member_id');
    }
}
