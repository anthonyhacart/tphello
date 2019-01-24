<?php

namespace App\Tests\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Guard\Token\PostAuthenticationGuardToken;

class UserActionControllerTest extends WebTestCase{

    public $client;

    private function logIn()
    {
        $session = $this->client->getContainer()->get('session');

        $firewallName = 'main';
        $firewallContext = 'main';

        $token = new UsernamePasswordToken('user@user.fr', 'user@user.fr', $firewallName, ['ROLE_USER']);
        $session->set('_security_'.$firewallContext, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);
    }

    public function setUp()
    {
        parent::setUp();

        $this->client = static::createClient();

    }

    public function testIndex()
    {
       $this->logIn();

        $this->client->request('GET', '/user-action/');

        $this->assertEquals(200,  $this->client->getResponse()->getStatusCode());
    }

    public function testReload()
    {
        $this->logIn();

        $this->client->request('GET', '/user-action/reload/10');

        $this->assertEquals(302,  $this->client->getResponse()->getStatusCode());
    }

    public function testLoad()
    {
        $this->logIn();

        $this->client->request('GET', '/user-action/load/10');

        $this->assertEquals(302,  $this->client->getResponse()->getStatusCode());
    }

    public function testShoot()
    {
        $this->logIn();

        $this->client->request('GET', '/user-action/shoot/21');

        $this->assertEquals(302,  $this->client->getResponse()->getStatusCode());
    }

    public function testHeal()
    {

    }

}