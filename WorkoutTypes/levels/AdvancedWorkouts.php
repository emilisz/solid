<?php
namespace App\WorkoutTypes\Levels;

class AdvancedWorkouts implements \App\Interfaces\WorkoutLevelInterface
{
    private array $advancedWorkouts;

    public function __construct()
    {
        $this->advancedWorkouts = Workout::whereBetween('level', Client::ADVANCED_RANGE)->pluck('id')->toArray();
    }

    public function get()
    {
        if (empty($this->advancedWorkouts)) {
            return null;
        }

        return $this->advancedWorkouts[array_rand($this->advancedWorkouts)];
    }
}