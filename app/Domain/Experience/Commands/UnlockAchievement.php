<?php

namespace App\Domain\Experience\Commands;

use App\Domain\Achievements\Models\Achievement;
use App\Domain\Experience\ExperienceAggregateRoot;
use Spatie\EventSourcing\Commands\AggregateUuid;
use Spatie\EventSourcing\Commands\HandledBy;

#[HandledBy(ExperienceAggregateRoot::class)]
class UnlockAchievement
{
    public function __construct(
        #[AggregateUuid] public string $uuid,
        public int $userId,
        public Achievement $achievement,
    ) {
    }
}
