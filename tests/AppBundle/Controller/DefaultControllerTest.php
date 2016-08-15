<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(1, $crawler->filter('h1')->count());
        $this->assertTrue($crawler->filter('h1:contains("South Dakota Code Camp")')->count() > 0);
        $this->assertFalse($crawler->filter('body:contains("Sign up for notifications")')->count() > 0);
    }
    public function testInformation()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/information/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(1, $crawler->filter('h1')->count());
        $this->assertTrue($crawler->filter('h1:contains("Information")')->count() > 0);
    }

}
