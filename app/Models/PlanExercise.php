<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlanExercise extends Pivot
{
    //
    use HasFactory;

    protected $table = 'plan_exercises';
    protected $fillable = [
        'workout_id',
        'exercise_id',
        'sets',
        'reps',
        'weight',
        'duration',
        'notes',
    ];

    protected $casts = [
        'sets' => 'integer',
        'reps' => 'integer',
        'weight' => 'float',
        'duration' => 'integer',
    ];

    public function workout()
    {
        return $this->belongsTo(Workout::class);
    }

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }

}
