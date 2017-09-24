<?php
/**
 * Gerencianet Pagamento' Customer 
 */

namespace Omnipay\Gerencianet;

use Symfony\Component\HttpFoundation\ParameterBag;
use Omnipay\Common\Helper;

class Customer
{
    private $address;
    
    private $corporate;
    
    /**
     * Internal storage of all of the customer parameters.
     *
     * @var \Symfony\Component\HttpFoundation\ParameterBag
     */
    protected $parameters;

    /**
     * Create a new Customer object using the specified parameters 
     *
     * @param array|null $parameters An array of parameters to set on the new object
     * @param array|null $address An associative array of Address parameters
     * @param array|null $corporate An associative array of Corporate parameters
     */
    public function __construct($parameters = null, $address = null, $corporate = null)
    {
        $this->address = new Address($address);
        $this->corporate = new Corporate($corporate);
        $this->initialize($parameters);
    }
    
    /**
     * Initialize the object with parameters.
     *
     * If any unknown parameters passed, they will be ignored.
     *
     * @param array $parameters An associative array of parameters
     * @return BankingBillet provides a fluent interface.
     */
    public function initialize($parameters)
    {
        $this->parameters = new ParameterBag;

        Helper::initialize($this, $parameters);
        
        return $this;
    }
    
    /**
     * Set one parameter.
     *
     * @param string $key Parameter key
     * @param mixed $value Parameter value
     * @return BankingBillet provides a fluent interface.
     */
    protected function setParameter($key, $value)
    {
        $this->parameters->set($key, $value);

        return $this;
    }
    
    /**
     * Get all parameters.
     *
     * @return array An associative array of parameters.
     */
    public function getParameters()
    {
        $parameters = $this->parameters->all();
        if($this->address->getParameters()) {
            $parameters['address'] = $this->address->getParameters();
        }
        if($this->corporate->getParameters()) {
            $parameters['juridical_person'] = $this->corporate->getParameters();
        }
        
        return $parameters;
    }

    /**
     * Get one parameter.
     *
     * @return mixed A single parameter value.
     */
    protected function getParameter($key)
    {
        return $this->parameters->get($key);
    }
    
    public function getName()
    {
        return $this->getParameter('name');
    }
    
    public function getCpf()
    {
        return $this->getParameter('cpf');
    }
    
    public function getEmail()
    {
        return $this->getParameter('email');
    }
    
    public function getPhoneNumber()
    {
        return $this->getParameter('phone_number');
    }
    
    public function getBirth()
    {
        return $this->getParameter('birth');
    }
    
    public function setName($value)
    {
        return $this->setParameter('name', $value);
    }

    public function setCpf($value)
    {
        return $this->setParameter('cpf', $value);
    }

    public function setEmail($value)
    {
        return $this->setParameter('email', $value);
    }

    public function setPhoneNumber($value)
    {
        return $this->setParameter('phone_number', $value);
    }

    public function setBirth($value)
    {
        return $this->setParameter('birth', $value);
    }
    
    public function getCorporate()
    {
        return $this->corporate;
    }
    
    public function setCorporate($corporate)
    {
        $this->corporate = $corporate;
        
        return $this;
    }
    
    public function getAddress()
    {
        return $this->address;
    }
    
    public function setAddress($address)
    {
        $this->address = $address;
        
        return $this;
    }
}
