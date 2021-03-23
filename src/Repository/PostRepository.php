<?php

namespace Application\Repository;

use Core\Repository\AbstractRepository;

class PostRepository extends AbstractRepository
{
    public function getAllPosts($limit = 100, $offset = 0)
    {
        $query = $this->queryBuilder()
            ->select('*')
            ->from('posts')
            ->setFirstResult($offset)
            ->setMaxResults($limit);

        return $query->execute();
    }
}
