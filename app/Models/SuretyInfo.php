<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuretyInfo extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'surety_infos';
    protected $guarded=[];

    
    
    public function manysurety(){
        return $this->belongsTo(SupectInfo::class, 'user_id');
    }
}
