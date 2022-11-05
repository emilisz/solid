<?php


namespace App\WorkoutTypes;

use App\Interfaces\WorkoutTypeInterface;
use App\WorkoutPlan;

class WorkoutByVersion implements WorkoutTypeInterface
{
    protected int $version;

    public function __construct(int $version, protected int $score, protected int $workoutCount = 0)
    {
        $this->version = $version === 1 ? null : $version;
    }

    public function query()
    {
        return WorkoutPlan::where('training_plan->version', $this->version)
            ->where('running_level', $this->score);
    }


    /**
     * @return Collection|WorkoutPlan[]
     */
    public function getAll(): Collection
    {
        return $this->query()
            ->where('workout_count', $this->workoutCount)
            ->get();
    }

    public function getOne(): ?WorkoutPlan
    {
        return $this->query()
            ->where('workout_count', $this->workoutCount)
            ->first();
    }

    public function getByVersionAndScore(): ?WorkoutPlan
    {
        return $this->query()
            ->first();
    }

    public function getByVersionAndCount(): ?WorkoutPlan
    {
        return $this->query()
            ->first();
    }
}