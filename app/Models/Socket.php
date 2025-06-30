<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Socket extends Model
{
    protected $fillable = [
        'title',
    ];

    public function processor() {
        return $this->hasMany(Configuration::class, 'socket_id');
    }

    public function motherboard() {
        return $this->hasMany(Motherboard::class, 'motherboard_id');
    }
}
