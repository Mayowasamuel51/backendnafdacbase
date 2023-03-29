<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupectInfo extends Model{
    use HasFactory;

    protected $primaryKey = 'id';
    
    protected $table = 'supect_infos';

  
    protected $guarded=[];
  
    public function postsuretys(){
        return $this->hasMany(SuretyInfo::class, 'user_id');
    }
}
