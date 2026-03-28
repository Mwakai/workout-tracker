<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workout extends Model
{
    //
    use HasFactory;

    protected $fillable = [
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
