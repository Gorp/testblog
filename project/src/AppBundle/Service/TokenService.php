<?php
/**
 * Created by Dmytro Gorpynenko.
 * User: dgo@ciklum.com
 * Date: 17.11.16
 * Time: 12:21
 */

namespace AppBundle\Service;

use AppBundle\Entity\Token;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityManager;

class TokenService
{
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getToken(User $user)
    {
        $token = $this->em->getRepository('AppBundle:Token')->findOneBy(['token' => $user->getToken()]);

        if (!$token) {
            $token = new Token();
            $token->setToken($this->generateToken());


            $this->em->persist($token);
            $user->setToken($token);
            $this->em->flush();
        }

        return $token;
    }

    public function isTokenExists(User $user)
    {

    }

    private function generateToken()
    {
        return sha1(rand()*rand());
    }
}