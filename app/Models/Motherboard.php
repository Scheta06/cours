<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Motherboard extends Model
{
    protected $fillable = [
        'title',
        'description',
        'vendor_id',
        'socket_id',
        'chipset_id',
        'memory_type_id',
        'form_id',
        'category_id',
    ];

    public function configuration() {
        return $this->hasMany(Configuration::class, 'motherboard_id');
    }

    public function vendor() {
        return $this->belongsTo(Vendor::class);
    }

    public function socket() {
        return $this->belongsTo(Socket::class);
    }

    public function chipset() {
        return $this->belongsTo(Chipset::class);
    }

    public function memoryType() {
        return $this->belongsTo(MemoryType::class);
    }

    public function form() {
        return $this->belongsTo(Form::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
