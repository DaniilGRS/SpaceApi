<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Crew;
use App\Models\SpaceCraft;
use Illuminate\Http\Request;

class SpaceCraftController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'spacecraft.command_module' => 'required',
            'spacecraft.lunar_module' => 'required',
            'spacecraft.crew' => 'required|array',
            'spacecraft.crew.*.name' => 'required',
            'spacecraft.crew.*.role' => 'required',
        ]);

        $spacecraft = SpaceCraft::create([
            'command_module' => $request['spacecraft']['command_module'],
            'lunar_module' => $request['spacecraft']['lunar_module'],
        ]);

        foreach($request['spacecraft']['crew'] as $crewMember){
            Crew::create([
                'spacecraft_id' => $spacecraft->id,
                'name'=>$crewMember['name'],
                'role'=>$crewMember['role'],
            ]);
        }

        return response()->json([
            'code' => 201,
            'message' =>'Корабль добавлен'
        ], 201);
    }

    public function destroy($id)
    {
        SpaceCraft::destroy($id);
        Crew::where('spacecraft_id', $id)->delete();
        return response()->json([], 204);  
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'spacecraft.command_module' => 'required',
            'spacecraft.lunar_module' => 'required',
            'spacecraft.crew' => 'required|array',
            'spacecraft.crew.*.name' => 'required',
            'spacecraft.crew.*.role' => 'required',
        ]);

        $spacecraft = SpaceCraft::findOrFail($id);

        $spacecraft->update([
            'command_module' => $request['spacecraft']['command_module'],
            'lunar_module' => $request['spacecraft']['lunar_module'],
        ]);

        $spacecraft->crews()->delete();

        foreach($validated['spacecraft']['crew'] as $crewMember){
            Crew::create([
                'spacecraft_id' => $spacecraft->id,
                'name'=>$crewMember['name'],
                'role'=>$crewMember['role'],
            ]);
        }
        return response()->json([
            'code'=>200,
            'message'=>'Корабль обновлен'
        ], 200);

    }

    public function show($id)
    {
        $spacecraft = SpaceCraft::with('crews')->findOrFail($id);
        return response()->json([$spacecraft], 200);

    }
    
}