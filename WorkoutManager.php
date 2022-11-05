<?php

declare(strict_types=1);

namespace App\Services;

use App\Client;
use App\Workout;
use App\WorkoutPlan;
use App\WorkoutTypes\RandomVisibleWorkout;
use App\WorkoutTypes\RandomWorkout;
use App\WorkoutTypes\WorkoutByScore;
use App\WorkoutTypes\WorkoutByVersion;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;


/**
 * Class TipManager
 *
 * @package App\Services
 */
class WorkoutManager
{

    public function getRandomWorkout(): RandomWorkout
    {
        return (new RandomWorkout())->getOne();
    }

    public function getRandomVisibleWorkout(): RandomVisibleWorkout
    {
        return (new RandomVisibleWorkout())->getOne();
    }

    public function getWorkoutByScore(int $score): ?Workout
    {
       return (new WorkoutByScore($score))->getOne();
    }

    public function getOneByVersionScoreAndCount(int $version, int $score, int $workoutCount): ?WorkoutPlan
    {
        return (new WorkoutByVersion($version, $score, $workoutCount))->getOne();
    }

    /**
     * @return Collection|WorkoutPlan[]
     */
    public function getAllByVersionScoreAndCount(int $version, int $score, int $workoutCount): Collection
    {
        return (new WorkoutByVersion($version, $score, $workoutCount))->getAll();
    }

    public function getByVersionAndScore(int $version, int $score): ?WorkoutPlan
    {
        return (new WorkoutByVersion($version, $score))->getByVersionAndScore();
    }

    public function getByVersionAndCount(int $version, int $score): ?WorkoutPlan
    {
        return (new WorkoutByVersion($version, $score))->getByVersionAndCount();
    }
}
