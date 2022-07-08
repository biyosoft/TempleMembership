<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sync extends Model
{
    protected $fillable = [
        'status'
    ];
    use HasFactory;
}
