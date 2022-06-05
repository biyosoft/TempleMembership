<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment extends Model
{

    protected $fillable = [
        'customer_id',
        'item_code_id'
    ];
    use HasFactory;

    public function membership(){
        return $this->hasMany(membership::class);
    }

   

}
