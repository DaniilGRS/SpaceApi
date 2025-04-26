<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'launch_details_id',
        'landing_details_id',
        'spacecraft_id',
    ];

    public function launchDetails()
    {
        return $this->belongsTo(LaunchDetails::class);
    }

    public function landingDetails()
    {
        return $this->belongsTo(LandingDetails::class);
    }

    public function spacecraft()
    {
        return $this->belongsTo(Spacecraft::class);
    }
}
