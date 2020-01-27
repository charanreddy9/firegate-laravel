<?php

namespace App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;

class Parent extends Model
{
     protected $fillable =['name','gender','mobile','otp','noadults','person','purpose','events','comment','pic'];
    public $timestamps = false;
    protected $table = 'parent';
    protected $primaryKey = 'id';
}
