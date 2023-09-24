<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;

    protected $table = 'achievements';
    protected $primaryKey = 'achievement';
    public $incrementing = false;
    public $timestamps = false;
}
