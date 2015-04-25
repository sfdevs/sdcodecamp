<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SpeakerControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/speakers/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertEquals(1, $crawler->filter('h1')->count());
        $this->assertTrue($crawler->filter('h1:contains("Speakers")')->count() > 0);
    }

//    public function testShow()
//    {
//        $client = static::createClient();
//
//        $crawler = $client->request('GET', '/speakers/{id}');
//
//        $this->assertEquals(200, $client->getResponse()->getStatusCode());
//
//        $this->assertEquals(1, $crawler->filter('h1')->count());
//    }

}
