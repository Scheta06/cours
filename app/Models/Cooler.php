<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cooler extends Model
{
    protected $fillable = [
        'title',
        'description',
        'power',
        'category_id',
        'vendor_id',
    ];

    public function configuration() {
        return $this->hasMany(Configuration::class, 'cooler_id');
    }

    public function vendor() {
        return $this->belongsTo(Vendor::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
