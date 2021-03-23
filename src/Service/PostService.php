<?php

namespace Application\Service;

use Application\Repository\PostRepository;
use Core\Model\UserInterface;
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

    public function getAll($page = 1, $perPage = 100)
    {
        $offset = ($page - 1) * $perPage;

        return $this->repository->getAllPosts($perPage, $offset);
    }
}
