<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Processor extends Model
{
    protected $fillable = [
        'title',
        'description',
        'count_of_cores',
        'count_of_streams',
        'base_frequency',
        'max_frequency',
        'tdp',
        'category_id',
        'vendor_id',
        'socket_id',
    ];

    public function configuration() {
        return $this->hasMany(Configuration::class, 'processor_id');
    }

    public function vendor() {
        return $this->belongsTo(Vendor::class);
    }

    public function socket() {
        return $this->belongsTo(Socket::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
