<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chassis extends Model
{
    protected $fillable = [
        'title',
        'description',
        'vendor_id',
        'category_id',
        'form_id',
    ];

    public function configuration() {
        return $this->hasMany(Configuration::class);
    }

    public function vendor() {
        return $this->belongsTo(Vendor::class);
    }

    public function form() {
        return $this->belongsTo(Form::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
