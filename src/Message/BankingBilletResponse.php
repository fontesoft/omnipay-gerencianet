<?php
/**
 * Gerencianet Banking Billet Response
 */

namespace Omnipay\Gerencianet\Message;

use Omnipay\Common\Message\RequestInterface;

/**
 * Gerencianet Banking Billet Response
 */
class BankingBilletResponse extends Response
{
    public function getBarcode()
    {
        if (isset($this->data['data']['barcode'])) {
            return $this->data['data']['barcode'];
        }
        
        return null;
    }
    
    public function getLink()
    {
        if (isset($this->data['data']['link'])) {
            return $this->data['data']['link'];
        }
        return null;
    }
}
