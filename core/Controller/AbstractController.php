<?php

namespace Core\Controller;

use Core\Exception\UnauthorizedException;
use Core\Factory\Factory;
use Core\Http\Request as HttpRequest;
use Core\Http\Response;
use Core\Model\UserInterface;
use Core\Service\ServiceInterface;
use Core\Service\UserServiceInterface;

abstract class AbstractController implements ControllerInterface
{
    /**
     * @var HttpRequest
     */
    private $request;

    /**
     * @var UserInterface
     */
    protected $identity;

    /**
     * Constructor function
     *
     * @param HttpRequest $request
     */
    public function __construct(HttpRequest $request)
    {
        $this->request  = $request;
        $this->identity = $this->authenticate();
    }

    private function authenticate()
    {
        if ($this instanceof RequiredAuthenticationInterface) {
            $actions = $this->authenticatedActions();

            if (in_array($this->getRequest()->getAction(), $actions)) {
                $token = $this->getRequest()->getToken();
                $user  = $this->getUserService()->authenticate($token);

                if (! $user instanceof UserInterface) {
                    throw new UnauthorizedException();
                }

                return $user;
            }
        }
    }

    private function getUserService(): UserServiceInterface
    {
        return $this->getService(UserServiceInterface::class);
    }

    /**
     * Return HttpRequest
     *
     * @return HttpRequest
     */
    public function getRequest(): HttpRequest
    {
        return $this->request;
    }

    public function setStatusCode($statusCode)
    {
        http_response_code($statusCode);

        return $statusCode;
    }

    public function getStatusCode()
    {
        http_response_code();
    }

    /**
     * Get an identified service.
     *
     * @param string $service
     * @param mixed ...$options
     */
    public function getService(string $service, ...$options): ServiceInterface
    {
        $factory = new Factory($service, $options);

        return $factory->make();
    }

    public function __call($name, $arguments)
    {
        $this->setStatusCode(405);
        return new Response([], 'This method has not been implemented.');
    }
}
