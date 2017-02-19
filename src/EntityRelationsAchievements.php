<?php
/**
 * Created by PhpStorm.
 * User: Gabriel Simonetti
 * Date: 18/02/2017
 * Time: 21:03
 */

namespace Gstt\Achievements;

use Gstt\Achievements\Model\AchievementProgress;
use Illuminate\Database\Eloquent\Builder;

trait EntityRelationsAchievements
{
    /**
     * Get the entity's Achievements
     *
     * @return Builder
     */
    public function achievements()
    {
        return $this->morphMany(AchievementProgress::class, 'achiever')
            ->orderBy('created_at', 'desc');
    }

    /**
     * Get the entity's achievements in progress.
     *
     * @return Builder
     */
    public function inProgressAchievements()
    {
        return $this->achievements()->whereNull('unlocked_at');
    }

    /**
     * Get the entity's unlocked achievements.
     *
     * @return Builder
     */
    public function unlockedAchievements()
    {
        return $this->achievements()->whereNotNull('unlocked_at');
    }
}