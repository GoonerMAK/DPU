<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCRC extends Model
{
    use HasFactory;

    protected $table = 'sub_crc';
    protected $primaryKey = 'sub_crc_id';
    public $incrementing = false;
    public $timestamps = false;
}
