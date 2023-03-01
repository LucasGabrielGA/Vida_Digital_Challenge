<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public $incrementing = false;
    public $timestamps = false;

    protected $table = "empresa";
    protected $primaryKey = "cuit";
}
