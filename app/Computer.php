<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Computer extends Model
{
    protected $fillable = ['name', 'mac', 'ip', 'broadcast', 'subnet', 'use_broadcast'];
}
