<?php

namespace App;

#use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model;

class Dataset extends Model
{
    //
    protected $fillable = ['name','file','type'];
}
