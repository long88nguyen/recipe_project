<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Rate extends Model
{
    use HasFactory;

    protected $fillable = ['post_id','member_id','number_rating','review'];

    protected function serializeDate(DateTimeInterface $date)
    {
    return $date->format('Y-m-d H:i:s');
    }

    public function member(){
        return $this->belongsTo(Member::class ,  "member_id");
    }

    public function post(){
        return $this->belongsTo(Post::class ,  "post_id");
    }
}
