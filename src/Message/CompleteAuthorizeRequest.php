<?php
/**
 * PayPal REST Complete Purchase Request
 */

namespace Omnipay\Gerencianet\Message;

class CompleteAuthorizeRequest extends AbstractRequest
{
    private $payment;
    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     */
    public function getData()
    {
        $this->validate('transactionReference');
        
        $method = null;
        
        if($this->payment instanceof \Omnipay\Gerencianet\BankingBillet) {
            $method = 'banking_billet';
        } else {
            $method = 'credit_card';
        }
        
        $data = array(
            'payment' => array(
                $method => $this->payment->getParameters()
            )
        );

        return $data;
    }

    /**
     * Get transaction endpoint.
     *
     * Authorization of payments is done using the /payment resource.
     *
     * @return string
     */
    protected function getEndpoint()
    {
        return parent::getEndpoint() . '/charge/' . $this->getTransactionReference() . '/pay';
    }
    
    public function setPayment($payment)
    {
        $this->payment = $payment;
    }
}
