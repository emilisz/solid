<?php


namespace App\WorkoutTypes;

use App\Interfaces\WorkoutTypeInterface;
use App\WorkoutTypes\Levels\AdvancedWorkouts;
use App\WorkoutTypes\Levels\BeginnersWorkouts;
use App\WorkoutTypes\Levels\IntermediateWorkouts;
use App\WorkoutTypes\Levels\ProWorkouts;
use App\WorkoutTypes\Levels\WalkersWorkouts;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use App\Client;
use App\Workout;


class WorkoutByScore implements WorkoutTypeInterface
{
    public function __construct(protected int $score)
    {
        if (!Schema::hasTable('workouts')) {
            return;
        }

    }

    public function getOne(): ?Workout
    {
        $id = $this->getWorkoutIdByScore();
        if (!$id) {
            return null;
        }

        return Workout::find($id);
    }

    public function getWorkoutIdByScore(): ?int
    {
        if (Client::BEGINNER_RANGE[0] <= $this->score && $this->score <= Client::BEGINNER_RANGE[1]) {
            return (new BeginnersWorkouts())->get();
        }

        if (Client::INTERMEDIATE_RANGE[0] <= $this->score && $this->score <= Client::INTERMEDIATE_RANGE[1]) {
            return (new IntermediateWorkouts())->get();
        }
        if (Client::ADVANCED_RANGE[0] <= $this->score && $this->score <= Client::ADVANCED_RANGE[1]) {
            return (new AdvancedWorkouts())->get();
        }

        if (Client::PRO_RANGE[0] <= $this->score && $this->score <= Client::PRO_RANGE[1]) {
            return (new ProWorkouts())->get();
        }

        return (new WalkersWorkouts())->get();
    }


}