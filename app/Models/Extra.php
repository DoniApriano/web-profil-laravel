<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extra extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "description",
        "image",
        "slug",
    ];

    public function detailExtra()
    {
        return $this->hasOne(DetailExtra::class, 'extra_id');
    }
}
