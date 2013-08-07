<?php

namespace MinePlus\MainBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ImageControllerTest extends WebTestCase
{
    public function testAvatar()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/avatar');
    }

}
