<?php

namespace Core\Application;

use Core\Controller\ControllerInterface;
use Core\Exception\NotFoundException;
use Core\Http\Request as HttpRequest;
use Core\Http\Response;

class Application
{
    /**
     * @var HttpRequest
     */
    protected $request;

    /**
     * Constructor function
     *
     * @param HttpRequest $request
     */
    public function __construct(HttpRequest $request)
    {
        $this->request = $request;
        $this->addHeaders();
    }

    /**
     * This runs the application and print the result.
     *
     * @return string Json string of Response object
     */
    public function run()
    {
        try {
            $action     = $this->getAction();
            $controller = $this->getController();
            $response   = $controller->$action();

            if (! $response instanceof Response && ! $this->isJsonResponse($response)) {
                throw new \RuntimeException("Invalid response.", 500);
            }
        } catch (\Throwable $ex) {
            http_response_code($ex->getCode());
            echo new Response([], $ex->getMessage());
            return;
        }

        echo $response;
    }

    protected function isJsonResponse($response)
    {
        json_decode($response);

        return (json_last_error() == JSON_ERROR_NONE);
    }

    /**
     * This returns corresponding controller to the http route.
     *
     * @return ControllerInterface
     *
     * @throws NotFoundException
     */
    protected function getController(): ControllerInterface
    {
        $namespace  = '\Application\Controller\\';
        $controller = (isset($this->request->getUri()[1]) && strlen(trim($this->request->getUri()[1])) > 0 ? $this->request->getUri()[1] : 'Default') . 'Controller';
        $controller = $namespace . ucfirst($controller);

        if (! class_exists($controller)) {
            throw new NotFoundException();
        }

        return new $controller($this->request);
    }

    /**
     * This gets action based on the http request.
     *
     * @return string
     */
    protected function getAction()
    {
        $action = (isset($this->request->getUri()[2]) && strlen(trim($this->request->getUri()[2])) > 0) ? $this->request->getUri()[2] : null;

        if (! is_null($action)) {
            $action = strtolower($this->request->getMethod()) . ucfirst(strtolower($action));
        } else {
            $action = $this->getDefaultAction();
        }

        $this->request->setAction($action);

        return $action;
    }

    protected function getDefaultAction()
    {
        $action = null;

        switch ($this->request->getMethod()) {
            case 'GET':
                $action = 'get';
                break;
            case 'POST':
                $action = 'create';
                break;
            case 'PUT':
                $action = 'update';
                break;
            case 'DELETE':
                $action = 'delete';
                break;
            default:
                $action = 'options';
                break;
        }

        return $action;
    }

    /**
     * Add defualt hearders.
     *
     * @return void
     */
    private function addHeaders()
    {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
        header("Access-Control-Max-Age: 3600");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    }
}
