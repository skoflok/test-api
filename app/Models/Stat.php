<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    use HasFactory;

    protected $fillable = ['page_uuid'];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
