<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LunarMissionRequest extends FormRequest
{

    public function rules()
    {
        return [
            'mission.name' => 'required|string',
            'mission.launch_details.launch_date' => 'required|date',
            'mission.launch_details.launch_site.name' => 'required|string',
            'mission.launch_details.launch_site.location.latitude' => 'required|numeric',
            'mission.launch_details.launch_site.location.longitude' => 'required|numeric',
            'mission.landing_details.landing_date' => 'required|date',
            'mission.landing_details.landing_site.name' => 'required|string',
            'mission.landing_details.landing_site.coordinates.latitude' => 'required|numeric',
            'mission.landing_details.landing_site.coordinates.longitude' => 'required|numeric',
            'mission.spacecraft_id' => 'required|exists:space_crafts,id',
        ];
    }
}