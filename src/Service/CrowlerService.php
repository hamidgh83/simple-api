<?php

namespace Application\Service;

use Core\Service\AbstractService;
use GuzzleHttp\Client as HttpClient;

class CrowlerService extends AbstractService
{
    protected $client;

    public function __construct()
    {
        $this->client = new HttpClient();
    }

    /**
     * Register a user and get token
     *
     * @return mixed
     */
    public function register()
    {
        $url      = rtrim($_ENV['BASE_URL'], '/') . "/assignment/register";
        $headers  = ['Content-Type' => 'application/json'];
        $body     = [
            "client_id" => $_ENV['CLIENT_ID'] ?? null,
            "email" => $_ENV['EMAIL'] ?? null,
            "name" => $_ENV['NAME'],
        ];
        $params   = ['headers' => $headers, 'body' => json_encode($body)];
        $response = $this->client->post($url, $params);

        return json_decode($response->getBody());
    }

    /**
     * Fetch posts from the API
     *
     * @param string $token
     * @param integer $page
     *
     * @return array
     */
    public function fetchData($token, $page = 1)
    {
        $url      = rtrim($_ENV['BASE_URL'], '/') . "/assignment/posts";
        $url      = sprintf("%s?sl_token=%s&page=%d", $url, $token, $page);
        $response = $this->client->request('GET', $url);

        return json_decode($response->getBody(), true);
    }
}
