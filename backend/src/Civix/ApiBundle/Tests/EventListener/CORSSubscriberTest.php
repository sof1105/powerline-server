<?php

namespace Civix\ApiBundle\Tests\EventListener;

use Liip\FunctionalTestBundle\Test\WebTestCase;

class CORSSubscriberTest extends WebTestCase
{
    /**
     * @group api
     * @group cors
     */
    public function testGET()
    {
        $client = static::createClient(array(), array('HTTPS' => true));
        $client->request('GET', '/');
        $this->assertEquals(
            200,
            $client->getResponse()->getStatusCode(),
            'Should return content'
        );
        $this->assertNotEmpty($client->getResponse()->headers->get('Access-Control-Allow-Origin'),
            'Should return cors headers');
    }

    /**
     * @group api
     * @group cors
     */
    public function testNotAllowedMethod()
    {
        $client = static::createClient(array(), array('HTTPS' => true));
        $client->request('POST', '/api/activity');
        $this->assertEquals(
            405,
            $client->getResponse()->getStatusCode(),
            'Should be not allowed method'
        );
        $this->assertNotEmpty($client->getResponse()->headers->get('Access-Control-Allow-Origin'),
            'Should return cors headers');
    }

    /**
     * @group api
     * @group cors
     */
    public function testOPTIONS()
    {
        $client = static::createClient(array(), array('HTTPS' => true));

        $client->request('OPTIONS', '/api/activity');
        $this->assertEquals(
            200,
            $client->getResponse()->getStatusCode(),
            'Should return 200 ok'
        );
        $this->assertNotEmpty($client->getResponse()->headers->get('Access-Control-Allow-Origin'),
            'Should return cors headers');
    }
}
