<?php
/**
 * Gerencianet Pagamento' Customer
 */

namespace Omnipay\Gerencianet;

use Symfony\Component\HttpFoundation\ParameterBag;

class Customer extends Item
{
    
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
     */
    public function __construct($parameters = null)
    {
        parent::__construct();
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

        $this->helper->initialize($this, $parameters);
        
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
        return $this->parameters->all();
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
    
    public function getJuridicalPerson()
    {
        return $this->getParameter('juridical_person');
    }
    
    public function setJuridicalPerson($value)
    {
        if (!$value instanceof JuridicalPerson) {
            $this->setParameter('juridical_person', new JuridicalPerson($value));
        }
        $this->setParameter('juridical_person', $value);
        
        return $this;
    }
    
    public function getAddress()
    {
        return $this->getParameter('address');
    }
    
    public function setAddress($value)
    {
        if (!$value instanceof Address) {
            $this->setParameter('address', new Address($value));
        }
        $this->setParameter('address', $value);
        
        return $this;
    }
}
