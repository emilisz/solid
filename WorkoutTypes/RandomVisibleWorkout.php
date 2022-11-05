<?php
namespace App\WorkoutTypes;
use App\Interfaces\WorkoutTypeInterface;
use App\Workout;
use RuntimeException;

class RandomVisibleWorkout implements WorkoutTypeInterface
{
    public function getOne()
    {
        $workout = Workout::where('is_visible', true)->inRandomOrder()->first();
        if (! $workout) {
            throw new RuntimeException('No workout has been found');
        }
        return $workout;
    }
}