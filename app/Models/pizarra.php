<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pizarra extends Model
{
    use HasFactory;
    protected $table='pizarras';
    protected $guarded=[
        'id',
        'created_at',
        'updated_at',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }
}
