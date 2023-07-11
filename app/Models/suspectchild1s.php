<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class suspectchild1s extends Model
{
    use HasFactory;
    protected $fillable=[
        'child_id',
        'child1_name',
        'child1_address' ,
        'child1_birth' ,
        'child1_phone' ,
        'child1_res_address',
        'martic_number'
    ];
}
