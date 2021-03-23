<?php

namespace Application\Repository;

use Application\Model\User;
use Core\Repository\AbstractRepository;

class UserRepository extends AbstractRepository
{
    public function save(User $user): ?User
    {
        $query = $this->queryBuilder()
            ->insert('users')
            ->values(
                [
                    'name' => '?',
                    'email' => '?',
                    'client_id' => '?',
                    'token' => '?',
                    'expires_at' => '?',
                ]
            )
            ->setParameter(0, $user->getName())
            ->setParameter(1, $user->getEmail())
            ->setParameter(2, $user->getClientId())
            ->setParameter(3, $user->getToken())
            ->setParameter(4, $user->getExpiresAt());

        $rowCount = $query->execute();

        if ($rowCount == 1) {
            return $user;
        }

        return null;
    }
}
