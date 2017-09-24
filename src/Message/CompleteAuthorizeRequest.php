<?php
/**
 * Gerencianet Complete Authorize Request
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
        $parameters = array();
        
        if ($this->payment instanceof \Omnipay\Gerencianet\BankingBillet) {
            $method = 'banking_billet';
            $parameters = $this->compileBankingBilletParameters($this->payment->getParameters());
        } else {
            $method = 'credit_card';
        }
        
        $data = array(
            'payment' => array(
                $method => $parameters
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
    
    private function compileBankingBilletParameters($parameters)
    {
        if (isset($parameters['configuration_fine'])) {
            if (array_key_exists('configurations', $parameters)) {
                $parameters['configurations']['fine'] =
                    (int)number_format($parameters['configuration_fine'] * 100, 0, '', '');
            } else {
                $parameters['configurations'] = array(
                    'fine' => (int)number_format($parameters['configuration_fine'] * 100, 0, '', '')
                );
            }
            unset($parameters['configuration_fine']);
        }
        
        if (isset($parameters['configuration_interest'])) {
            if (array_key_exists('configurations', $parameters)) {
                $parameters['configurations']['interest'] =
                    (int)number_format($parameters['configuration_interest'] * 1000, 0, '', '');
            } else {
                $parameters['configurations'] = array(
                    'interest' => (int)number_format($parameters['configuration_interest'] * 1000, 0, '', '')
                );
            }
            unset($parameters['configuration_interest']);
        }
        
        if (isset($parameters['discount_type'])) {
            if (array_key_exists('discount', $parameters)) {
                $parameters['discount']['type'] = $parameters['discount_type'];
            } else {
                $parameters['discount'] = array(
                    'type' => $parameters['discount_type']
                );
            }
            unset($parameters['discount_type']);
        }
        
        if (isset($parameters['discount_value'])) {
            if (array_key_exists('discount', $parameters)) {
                $parameters['discount']['value'] = (int)number_format($parameters['discount_value'] * 100, 0, '', '');
            } else {
                $parameters['discount'] = array(
                    'value' => (int)number_format($parameters['discount_value'] * 100, 0, '', '')
                );
            }
            unset($parameters['discount_value']);
        }
        
        return $parameters;
    }
    
    public function setPayment($payment)
    {
        $this->payment = $payment;
    }
    
    protected function createResponse($data, $statusCode)
    {
        if ($this->payment instanceof \Omnipay\Gerencianet\BankingBillet) {
            return $this->response = new BankingBilletResponse($this, $data, $statusCode);
        } else {
            return $this->response = new Response($this, $data, $statusCode);
        }
    }
}
