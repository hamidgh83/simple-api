<?php

namespace Core\Http;

class Request
{
    private $uri;

    private $requestMethod;

    private $action;

    public function __construct()
    {
        $this->process();
    }

    public function getMethod()
    {
        return $this->requestMethod;
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function getHeaders()
    {
        return getallheaders();
    }

    public function getHeader($key)
    {
        $headers = $this->getHeaders();

        return $headers[$key] ?? null;
    }

    public function getQueryParams()
    {
        return $_GET;
    }

    public function getQueryParam($param, $default = null)
    {
        $this->castNumericValue($_GET[$param] ?? $default);
    }

    public function getPosts()
    {
        $inputJSON  = file_get_contents('php://input');
        $postedData = json_decode($inputJSON, true);

        return $postedData;
    }

    public function getPost($key, $default = null)
    {
        $postedData = $this->getPosts();

        return $postedData[$key] ?? $default;
    }

    protected function castNumericValue($value)
    {
        if (is_numeric($value)) {
            $value = ($value == (int) $value) ? (int) $value : (float) $value;
        }

        return $value;
    }

    public function setAction($name)
    {
        $this->action = $name;

        return $this;
    }

    public function getAction()
    {
        return $this->action;
    }

    private function process()
    {
        $this->requestMethod = $_SERVER["REQUEST_METHOD"];

        $this->uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $this->uri = explode('/', $this->uri);
    }
}
