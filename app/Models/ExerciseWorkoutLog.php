<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ExerciseWorkoutLog extends Pivot
{
    //
     protected $table = 'exercises_workout_logs';

    protected $fillable = [
        'workout_log_id',
        'exercise_id',
        'sets_completed',
        'reps_completed',
        'weight',
        'duration',
    ];

    public function workoutLog()
    {
        return $this->belongsTo(WorkoutLog::class);
    }

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }
}
