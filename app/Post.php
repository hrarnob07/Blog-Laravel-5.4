<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
   protected $fillable=['user_id','post_title','post_body','category_id','post_image'];
}
