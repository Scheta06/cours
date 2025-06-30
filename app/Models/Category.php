<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'title',
        'type'
    ];

    public function processor() {
        return $this->hasMany(Processor::class, 'category_id');
    }

    public function motherboard() {
        return $this->hasMany(Motherboard::class, 'category_id');
    }

    public function cooler() {
        return $this->hasMany(Cooler::class, 'category_id');
    }

    public function storage() {
        return $this->hasMany(Storage::class, 'category_id');
    }

    public function videocard() {
        return $this->hasMany(Videocard::class, 'category_id');
    }

    public function ram() {
        return $this->hasMany(Rams::class, 'category_id');
    }

    public function psu() {
        return $this->hasMany(Psu::class, 'category_id');
    }

    public function chassis() {
        return $this->hasMany(Chassis::class, 'category_id');
    }
}
