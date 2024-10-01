<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;
    //table name employe
    protected $table = 'employe';

    //mass assignment
    //protected $fillable = ['name', 'email', 'phone', 'address',];

}
