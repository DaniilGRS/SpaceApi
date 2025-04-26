<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crew extends Model
{
    use HasFactory;

    public function spacecraft()
    {
        return $this->belongsTo(SpaceCraft::class);
    }

    protected $fillable = [
        'spacecraft_id',
        'name',
        'role',
    ];

}
