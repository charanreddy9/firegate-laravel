<?php

namespace App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;

class Adhoc extends Model
{
     protected $fillable =['name','gender','mobile','otp','noadults','person','purpose','events','comment'];
    public $timestamps = true;
    protected $table = 'adhoc';
    protected $primaryKey = 'id';
}
