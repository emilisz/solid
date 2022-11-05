<?php
namespace App\WorkoutTypes\Levels;

class IntermediateWorkouts implements \App\Interfaces\WorkoutLevelInterface
{
    private array $intermediateWorkouts;

    public function __construct()
    {
        $this->intermediateWorkouts = Workout::whereBetween('level', Client::INTERMEDIATE_RANGE)->pluck('id')->toArray();
    }

    public function get()
    {
        if (empty($this->intermediateWorkouts)) {
            return null;
        }

        return $this->intermediateWorkouts[array_rand($this->intermediateWorkouts)];
    }

}