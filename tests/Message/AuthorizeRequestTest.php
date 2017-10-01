<?php

namespace Omnipay\Gerencianet\Message;

use Omnipay\Gerencianet\Message\AuthorizeRequest;
use Omnipay\Tests\TestCase;

class AuthorizeRequestTest extends TestCase
{
    /**
     * @var \Omnipay\Gerencianet\Message\AuthorizeRequest
     */
    private $request;
    
    public function setUp()
    {    
        $client = $this->getHttpClient();
        $request = $this->getHttpRequest();
        $this->request = new AuthorizeRequest($client, $request);
    }
    
    public function testGetData()
    {
        $items = array(
            array(
                'name' => 'Item 1',
                'quantity' => 1,
                'price' => 10
            ),
            array(
                'name' => 'Item 2',
                'quantity' => 2,
                'price' => 20
            ),
        );
        $this->request->setItems($items);
        $expected = array(
            'items' => array(
                array(
                    'name' => 'Item 1',
                    'amount' => 1,
                    'value' => 1000
                ),
                array(
                    'name' => 'Item 2',
                    'amount' => 2,
                    'value' => 2000
                ),
            ),
        );
        $this->assertEquals($expected, $this->request->getData());
    }
}
