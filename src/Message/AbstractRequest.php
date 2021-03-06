<?php

namespace Omnipay\Gerencianet\Message;

use Omnipay\Common\Exception\InvalidResponseException;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    const API_VERSION = 'v1';

    protected $testEndpoint = 'https://sandbox.gerencianet.com.br';
    protected $liveEndpoint = 'https://api.gerencianet.com.br';

    public function getClientId()
    {
        return $this->getParameter('clientId');
    }

    public function setClientId($value)
    {
        return $this->setParameter('clientId', $value);
    }

    public function getSecret()
    {
        return $this->getParameter('secret');
    }

    public function setSecret($value)
    {
        return $this->setParameter('secret', $value);
    }

    public function getToken()
    {
        return $this->getParameter('token');
    }

    public function setToken($value)
    {
        return $this->setParameter('token', $value);
    }

    /**
     * Get HTTP Method.
     *
     * This is nearly always POST but can be over-ridden in sub classes.
     *
     * @return string
     */
    protected function getHttpMethod()
    {
        return 'POST';
    }

    protected function getEndpoint()
    {
        $base = $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
        return $base . '/' . self::API_VERSION;
    }

    public function sendData($data)
    {
        // don't throw exceptions for 4xx errors
        $this->httpClient->getEventDispatcher()->addListener(
            'request.error',
            function ($event) {
                if ($event['response']->isClientError()) {
                    $event->stopPropagation();
                }
            }
        );
        
        $httpRequest = $this->httpClient->createRequest(
            $this->getHttpMethod(),
            $this->getEndpoint() . (($this->getHttpMethod() == 'GET') ? '?' . http_build_query($data) : ''),
            array(
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . $this->getToken(),
                'Content-type' => 'application/json',
            ),
            (($this->getHttpMethod() !== 'GET') ? $this->toJSON($data) : null)
        );

        $httpRequest->getCurlOptions()->set(CURLOPT_SSLVERSION, 6); // CURL_SSLVERSION_TLSv1_2 for libcurl < 7.35
        $httpResponse = $httpRequest->send();
        $body = $httpResponse->getBody(true);
        
        if ($httpResponse->getStatusCode() != 200) {
            throw new InvalidResponseException(
                'Error communicating with payment gateway: ' . $body,
                $httpResponse->getStatusCode()
            );
        }
        $jsonToArrayResponse = !empty($body) ? $httpResponse->json() : array();
        return $this->response = $this->createResponse($jsonToArrayResponse, $httpResponse->getStatusCode());
    }
    
    /**
     * Returns object JSON representation required by PayPal.
     * The PayPal REST API requires the use of JSON_UNESCAPED_SLASHES.
     *
     * Adapted from the official PayPal REST API PHP SDK.
     * (https://github.com/paypal/PayPal-PHP-SDK/blob/master/lib/PayPal/Common/PayPalModel.php)
     *
     * @param int $options http://php.net/manual/en/json.constants.php
     * @return string
     */
    public function toJSON($data, $options = 0)
    {
        // Because of PHP Version 5.3, we cannot use JSON_UNESCAPED_SLASHES option
        // Instead we would use the str_replace command for now.
        // Replace this code with return json_encode($this->toArray(), $options | 64); once we support PHP >= 5.4
        if (version_compare(phpversion(), '5.4.0', '>=') === true) {
            return json_encode($data, $options | 64);
        }
        return str_replace('\\/', '/', json_encode($data, $options));
    }

    protected function createResponse($data, $statusCode)
    {
        return $this->response = new Response($this, $data, $statusCode);
    }
}
