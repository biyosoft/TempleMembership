<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class item extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'title',
        'year',
        'amount'
    ];
    use HasFactory;
    public function membership()
    {
        return $this->hasMany(membership::class);
    }
}
