<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chipset extends Model
{
    protected $fillable = [
        'title',
    ];

    public function motherboard() {
        return $this->hasMany(Configuration::class, 'chipset_id');
    }
}
