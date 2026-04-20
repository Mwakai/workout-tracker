<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Workout extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scheduledWorkouts()
    {
        return $this->hasMany(ScheduledWorkout::class);
    }

    public function exercises()
    {
        return $this->belongsToMany(Exercise::class, 'plan_exercises')
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
}
