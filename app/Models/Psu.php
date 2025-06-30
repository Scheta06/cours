<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Psu extends Model
{
    protected $fillable = [
        'title',
        'description',
        'power',
        'vendor_id',
        'category_id',
        'form_id',
    ];

    public function configuration()
    {
        return $this->hasMany(Configuration::class, 'psu_id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
