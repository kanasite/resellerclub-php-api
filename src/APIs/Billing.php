<?php

namespace kanasite\ResellerClub\APIs;

use kanasite\ResellerClub\Helper;

class Billing
{
    use Helper;

    protected $api = 'billing';

    public function getCustomerBalance($customerId)
    {
        return $this->get('customer-balance', ['customer-id' => $customerId]);
    }

}
