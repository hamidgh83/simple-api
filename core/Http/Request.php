<?php

namespace Core\Http;

class Request
{
    private $uri;

    private $requestMethod;

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

    public function getQueryParams()
    {
        return $_GET;
    }

    public function getQueryParam($param, $default = null)
    {
        $value = $_GET[$param] ?? $default;

        if (is_numeric($value)) {
            $value = ($value == (int) $value) ? (int) $value : (float) $value;
        }

        return $value;
    }

    private function process()
    {
        $this->requestMethod = $_SERVER["REQUEST_METHOD"];

        $this->uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $this->uri = explode('/', $this->uri);
    }
}
