<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CRC extends Model
{
    use HasFactory;

    protected $table = 'crc';
    protected $primaryKey = 'crc_id';
    public $incrementing = false;
    public $timestamps = false;
}
