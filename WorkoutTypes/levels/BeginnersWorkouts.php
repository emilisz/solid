<?php

namespace App\WorkoutTypes\Levels;


class BeginnersWorkouts implements \App\Interfaces\WorkoutLevelInterface
{
    private array $beginnerWorkouts;

    public function __construct()
    {
        $this->beginnerWorkouts = Workout::whereBetween('level', Client::BEGINNER_RANGE)->pluck('id')->toArray();
    }

    public function get()
    {
        if (empty($this->beginnerWorkouts)) {
            return null;
        }

        return $this->beginnerWorkouts[array_rand($this->beginnerWorkouts)];
    }

}