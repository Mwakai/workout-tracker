<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WorkoutLog extends Model
{
    //
    use HasFactory;
    protected $fillable = [
        'scheduled_workout_id',
        'started_at',
        'completed_at',
        'notes',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function scheduledWorkout()
    {
        return $this->belongsTo(ScheduledWorkout::class);
    }

    public function exercises()
    {
        return $this->belongsToMany(Exercise::class, 'exercise_workouts_logs')
                    ->withPivot([
                        'sets_completed',
                        'reps_completed',
                        'weight',
                        'duration'
                    ])
                    ->withTimestamps();
    }
}
