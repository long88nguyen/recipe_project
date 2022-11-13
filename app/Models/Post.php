<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title','content','category_id','member_id','status','nutrition_facts','note','time'];

    public function Ingredients()
    {
        return $this->hasMany(Ingredient::class, 'post_id');
    }

    public function Directions()
    {
        return $this->hasMany(Direction::class, 'post_id');
    }

    public function PostImage()
    {
        return $this->hasMany(PostImage::class, 'post_id');
    }

    public function rates() {
        return $this->hasMany(Rate::class);
    }

   
}
