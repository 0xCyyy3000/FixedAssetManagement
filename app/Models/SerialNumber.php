<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SerialNumber extends Model
{
    use HasFactory;

    public function profile()
    {
        return $this->belongsTo(ItemProfile::class, 'reference_no');
    }
}
