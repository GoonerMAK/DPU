<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'project';
    protected $primaryKey = 'project_id';
    public $incrementing = false;
    public $timestamps = false;

    public function sub_crc()
    {
        return $this->belongsTo(SubCRC::class, 'sub_crc_id', 'sub_crc_id');
    }
    
    
}
