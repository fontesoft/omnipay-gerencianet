<?php

namespace Omnipay\Gerencianet\Message;

class AuthorizeRequest extends AbstractRequest
{
    /**
     * {@inheritdoc}
     */
    public function getData()
    {
        $data = array();
        $items = $this->getItems();
        if ($items) {
            $itemList = array();
            foreach ($items as $item) {
                $itemList[] = array(
                    'name' => $item->getName(),
                    'amount' => $item->getQuantity(),
                    'value' => (int)number_format($item->getPrice() * 100, 0, '', '')
                );
            }
            $data['items'] = $itemList;
        }
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
        return parent::getEndpoint() . '/charge';
    }
}
