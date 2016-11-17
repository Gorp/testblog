<?php
/**
 * Created by Dmytro Gorpynenko.
 * User: dgo@ciklum.com
 * Date: 17.11.16
 * Time: 12:21
 */

namespace AppBundle\Service;

use AppBundle\Entity\Blog;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;

class BlogService
{
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function addBlog(Request $request, User $user)
    {
        $blog = new Blog();
        $blog->setTitle($request->get('title'))
             ->setContent($request->get('content'))
             ->setUser($user);

        $this->em->persist($blog);
        $this->em->flush();

        return $blog;
    }
}