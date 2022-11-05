<?php
namespace App\WorkoutTypes;
use App\Interfaces\WorkoutTypeInterface;
use App\Workout;
use RuntimeException;

class RandomWorkout implements WorkoutTypeInterface
{
    public function getOne()
    {
        $workout = Workout::inRandomOrder()->first();
        if (! $workout) {
            throw new RuntimeException('No workout has been found');
        }
        return $workout;
    }

}
