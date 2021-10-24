<?php

namespace App\Models;

use App\Models\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory, HasUuid;

    public $incrementing = false;
    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    protected $fillable = ['title'];

    public function stats()
    {
        return $this->hasMany(Stat::class);
    }
}
