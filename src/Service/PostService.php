<?php

namespace Application\Service;

use Application\Repository\PostRepository;
use Core\Service\AbstractService;
use Doctrine\DBAL\Result;

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

    /**
     * Get a list of paginated posts
     *
     * @param integer $page
     * @param integer $perPage
     *
     * @return Result|int
     */
    public function getAll($page = 1, $perPage = 100)
    {
        $offset = ($page - 1) * $perPage;

        return $this->repository->getAllPosts($perPage, $offset);
    }

    /**
     * Store posts
     *
     * @param array $data
     *
     * @return Result|int
     */
    public function save($data)
    {
        return $this->repository->store($data);
    }
}
