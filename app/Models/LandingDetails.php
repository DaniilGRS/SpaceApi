<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'landing_date',
        'landing_site_id',
    ];

    public function landingSite()
    {
        return $this->belongsTo(LandingSite::class);
    }

}
