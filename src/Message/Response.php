<?php
/**
 * Gerencianet Response
 */

namespace Omnipay\Gerencianet\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RequestInterface;

/**
 * Gerencianet Response
 */
class Response extends AbstractResponse
{
    protected $statusCode;

    public function __construct(RequestInterface $request, $data, $statusCode = 200)
    {
        parent::__construct($request, $data);
        $this->statusCode = $statusCode;
    }

    public function isSuccessful()
    {
        return $this->getCode() < 400;
    }

    public function getTransactionReference()
    {
        if (!empty($this->data['data']['charge_id'])) {
            return $this->data['data']['charge_id'];
        }

        return null;
    }

    public function getMessage()
    {
        if (isset($this->data['error_description'])) {
            return $this->data['error_description'];
        }

        if (isset($this->data['message'])) {
            return $this->data['message'];
        }
        
        return null;
    }

    public function getCode()
    {
        return $this->statusCode;
    }
}
