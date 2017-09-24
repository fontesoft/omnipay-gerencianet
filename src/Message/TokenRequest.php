<?php
/**
 * Gerencianet REST Token Request
 */

namespace Omnipay\Gerencianet\Message;

/**
 * Gerencianet REST Token Request
 *
 * With each API call, you’ll need to set request headers, including
 * an OAuth 2.0 access token. Get an access token by using the OAuth
 * 2.0 client_credentials token grant type with your clientId:secret
 * as your Basic Auth credentials.
 *
 * @link https://dev.gerencianet.com.br/docs/endpoint-autorizacao-oauth
 */
class TokenRequest extends AbstractRequest
{
    public function getData()
    {
        return array('grant_type' => 'client_credentials');
    }

    protected function getEndpoint()
    {
        return parent::getEndpoint() . '/authorize';
    }

    public function sendData($data)
    {
        // don't throw exceptions for 4xx errors
        $this->httpClient->getEventDispatcher()->addListener(
            'request.error',
            function ($event) {
                //print_r($event['response']->getStatusCode());die();
                if ($event['response']->isClientError()) {
                    $event->stopPropagation();
                }
            }
        );

        $httpRequest = $this->httpClient->createRequest(
            $this->getHttpMethod(),
            $this->getEndpoint(),
            array('Accept' => 'application/json', 'content-type' => 'application/json'),
            $this->toJSON($data)
        );
        $httpResponse = $httpRequest->setAuth($this->getClientId(), $this->getSecret())->send();
        
        // Empty response body should be parsed also as and empty array
        $body = $httpResponse->getBody(true);
        $jsonToArrayResponse = !empty($body) ? $httpResponse->json() : array();
        return $this->response = new Response($this, $jsonToArrayResponse, $httpResponse->getStatusCode());
    }
}
