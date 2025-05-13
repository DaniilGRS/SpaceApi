<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LunarMissionRequest;
use App\Models\Mission;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class LunarMissionController extends Controller
{
    public function store(LunarMissionRequest $request)
    {
        $data = $request->validated()['mission'];
        
        $mission = new Mission([
            'name' => $data['name'],
            'launch_date' => $data['launch_details']['launch_date'],
            'launch_site_name' => $data['launch_details']['launch_site']['name'],
            'launch_site_latitude' => $data['launch_details']['launch_site']['location']['latitude'],
            'launch_site_longitude' => $data['launch_details']['launch_site']['location']['longitude'],
            'landing_date' => $data['landing_details']['landing_date'],
            'landing_site_name' => $data['landing_details']['landing_site']['name'],
            'landing_site_latitude' => $data['landing_details']['landing_site']['coordinates']['latitude'],
            'landing_site_longitude' => $data['landing_details']['landing_site']['coordinates']['longitude'],
            'spacecraft_id' => $data['spacecraft_id'],
        ]);
        
        $mission->save();
        
        return response()->json([
            'data' => [
                'code' => 201,
                'message' => 'Миссия добавлена',
                'mission_id' => $mission->id
            ]
        ], 201);
    }
    
    public function show($id)
    {
        try {
            $mission = Mission::with('space_crafts.crews')->findOrFail($id);
            
            return response()->json([
                'data' => [
                    'mission' => [
                        'name' => $mission->name,
                        'launch_details' => [
                            'launch_date' => $mission->launch_date,
                            'launch_site' => [
                                'name' => $mission->launch_site_name,
                                'location' => [
                                    'latitude' => (float) $mission->launch_site_latitude,
                                    'longitude' => (float) $mission->launch_site_longitude,
                                ]
                            ]
                        ],
                        'landing_details' => [
                            'landing_date' => $mission->landing_date,
                            'landing_site' => [
                                'name' => $mission->landing_site_name,
                                'coordinates' => [
                                    'latitude' => (float) $mission->landing_site_latitude,
                                    'longitude' => (float) $mission->landing_site_longitude,
                                ]
                            ]
                        ],
                        'space_crafts' => [
                            'command_module' => $mission->space_crafts->command_module,
                            'lunar_module' => $mission->space_crafts->lunar_module,
                            'crews' => $mission->space_crafts->crews->map(function ($member) {
                                return [
                                    'name' => $member->name,
                                    'role' => $member->role
                                ];
                            })
                        ]
                    ]
                ]
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => [
                    'code' => 404,
                    'message' => 'Миссия не найдена'
                ]
            ], 404);
        }
    }
    
    public function update(LunarMissionRequest $request, $id)
    {
        try {
            $mission = Mission::findOrFail($id);
            $data = $request->validated()['mission'];
            
            $mission->update([
                'name' => $data['name'],
                'launch_date' => $data['launch_details']['launch_date'],
                'launch_site_name' => $data['launch_details']['launch_site']['name'],
                'launch_site_latitude' => $data['launch_details']['launch_site']['location']['latitude'],
                'launch_site_longitude' => $data['launch_details']['launch_site']['location']['longitude'],
                'landing_date' => $data['landing_details']['landing_date'],
                'landing_site_name' => $data['landing_details']['landing_site']['name'],
                'landing_site_latitude' => $data['landing_details']['landing_site']['coordinates']['latitude'],
                'landing_site_longitude' => $data['landing_details']['landing_site']['coordinates']['longitude'],
                'spacecraft_id' => $data['spacecraft_id'],
            ]);
            
            return response()->json([
                'data' => [
                    'code' => 200,
                    'message' => 'Миссия обновлена'
                ]
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => [
                    'code' => 404,
                    'message' => 'Миссия не найдена'
                ]
            ], 404);
        }
    }
    
    public function destroy($id)
    {
        try {
            $mission = Mission::findOrFail($id);
            $mission->delete();
            
            return response()->json(null, 204);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => [
                    'code' => 404,
                    'message' => 'Миссия не найдена'
                ]
            ], 404);
        }
    }
}
