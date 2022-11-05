<?php
namespace App\WorkoutTypes\Levels;

class WalkersWorkouts implements \App\Interfaces\WorkoutLevelInterface
{
    private array $walkerWorkouts;

    public function __construct()
    {
        $this->walkerWorkouts = Workout::whereBetween('level', Client::WALKER_RANGE)->pluck('id')->toArray();
    }

    public function get()
    {
        if (empty($this->walkerWorkouts)) {
            return null;
        }

        return $this->walkerWorkouts[array_rand($this->walkerWorkouts)];
    }
}