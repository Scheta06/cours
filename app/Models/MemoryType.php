<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemoryType extends Model
{
    protected $fillable = [
        'title',
    ];

    public function rams() {
        return $this->hasMany(Rams::class, 'memory_type_id');
    }

    public function motherboard() {
        return $this->hasMany(Motherboard::class, 'memory_type_id');
    }
}
