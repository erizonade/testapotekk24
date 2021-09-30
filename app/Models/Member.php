<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Member extends Authenticatable
{
    use Notifiable;
    protected $table      = "members";
    protected $primaryKey = "id";

    public $timetamps = false;
}
