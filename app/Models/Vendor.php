<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
        'title'
    ];

    public function processor() {
        return $this->hasMany(Processor::class, 'vendor_id');
    }

    public function motherboard() {
        return $this->hasMany(Motherboard::class, 'vendor_id');
    }

    public function cooler() {
        return $this->hasMany(Cooler::class, 'vendor_id');
    }

    public function rams() {
        return $this->hasMany(Rams::class, 'vendor_id');
    }

    public function storage() {
        return $this->hasMany(Storage::class, 'vendor_id');
    }

    public function videocard() {
        return $this->hasMany(Videocard::class, 'vendor_id');
    }

    public function psu() {
        return $this->hasMany(Psu::class, 'vendor_id');
    }

    public function chassis() {
        return $this->hasMany(Chassis::class, 'vendor_id');
    }
}
