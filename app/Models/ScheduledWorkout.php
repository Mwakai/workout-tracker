<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ScheduledWorkout extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'user_id',
        'workout_id',
        'status',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function workout()
    {
        return $this->belongsTo(Workout::class);
    }

    public function workoutLog() {
        return $this->hasOne(WorkoutLog::class);
    }

    // Trait status cast to php enum
    // protected $casts = [
    //     'status' => ScheduledWorkoutStatus::class,
    // ];
}
