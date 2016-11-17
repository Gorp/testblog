<?php
/**
 * Created by PhpStorm.
 * User: gorp
 * Date: 17.11.16
 * Time: 14:03
 */

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends  WebTestCase
{
    private $client;

    public function setUp(){
        $this->client = static::createClient();
    }


    public function testAddUser()
    {

        $this->client->request('POST', '/users', array('name' => 'goo', 'password' => 'alal'));

        $this->assertEquals(
            200, // or Symfony\Component\HttpFoundation\Response::HTTP_OK
            $this->client->getResponse()->getStatusCode()
        );

    }
}
