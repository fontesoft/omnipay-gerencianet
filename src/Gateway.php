<?php

namespace Omnipay\Gerencianet;

use \Omnipay\Common\AbstractGateway;

class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'Gerencianet';
    }

    public function getDefaultParameters()
    {
        return array(
            'clientId'      => '',
            'secret'        => '',
            'token'         => '',
            'testMode'      => true
        );
    }

    public function getClientId()
    {
        return $this->getParameter('clientId');
    }

    public function setClientId($clientId)
    {
        return $this->setParameter('clientId', $clientId);
    }

    public function getSecret()
    {
        return $this->getParameter('secret');
    }

    public function setSecret($secret)
    {
        return $this->setParameter('secret', $secret);
    }

    /**
     * Get OAuth 2.0 access token.
     *
     * @param bool $createIfNeeded [optional] - If there is not an active token present, should we create one?
     * @return string
     */
    public function getToken($createIfNeeded = true)
    {
        if ($createIfNeeded && !$this->hasToken()) {
            $response = $this->createToken()->send();
            if ($response->isSuccessful()) {
                $data = $response->getData();
                if (isset($data['access_token'])) {
                    $this->setToken($data['access_token']);
                    $this->setTokenExpires(time() + $data['expires_in']);
                }
            }
        }

        return $this->getParameter('token');
    }
    
    /**
     * Create OAuth 2.0 access token request.
     *
     * @return \Omnipay\Gerencianet\Message\TokenRequest
     */
    public function createToken()
    {
        return $this->createRequest('\Omnipay\Gerencianet\Message\TokenRequest', array());
    }

    public function setToken($token)
    {
        return $this->setParameter('token', $token);
    }
    
    /**
     * Get OAuth 2.0 access token expiry time.
     *
     * @return integer
     */
    public function getTokenExpires()
    {
        return $this->getParameter('tokenExpires');
    }

    /**
     * Set OAuth 2.0 access token expiry time.
     *
     * @param integer $value
     * @return RestGateway provides a fluent interface
     */
    public function setTokenExpires($value)
    {
        return $this->setParameter('tokenExpires', $value);
    }

    /**
     * Is there a bearer token and is it still valid?
     *
     * @return bool
     */
    public function hasToken()
    {
        $token = $this->getParameter('token');

        $expires = $this->getTokenExpires();
        if (!empty($expires) && !is_numeric($expires)) {
            $expires = strtotime($expires);
        }

        return !empty($token) && time() < $expires;
    }
    
    /**
     * Create Request
     *
     * This overrides the parent createRequest function ensuring that the OAuth
     * 2.0 access token is passed along with the request data -- unless the
     * request is a RestTokenRequest in which case no token is needed.  If no
     * token is available then a new one is created (e.g. if there has been no
     * token request or the current token has expired).
     *
     * @param string $class
     * @param array $parameters
     * @return \Omnipay\Gerencianet\Message\AbstractRequest
     */
    public function createRequest($class, array $parameters = array())
    {   
        if (!$this->hasToken() && $class != '\Omnipay\Gerencianet\Message\TokenRequest') {
            // This will set the internal token parameter which the parent
            // createRequest will find when it calls getParameters().
            
            $this->getToken(true);
        }
        
        return parent::createRequest($class, $parameters);
    }

    public function authorize(array $options = array())
    {
        return $this->createRequest('\Omnipay\Gerencianet\Message\AuthorizeRequest', $options);
    }

    public function completeAuthorize(array $options = array())
    {
        return $this->createRequest('\Omnipay\Gerencianet\Message\CompleteAuthorizeRequest', $options);
    }

    public function fetchTransaction(array $options = array())
    {
        return $this->createRequest('\Omnipay\Gerencianet\Message\FetchTransactionRequest', $options);
    }
}
