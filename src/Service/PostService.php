<?php

namespace Application\Service;

use Application\Repository\PostRepository;
use Core\Service\AbstractService;

class PostService extends AbstractService
{
    /**
     * @var PostRepository
     */
    protected $repository;

    public function __construct()
    {
        $this->repository = $this->getRepository(PostRepository::class);
    }

    public function getByPage($page = 1, $perPage = 100)
    {
        $offset = ($page - 1) * $perPage;

        return $this->repository->getByPage($perPage, $offset);
    }
}
