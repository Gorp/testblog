<?php
/**
 * Created by Dmytro Gorpynenko.
 * User: dgo@ciklum.com
 * Date: 17.11.16
 * Time: 10:02
 */

namespace Tests\AppBundle\Controller;



use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GenusControllerTest extends  WebTestCase
{
    public  function testGenusHello()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/genus/dima');

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Hello dima")')->count()
        );
    }

}
