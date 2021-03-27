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

    public function store($data)
    {
        $query = $this->queryBuilder()
            ->insert('posts');

        $i = 0;
        foreach ($data as $key => $val) {
            $query = $query->setValue($key, '?')->setParameter($i++, $val);
        }

        return $query->execute();
    }

    public function averagePostsLengthPerMonth()
    {
        $query = $this->queryBuilder()
            ->select('AVG(character_length) as Average', 'Month(created_at) as Month', 'YEAR (created_at) as Year')
            ->from('posts')
            ->groupBy('YEAR(created_at), MONTH(created_at)');

        return $query->execute();
    }

    public function longestPostsPerMonth()
    {
        $query = $this->queryBuilder()
            ->select('MAX(character_length) as `Character length`', 'Month(created_at) as Month', 'YEAR (created_at) as Year')
            ->from('posts')
            ->groupBy('YEAR(created_at), MONTH(created_at)');

        return $query->execute();
    }

    public function totalPostsByWeek()
    {
        $query = $this->queryBuilder()
            ->select('WEEK(created_at) as Week', 'COUNT(id) as Total')
            ->from('posts')
            ->groupBy('WEEK(created_at)');

        return $query->execute();
    }

    public function averageNumberOfPostsByUserPerMonth()
    {
        $subQuery = $this->queryBuilder()
            ->select('user_id', 'COUNT(id) AS number_of_posts', 'MONTH (created_at) AS `month`')
            ->from('posts')
            ->groupBy('user_id', 'MONTH(created_at)');

        $query = $this->queryBuilder()
            ->select('user_id', 'ROUND(AVG(r.number_of_posts)) AS avg_posts')
            ->from(sprintf('(%s) AS r', $subQuery->getSQL()))
            ->groupBy('user_id');

        return $query->execute();
    }
}
