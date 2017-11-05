<?php

namespace Omnipay\Gerencianet;

use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{

    /** @var Gateway */
    public $gateway;

    /** @var array */
    public $options;

    public function setUp()
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->setToken('TEST-TOKEN-123');
        $this->gateway->setTokenExpires(time() + 600);

        $this->options = array(
            'items' => array(
                array(
                    'name' => 'Base 1',
                    'quantity' => 1,
                    'price' => 10
                ),
                array(
                    'name' => 'Base 2',
                    'quantity' => 2,
                    'price' => 20
                ),
            )
        );
    }
    
    public function testBearerToken()
    {
        $this->gateway->setToken('');
        $this->setMockHttpResponse('TokenSuccess.txt');

        $this->assertFalse($this->gateway->hasToken());
        $this->assertEquals('A015GQlKQ6uCRzLHSGRliANi59BHw6egNVKEWRnxvTwvLr048b9c278f9dc26b86', $this->gateway->getToken()); // triggers request
        $this->assertEquals(time() + 600, $this->gateway->getTokenExpires());
        $this->assertTrue($this->gateway->hasToken());
    }
    
    public function testBearerTokenReused()
    {
        $this->setMockHttpResponse('TokenSuccess.txt');
        $this->gateway->setToken('MYTOKEN');
        $this->gateway->setTokenExpires(time() + 60);

        $this->assertTrue($this->gateway->hasToken());
        $this->assertEquals('MYTOKEN', $this->gateway->getToken());
    }
    
    public function testBearerTokenExpires()
    {
        $this->setMockHttpResponse('TokenSuccess.txt');
        $this->gateway->setToken('MYTOKEN');
        $this->gateway->setTokenExpires(time() - 60);

        $this->assertFalse($this->gateway->hasToken());
        $this->assertEquals('A015GQlKQ6uCRzLHSGRliANi59BHw6egNVKEWRnxvTwvLr048b9c278f9dc26b86', $this->gateway->getToken());
    }
    
    public function testAuthorize()
    {
        $this->setMockHttpResponse('AuthorizeSuccess.txt');

        $response = $this->gateway->authorize($this->options)->send();

        $this->assertTrue($response->isSuccessful());
        $this->assertEquals('271262', $response->getTransactionReference());
        $this->assertNull($response->getMessage());
    }

    public function testCompleteAuthorize()
    {
        $this->setMockHttpResponse('CompleteAuthorizationBankingBilletSuccess.txt');

        $paymentMethod = new Item\BankingBillet(
            array(
                'customer' => array(
                    'name' => 'Gorbadoc Oldbuck',
                    'cpf' => '94271564656',
                    'phone_number' => '5144916523'
                ),
                'expire_at' => '2018-12-12'
            )
        );
        $paymentMethod->setConfigurationFine(2);
        $paymentMethod->setConfigurationInterest(0.033);

        $charge_id = 279945;

        $response = $this->gateway->completeAuthorize(array(
            'transaction_reference' => $charge_id,
            'payment' => $paymentMethod
        ))->send();

        $this->assertEquals('00000.00000 00000.000000 00000.000000 0 00000000000000', $response->getBarcode());
        $this->assertEquals('https://visualizacaosandbox.gerencianet.com.br/emissao/125673_14_ZEBRA0/A4XB-156723-122924-NEOMA7', $response->getLink());
    }

    public function testFetchTransaction()
    {
        $request = $this->gateway->fetchTransaction(array('transactionReference' => '271058'));

        $this->assertInstanceOf('\Omnipay\Gerencianet\Message\FetchTransactionRequest', $request);
        $this->assertEquals('271058', $request->getTransactionReference());
    }
}
