<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exercise extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category',
        'muscle_group',
    ];

    public function workouts()
    {
        return $this->belongsToMany(Workout::class, 'plan_exercises')
            ->using(PlanExercise::class)
            ->withPivot([
                'order_index',
                'sets',
                'reps',
                'weight',
                'duration',
                'notes'
            ])
            ->withTimestamps();
    }

    public function workoutLogs()
    {
        return $this->belongsToMany(WorkoutLog::class, 'exercise_workout_logs')
                    ->withPivot('sets_completed', 'reps_completed', 'weight', 'duration')
                    ->withTimestamps();
    }
}
