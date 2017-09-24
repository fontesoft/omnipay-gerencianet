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

        $this->gateway = new RestGateway($this->getHttpClient(), $this->getHttpRequest());
        $this->gateway->setToken('TEST-TOKEN-123');
        $this->gateway->setTokenExpires(time() + 600);
    }
}
