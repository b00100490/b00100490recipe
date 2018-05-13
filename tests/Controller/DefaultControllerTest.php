<?php
/**
 * Default Controller test
 */

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Summary for Class
 * Class DefaultControllerTest
 * @package App\Tests\Controller
 */

class DefaultControllerTest extends WebTestCase
{
    /**
     * Test home page status
     */
    public function testHomePageStatusOK()
    {
        // arrange
        $httpMethod = 'GET';
        $url = '/';
        $client = static::createClient();
        $client->request($httpMethod, $url);
        $expectedResult = Response::HTTP_OK;

        // act
        $result = $client->getResponse()->getStatusCode();

        // aassert
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * test new recipe page status
     */
    public function testNewRecipePageStatusOk()
    {
        // arrange
        $httpMethod = 'GET';
        $url = '/default/newrecipe';
        $client = static::createClient();
        $client->request($httpMethod, $url);
        $expectedResult = Response::HTTP_OK;

        // act
        $result = $client->getResponse()->getStatusCode();

        // aassert
        $this->assertEquals($expectedResult, $result);
    }

//    public function testEditRecipePageStatusOk()
//    {
//        // arrange
//        $httpMethod = 'GET';
//        $url = '/default/editrecipe{id}';
//        $client = static::createClient();
//        $client->request($httpMethod, $url);
//        $expectedResult = Response::HTTP_OK;
//
//        // act
//        $result = $client->getResponse()->getStatusCode();
//
//        // aassert
//        $this->assertEquals($expectedResult, $result);
//    }

}