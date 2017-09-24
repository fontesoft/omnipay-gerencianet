<?php
/**
 * Gerencianet Fetch Transaction Request
 */

namespace Omnipay\Gerencianet\Message;

class FetchTransactionRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('transactionReference');
        return array();
    }

    /**
     * Get HTTP Method.
     *
     * The HTTP method for fetchTransaction requests must be GET.
     *
     * @return string
     */
    protected function getHttpMethod()
    {
        return 'GET';
    }

    public function getEndpoint()
    {
        return parent::getEndpoint() . '/charge/' . $this->getTransactionReference();
    }
}
