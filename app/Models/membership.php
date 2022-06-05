<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class membership extends Model
{
    use HasFactory;
    protected $fillable = [
        'gvBrowseCode',
        'gvBrowseCompanyName',
        'gvBrowseAttention',
        'gvBrowseUDF_TEMPATLAHIR',
        'gvBrowseUDF_ICNO',
        'gvBrowsePhone1',
        'gvBrowseAddress1',
        'gvBrowseArea',
        'gvBrowseUDF_DOB',
        'gvBrowseUDF_NOAHLISKMC',
        'gvBrowseUDF_TARIKHMEMOHON',
        'gvBrowseUDF_PEKERJAAN',
        'gvBrowseUDF_JANTINA',
        'item_id',
    ];
    public function item(){
        return $this->belongsTo(item::class);
    }
    public function payment(){
        return $this->belongsToMany(payment::class);
    }
}
