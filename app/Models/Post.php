<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory,SoftDeletes;
    protected $connection = 'mongodb';
    protected $collection = 'posts';
    protected $dates = ['deleted_at'];

    protected $fillable = ["title", 'content', 'user_id','access_level', 'tags', 'reacts', 'comments','views'];


}
