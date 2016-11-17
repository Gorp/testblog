<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Blog;
use AppBundle\Entity\Product;
use AppBundle\Entity\User;
use FOS\RestBundle\Routing\ClassResourceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller implements ClassResourceInterface
{
    public function cgetAction()
    {
        $data   = [];
        $status = Response::HTTP_OK;
        #TODO  validation
        try {
            $blogs = $this
                ->getDoctrine()->getRepository('AppBundle:Blog')->findAll();

            foreach ($blogs as $blog) {
                $data[] = [
                    'id'      => $blog->getId(),
                    'title'   => $blog->getTitle(),
                    'content' => $blog->getContent(),
                ];
            }

        } catch (\Error $e) {
            $status          = Response::HTTP_INTERNAL_SERVER_ERROR;
            $data['message'] = $e->getMessage();
        }

        return new JsonResponse($data, $status);
    }

    public function getAction(Blog $blog)
    {
        $data   = [];
        $status = Response::HTTP_OK;
        #TODO  validation
        try {
            $data = [
                'title'    => $blog->getTitle(),
                'content'    => $blog->getContent(),
            ];

        } catch (\Error $e) {
            $status          = Response::HTTP_INTERNAL_SERVER_ERROR;
            $data['message'] = $e->getMessage();
        }

        return new JsonResponse($data, $status);

    }

    public function postAction(Request $request)
    {

        $data   = [];
        $status = Response::HTTP_OK;
        #TODO  validation
        try {
            $user = $this->get('token.user')->getUserByToken($request);
            if ( ! $user) {
                $status          = Response::HTTP_UNAUTHORIZED;
                $data['message'] = "You are not authorized";
            } else {
                $blog = $this->get('blog.user')->addBlog($request, $user);
                $data = [
                    'id'      => $blog->getId(),
                    'message' => 'Blog created'
                ];
            }

        } catch (\Error $e) {
            $status          = Response::HTTP_INTERNAL_SERVER_ERROR;
            $data['message'] = $e->getMessage();
        }

        return new JsonResponse($data, $status);
    }


}