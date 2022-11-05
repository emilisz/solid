<?php
namespace App\WorkoutTypes\Levels;

class ProWorkouts implements \App\Interfaces\WorkoutLevelInterface
{
    private array $proWorkouts;

    public function __construct()
    {
        $this->proWorkouts = Workout::whereBetween('level', Client::PRO_RANGE)->pluck('id')->toArray();
    }

    public function get()
    {
        if (empty($this->proWorkouts)) {
            return null;
        }

        return $this->proWorkouts[array_rand($this->proWorkouts)];
    }
}