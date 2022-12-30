<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name','image'];

    protected function serializeDate(DateTimeInterface $date)
    {
    return $date->format('Y-m-d H:i:s');
    }

    public function Posts(){
        return $this->hasMany(Post::class,"category_id");
    }
}
