<?php

namespace Omnipay\Gerencianet\Item;

use Omnipay\Tests\TestCase;

class CustomerTest extends TestCase
{
	/** @var Customer */
	public $customer;

	public function setUp()
	{
		parent::setUp();
		$this->customer = new Customer();
	}

	public function testCustomer()
	{
		$customer = $this->customer
			->setName('Gorbadoc Oldbuck')
			->setCpf('94271564656')
			->setEmail('gorbadoc@gerencianet.com.br')
			->setPhoneNumber('5144916523')
			->setBirth('1990-05-20')
			->setJuridicalPerson(array(
				'corporate_name' => 'Acme',
				'cnpj' => '99794567000144',
			))
			->setAddress(array(
				'street' => 'Rua Teste',
				'number' => 23,
				'complement' => 'CS 2',
				'neighborhood' => 'Jardins',
				'city' => 'São Paulo',
				'state' => 'SP',
				'zipcode' => '01001001'
			));

		$this->assertInstanceOf('\Omnipay\Gerencianet\Item\Customer', $customer);

		$this->assertEquals(array(
			'name' => 'Gorbadoc Oldbuck',
			'cpf' => '94271564656',
			'email' => 'gorbadoc@gerencianet.com.br',
			'phone_number' => '5144916523',
			'birth' => '1990-05-20',
			'juridical_person' => array(
				'corporate_name' => 'Acme',
				'cnpj' => '99794567000144',
			),
			'address' => array(
				'street' => 'Rua Teste',
				'number' => 23,
				'complement' => 'CS 2',
				'neighborhood' => 'Jardins',
				'city' => 'São Paulo',
				'state' => 'SP',
				'zipcode' => '01001001',
			)
		), $customer->getParameters());
	}
}