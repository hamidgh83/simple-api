<?php

namespace Application\Controller;

use Application\Service\CrowlerService;
use Application\Service\PostService;
use Core\Controller\AbstractController;
use Core\Http\Response;

/**
 * This controller is to fetch data from supermerics api and store into the database.
 */
class FetchController extends AbstractController
{
    public function get()
    {
        $total = 0;
        $user  = $this->getCrowlerService()->register();
        $token = $user->data->sl_token;

        for ($page = 1; $page < 11; $page++) {
            $response = $this->getCrowlerService()->fetchData($token, $page);
            $posts    = $response['data']['posts'];

            foreach ($posts as $post) {
                $userId = substr($post['from_id'], strlen('user_'));
                $dt     = new \DateTime($post['created_time']);
                $data   = [
                    'message' => $post['message'],
                    'user_id' => $userId,
                    'character_length' => strlen($post['message']),
                    'created_at' => $dt->format('Y-m-d H:i:s'),
                ];

                $this->getPostService()->save($data);
                $total++;
            }
        }

        return new Response(['total records' => $total]);
    }

    protected function getCrowlerService(): CrowlerService
    {
        return $this->getService(CrowlerService::class);
    }

    protected function getPostService(): PostService
    {
        return $this->getService(PostService::class);
    }
}
