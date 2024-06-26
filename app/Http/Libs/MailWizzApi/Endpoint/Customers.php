<?php
/**
 * This file contains the customers endpoint for MailWizzApi PHP-SDK.
 *
 * @author Serban George Cristian <cristian.serban@mailwizz.com>
 *
 * @link https://www.mailwizz.com/
 *
 * @copyright 2013-2020 https://www.mailwizz.com/
 */

/**
 * MailWizzApi_Endpoint_Customers handles all the API calls for customers.
 *
 * @author Serban George Cristian <cristian.serban@mailwizz.com>
 *
 * @since 1.0
 */
class MailWizzApi_Endpoint_Customers extends MailWizzApi_Base
{
    /**
     * Create a new mail list for the customer
     *
     * The $data param must contain following indexed arrays:
     * -> customer
     * -> company
     *
     *
     * @return MailWizzApi_Http_Response
     *
     * @throws ReflectionException
     */
    public function create(array $data)
    {
        if (isset($data['customer']['password'])) {
            $data['customer']['confirm_password'] = $data['customer']['password'];
        }

        if (isset($data['customer']['email'])) {
            $data['customer']['confirm_email'] = $data['customer']['email'];
        }

        if (empty($data['customer']['timezone'])) {
            $data['customer']['timezone'] = 'UTC';
        }

        $client = new MailWizzApi_Http_Client([
            'method' => MailWizzApi_Http_Client::METHOD_POST,
            'url' => $this->getConfig()->getApiUrl('customers'),
            'paramsPost' => $data,
        ]);

        return $response = $client->request();
    }
}
