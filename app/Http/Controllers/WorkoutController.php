<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    //
    // Get the active workout for the user list active/pending sorted by scheduled date
    public function index() {
        $user = auth()->user();
        $workouts = $user->workouts()
                        ->with('scheduledWorkouts')
                        ->get()
                        ->sortBy(function($workout) {
                            return $workout->scheduledWorkouts->min('scheduled_date') ?? now()->addYears(10);
                        });
        return response()->json($workouts);
    }

    public function store(Request $request) {
        $user = auth()->user();
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:strength,cardio,mobility',
        ]);

        $workout = $user->workouts()->create($data);
        return response()->json($workout, 201);
    }

    public function show($id) {
        $user = auth()->user();
        $workout = $user->workouts()->with('exercises')->findOrFail($id);
        return response()->json($workout);
    }

    public function update(Request $request, $id) {
        $user = auth()->user();
        $workout = $user->workouts()->findOrFail($id);

        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'sometimes|required|in:strength,cardio,mobility',
        ]);

        $workout->update($data);
        return response()->json($workout);
    }

    public function destroy($id) {
        $user = auth()->user();
        $workout = $user->workouts()->findOrFail($id);
        $workout->delete();
        return response()->json(null, 204);
    }
}
