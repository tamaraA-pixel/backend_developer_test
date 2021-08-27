<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class request_status extends Model
{
    use HasFactory;
    protected $table = 'request_status';
    protected $primaryKey = 'request_status_id';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;
}
