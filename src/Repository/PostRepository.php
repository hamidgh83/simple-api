<?php

namespace Application\Repository;

use Core\Repository\AbstractRepository;

class PostRepository extends AbstractRepository
{
    public function getUserPosts($userId, $limit = 100, $offset = 0)
    {
        $query = $this->queryBuilder()
            ->select('*')
            ->from('posts')
            ->where('user_id = ?')
            ->setParameter(0, $userId)
            ->setFirstResult($offset)
            ->setMaxResults($limit);

        return $query->execute();
    }
}
