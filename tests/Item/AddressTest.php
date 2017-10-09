<?php

namespace Omnipay\Gerencianet\Item;

use Omnipay\Tests\TestCase;

class AddressTest extends TestCase
{
    /** @var Address */
    public $address;

    public function setUp()
    {
        parent::setUp();
        $this->address = new Address();
    }

    public function testAddress()
    {
        $address = $this->address
            ->setStreet('Rua Teste')
            ->setNumber(23)
            ->setComplement('CS 2')
            ->setNeighborhood('Jardins')
            ->setCity('São Paulo')
            ->setState('SP');

        $this->assertInstanceOf('\OmniPay\Gerencianet\Item\Address', $address);
        $this->assertEquals(array(
            'street' => 'Rua Teste',
            'number' => 23,
            'complement' => 'CS 2',
            'neighborhood' => 'Jardins',
            'city' => 'São Paulo',
            'state' => 'SP'
        ), $address->getParameters());
    }
}
