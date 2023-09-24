<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubExpenditure extends Model
{
    use HasFactory;

    protected $table = 'sub_exp';
    protected $primaryKey = 'sub_exp_code';
    public $incrementing = false;
    public $timestamps = false;
}
