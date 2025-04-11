<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    protected $fillable = [
        'name',
    ];

    public function User(){
        return $this->belongsToMany(User::class);
    }
}
