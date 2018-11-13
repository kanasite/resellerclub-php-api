<?php

namespace kanasite\ResellerClub\APIs;

use kanasite\ResellerClub\Helper;

class Billings
{
    use Helper;

    protected $api = 'billings';

    public function getCustomerBalance($customerId)
    {
        return $this->get('customer-balance', ['customer-id' => $customerId]);
    }

}
