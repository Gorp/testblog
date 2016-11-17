<?php
/**
 * Created by Dmytro Gorpynenko.
 * User: dgo@ciklum.com
 * Date: 17.11.16
 * Time: 12:21
 */

namespace AppBundle\Service;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;

class UserService
{
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function addUser(Request $request)
    {
        $user = new User();
        $user->setName($request->get('name'))
             ->setPassword(sha1($request->get('password')));

        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }

    public function authUser(Request $request)
    {
        return  $this->em->getRepository('AppBundle:User')
                    ->findOneBy([
                        'name' => $request->get('name'),
                        'password' => sha1($request->get('password'))
                    ]);
    }

    
}