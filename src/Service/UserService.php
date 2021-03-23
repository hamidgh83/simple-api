<?php

namespace Application\Service;

use Application\Model\User;
use Application\Repository\UserRepository;
use Core\Auth\Token;
use Core\Service\AbstractService;
use DateInterval;
use DateTime;

class UserService extends AbstractService
{
    /**
     * @var UserRepository
     */
    protected $repository;

    public function __construct()
    {
        $this->repository = $this->getRepository(UserRepository::class);
    }

    public function register(User $user): ?User
    {
        $expiresAt = new DateTime();
        $expiresAt->add(new DateInterval('PT1H'));

        $user->setToken(Token::generate());
        $user->setExpiresAt($expiresAt->format("Y-m-d H:i:s"));

        return $this->repository->save($user);
    }
}
