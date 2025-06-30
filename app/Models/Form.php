<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $fillable = [
        'title',
    ];

    public function motherboard() {
        return $this->hasMany(Motherboard::class, 'form_id');
    }

    public function chassis() {
        return $this->hasMany(Chassis::class, 'form_id');
    }

    public function psu() {
        return $this->hasMany(Psu::class, 'form_id');
    }
}
