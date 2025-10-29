<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
  protected $table = 'users';
  public $timestamps = false;
  public static function listUsers()
  {
    return self::all();
  }
}
