<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $exercises = [
            // Strength - Chest
            [
                'name'         => 'Bench Press',
                'description'  => 'A compound exercise where you press a barbell upward while lying on a bench.',
                'category'     => 'strength',
                'muscle_group' => 'chest',
            ],
            [
                'name'         => 'Push Up',
                'description'  => 'A bodyweight exercise that works the chest, shoulders, and triceps.',
                'category'     => 'strength',
                'muscle_group' => 'chest',
            ],

            // Strength - Back
            [
                'name'         => 'Pull Up',
                'description'  => 'A bodyweight exercise where you pull yourself up to a bar, targeting the lats.',
                'category'     => 'strength',
                'muscle_group' => 'back',
            ],
            [
                'name'         => 'Deadlift',
                'description'  => 'A compound lift where you pull a barbell from the floor to hip level.',
                'category'     => 'strength',
                'muscle_group' => 'back',
            ],

            // Strength - Legs
            [
                'name'         => 'Squat',
                'description'  => 'A compound lower body exercise targeting quads, hamstrings, and glutes.',
                'category'     => 'strength',
                'muscle_group' => 'legs',
            ],
            [
                'name'         => 'Lunges',
                'description'  => 'A unilateral leg exercise targeting quads and glutes.',
                'category'     => 'strength',
                'muscle_group' => 'legs',
            ],

            // Strength - Core
            [
                'name'         => 'Plank',
                'description'  => 'An isometric core exercise that builds stability and endurance.',
                'category'     => 'strength',
                'muscle_group' => 'core',
            ],
            [
                'name'         => 'Sit Up',
                'description'  => 'A core exercise that targets the abdominal muscles.',
                'category'     => 'strength',
                'muscle_group' => 'core',
            ],

            // Cardio
            [
                'name'         => 'Running',
                'description'  => 'A cardiovascular exercise that improves endurance and burns calories.',
                'category'     => 'cardio',
                'muscle_group' => 'core',
            ],
            [
                'name'         => 'Jump Rope',
                'description'  => 'A high intensity cardio exercise that improves coordination and endurance.',
                'category'     => 'cardio',
                'muscle_group' => 'core',
            ],
            [
                'name'         => 'Cycling',
                'description'  => 'A low-impact cardio exercise targeting the legs and cardiovascular system.',
                'category'     => 'cardio',
                'muscle_group' => 'legs',
            ],

            // Flexibility
            [
                'name'         => 'Yoga - Downward Dog',
                'description'  => 'A yoga pose that stretches the hamstrings, calves, and shoulders.',
                'category'     => 'flexibility',
                'muscle_group' => 'core',
            ],
            [
                'name'         => 'Hip Flexor Stretch',
                'description'  => 'A stretch targeting the hip flexors, useful for people who sit for long periods.',
                'category'     => 'flexibility',
                'muscle_group' => 'legs',
            ],
        ];

        foreach ($exercises as $exercise) {
            \App\Models\Exercise::create($exercise);
        }
        DB::table('exercises')->insert($exercises);
    }
}
