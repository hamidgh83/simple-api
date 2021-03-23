<?php

namespace Core\Controller;

use Core\Auth\Token;
use Core\Exception\UnauthorizedException;
use Core\Http\Request as HttpRequest;
use Core\Http\Response;
use Core\Service\ServiceInterface;
use RuntimeException;

abstract class AbstractController implements ControllerInterface
{
    /**
     * @var HttpRequest
     */
    private $request;

    /**
     * Constructor function
     *
     * @param HttpRequest $request
     */
    public function __construct(HttpRequest $request)
    {
        $this->request = $request;
        $this->authenticate();
    }

    private function authenticate()
    {
        if ($this instanceof RequiredAuthenticationInterface) {
            $actions = $this->authenticatedActions();

            if (in_array($this->getRequest()->getAction(), $actions)) {
                if (! Token::validate($this->getRequest()->getHeader('Authorization'))) {
                    throw new UnauthorizedException();
                }
            }
        }
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
     * Get aan identified service.
     *
     * @param string $service
     * @param mixed ...$options
     *
     * @return ServiceInterface
     */
    public function getService(string $service, ...$options): ServiceInterface
    {
        if (! class_exists($service)) {
            throw new RuntimeException(sprintf("The class %s does not exist.", $service), 500);
        }

        return new $service(...$options);
    }

    public function __call($name, $arguments)
    {
        $this->setStatusCode(405);
        return new Response([], 'This method has not been implemented.');
    }
}
