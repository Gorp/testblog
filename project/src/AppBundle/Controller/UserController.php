<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Entity\User;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller implements ClassResourceInterface
{
    public function postAction(Request $request)
    {
        $data = [];
        $status = Response::HTTP_OK;
        #TODO  validation
        try {
            $user = $this->get('auth.user')->addUser($request);
            $token = $this->get('token.user')->getToken($user);
            $data = [
                'id' => $user->getId(),
                'token' => $token->getToken(),
                'message' => "User created"
            ];

        } catch (\Exception $e) {
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
            $data['message'] = $e->getMessage();
        }

        return new JsonResponse($data, $status);
    }

    public function postAuthAction(Request $request)
    {
        #TODO add validation
        $data = [];
        $status = Response::HTTP_OK;
        try {
            $user = $this->get('auth.user')->authUser($request);

            if (!$user) {
                $status = Response::HTTP_UNAUTHORIZED;
                $data['message'] = "Wrong login or Password";
            } else {
                $data = [
                    'id'      => $user->getId(),
                    'token'   => $user->getToken()->getToken(),
                    'message' => "logged"
                ];
            }
        } catch (\Error $e) {
            $status = Response::HTTP_INTERNAL_SERVER_ERROR;
            $data['message'] = $e->getMessage();
        }

        return new JsonResponse($data, $status);
    }

}