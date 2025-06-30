<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemoryCapacity extends Model
{
    protected $fillable = [
        'title',
    ];

    public function storage() {
        return $this->hasMany(Storage::class, 'memory_capacity_id');
    }

    public function rams() {
        return $this->hasMany(Rams::class, 'memory_capacity_id');
    }

    public function videocard() {
        return $this->hasMany(Videocard::class, 'memory_capacity_id');
    }
}
