<?php

namespace Application\Service;

use Application\Repository\PostRepository;
use Core\Service\AbstractService;

class StatsService extends AbstractService
{
    /**
     * @var PostRepository
     */
    protected $repository;

    public function __construct()
    {
        $this->repository = $this->getRepository(PostRepository::class);
    }

    public function averagePostsLengthPerMonth()
    {
        return $this
            ->repository
            ->averagePostsLengthPerMonth()
            ->fetchAllAssociative();
    }

    public function longestPostsPerMonth()
    {
        return $this
            ->repository
            ->longestPostsPerMonth()
            ->fetchAllAssociative();
    }

    public function totalPostsByWeek()
    {
        return $this
            ->repository
            ->totalPostsByWeek()
            ->fetchAllAssociative();
    }

    public function averageNumberOfPostsByUserPerMonth()
    {
        return $this
            ->repository
            ->averageNumberOfPostsByUserPerMonth()
            ->fetchAllAssociative();
    }
}
