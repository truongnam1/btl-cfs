<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as ModelMongo;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Book extends ModelMongo
{
    use HasFactory,SoftDeletes;
    protected $connection = 'mongodb';
    protected $fillable =["name",'deleted_at','post_id','question','anwser_content','list_vote'];
    protected $dates = ['deleted_at'];
}
