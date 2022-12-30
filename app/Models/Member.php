<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Member extends Model
{
    use HasFactory;

    protected $fillable = ['id','user_id','name','phone','gender','birthday','avatar'];

    public function Posts()
    {
        return $this->hasMany(Post::class, 'member_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
    return $date->format('Y-m-d H:i:s');
    }
}
