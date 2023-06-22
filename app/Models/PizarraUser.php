<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PizarraUser extends Model
{
    use HasFactory;
    protected $table='pizarra_users';
    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function pizarra(){
        return $this->belongsTo(pizarra::class);
    }
}
