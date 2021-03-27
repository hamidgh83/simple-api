<?php

namespace Application\Controller;

use Application\Service\StatsService;
use Core\Controller\AbstractController;
use Core\Http\Response;

/**
 * This controller provides stats from the post data
 */
class StatsController extends AbstractController
{
    public function get()
    {
        $service = $this->getStatsService();

        return new Response([
            "Avg. character length of posts per month" => $service->averagePostsLengthPerMonth(),
            "Longest posts per month" => $service->longestPostsPerMonth(),
            "Avg. posts per user per month" => $service->averageNumberOfPostsByUserPerMonth(),
            "Total posts by week No." => $service->totalPostsByWeek(),
        ]);
    }

    protected function getStatsService(): StatsService
    {
        return $this->getService(StatsService::class);
    }
}
