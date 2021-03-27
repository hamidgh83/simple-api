<?php

namespace Application\Controller;

use Application\Model\User;
use Application\Service\PostService;
use Application\Service\UserService;
use Core\Controller\AbstractController;
use Core\Controller\RequiredAuthenticationInterface;
use Core\Http\Response;
use Core\Model\UserInterface;

/**
 * This controller is to register a user and the post of that user
 */
class AssignmentController extends AbstractController implements RequiredAuthenticationInterface
{
    /**
     * Returns list of actions that requires authentication.
     *
     * @return array
     */
    public function authenticatedActions(): array
    {
        return [
            'getPosts',
        ];
    }

    /**
     * Register a user and get token.
     *
     * @return Response
     */
    public function postRegister()
    {
        $request = $this->getRequest();

        $model = new User();
        $model->setName($request->getPost('name'))
            ->setEmail($request->getPost('email'))
            ->setClientId($request->getPost('client_id'));

        $user = $this->getUserService()->register($model);

        if (! $user instanceof User) {
            throw new \Exception('Cannot register user.');
        }

        return new Response([
            's1_token' => $user->getToken(),
            'email' => $user->getEmail(),
            'name' => $user->getName(),
        ]);
    }

    /**
     * Returns paginated posts belong to the current user.
     *
     * @return Response
     */
    public function getPosts()
    {
        $items    = [];
        $page     = $this->getRequest()->getQueryParam('page', 1);
        $pageSize = $this->getRequest()->getQueryParam('pageSize', 100);

        if ($this->identity instanceof UserInterface) {
            $posts = $this->getPostService()->getAll($page, $pageSize);
            while (($row = $posts->fetchAssociative()) !== false) {
                $items[] = $row;
            }
        }

        return new Response($items);
    }

    private function getUserService(): UserService
    {
        return $this->getService(UserService::class);
    }

    private function getPostService(): PostService
    {
        return $this->getService(PostService::class);
    }
}
