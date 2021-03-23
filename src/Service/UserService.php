<?php

namespace Application\Service;

use Application\Model\User;
use Application\Repository\UserRepository;
use Core\Auth\Token;
use Core\Model\UserInterface;
use Core\Service\AbstractService;
use Core\Service\UserServiceInterface;
use DateInterval;
use DateTime;

class UserService extends AbstractService implements UserServiceInterface
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

    public function authenticate($token): ?UserInterface
    {
        return $this->repository->findByToken($token);
    }
}
