<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class area extends Model
{
    protected $fillable = [
        'area_name'
    ];
    use HasFactory;
    public function membership()
    {
        return $this->hasMany(membership::class);
    }
}
