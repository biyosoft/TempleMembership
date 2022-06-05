<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    protected $fillable = [
        'title',
        'year',
        'amount'
    ];
    use HasFactory;
    public function membership(){
        return $this->hasMany(membership::class);
    }
}
