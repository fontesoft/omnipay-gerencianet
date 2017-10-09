<?php

namespace Omnipay\Gerencianet\Item;

use Omnipay\Tests\TestCase;

class JuridicalPersonTest extends TestCase
{
    /** @var JuridicalPerson */
    public $juridicalPerson;

    public function setUp()
    {
        parent::setUp();
        $this->juridicalPerson = new JuridicalPerson();
    }

    public function testJuridicalPerson()
    {
        $juridicalPerson = $this->juridicalPerson
            ->setCorporateName('Acme Inc.')
            ->setCnpj('02963901000104');

        $this->assertInstanceOf('\OmniPay\Gerencianet\Item\JuridicalPerson', $juridicalPerson);
        $this->assertEquals(array(
            'corporate_name' => 'Acme Inc.',
            'cnpj' => '02963901000104'
        ), $juridicalPerson->getParameters());
    }
}
