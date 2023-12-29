<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailExtra extends Model
{
    use HasFactory;

    protected $fillable = [
        "extra_id",
        "gallery_id",
    ];

    public function extra()
    {
        return $this->belongsTo(Extra::class, 'extra_id');
    }

    public function gallery()
    {
        return $this->belongsTo(Gallery::class, 'gallery_id');
    }
}
