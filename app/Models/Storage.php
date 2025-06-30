<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Storage extends Model
{
    protected $fillable = [
        'title',
        'description',
        'read_speed',
        'record_speed',
        'category_id',
        'vendor_id',
        'memory_capacity_id',
    ];

    public function configuration() {
        return $this->hasMany(Configuration::class, 'storage_id');
    }

    public function vendor() {
        return $this->belongsTo(Vendor::class);
    }

    public function memoryCapacity() {
        return $this->belongsTo(MemoryCapacity::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
