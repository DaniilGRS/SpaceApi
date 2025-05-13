<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crew extends Model
{
    use HasFactory;

    protected $fillable = [
        'spacecraft_id',
        'name',
        'role',
    ];

    public function space_crafts()
    {
        return $this->belongsTo(SpaceCraft::class);
    }
}
