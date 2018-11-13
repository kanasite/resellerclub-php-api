<?php

namespace kanasite\ResellerClub;

use kanasite\ResellerClub\APIs\Contacts;
use kanasite\ResellerClub\APIs\Customers;
use kanasite\ResellerClub\APIs\Domains;
use GuzzleHttp\Client as Guzzle;
use kanasite\ResellerClub\APIs\Products;

class ResellerClub
{
    const API_URL      = 'https://httpapi.com/api/';
    const API_TEST_URL = 'https://test.httpapi.com/api/';

    /**
     * @var Guzzle
     */
    private $guzzle;

    /**
     * List of API classes
     * @var array
     */
    private $apiList = [];

    /**
     * Authentication info needed for every request
     * @var array
     */
    private $authentication = [];

    public function __construct($userId, $apiKey, $testMode = FALSE, $timeout = 0)
    {
        $this->authentication = [
            'auth-userid' => $userId,
            'api-key'     => $apiKey,
        ];

        $this->guzzle = new Guzzle(
            [
                'base_uri' => $testMode ? self::API_TEST_URL : self::API_URL,
                'defaults' => [
                    'query' => $this->authentication,
                ],
                'verify'   => FALSE,
                'connect_timeout' => (float)$timeout,
                'timeout' => (float)$timeout,
            ]
        );
    }

    private function _getAPI($api)
    {
        if (empty($this->apiList[$api])) {
            $class               = 'kanasite\\ResellerClub\\APIs\\' . $api;
            $this->apiList[$api] = new $class($this->guzzle, $this->authentication);
        }

        return $this->apiList[$api];
    }

    /**
     * @return Domains
     */
    public function domains()
    {
        return $this->_getAPI('Domains');
    }

    /**
     * @return Contacts
     */
    public function contacts()
    {
        return $this->_getAPI('Contacts');
    }

    /**
     * @return Customers
     */
    public function customers()
    {
        return $this->_getAPI('Customers');
    }

    /**
     * @return Products
     */
    public function products()
    {
        return $this->_getAPI('Products');
    }

    /**
     * @return Billings
     */
    public function billings()
    {
        return $this->_getAPI('Billings');
    }
}
