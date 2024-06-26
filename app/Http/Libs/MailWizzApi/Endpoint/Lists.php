<?php
/**
 * This file contains the lists endpoint for MailWizzApi PHP-SDK.
 *
 * @author Serban George Cristian <cristian.serban@mailwizz.com>
 *
 * @link https://www.mailwizz.com/
 *
 * @copyright 2013-2020 https://www.mailwizz.com/
 */

/**
 * MailWizzApi_Endpoint_Lists handles all the API calls for lists.
 *
 * @author Serban George Cristian <cristian.serban@mailwizz.com>
 *
 * @since 1.0
 */
class MailWizzApi_Endpoint_Lists extends MailWizzApi_Base
{
    /**
     * Get all the mail list of the current customer
     *
     * Note, the results returned by this endpoint can be cached.
     *
     * @param  int  $page
     * @param  int  $perPage
     * @return MailWizzApi_Http_Response
     *
     * @throws ReflectionException
     */
    public function getLists($page = 1, $perPage = 10)
    {
        $client = new MailWizzApi_Http_Client([
            'method' => MailWizzApi_Http_Client::METHOD_GET,
            'url' => $this->getConfig()->getApiUrl('lists'),
            'paramsGet' => [
                'page' => (int) $page,
                'per_page' => (int) $perPage,
            ],
            'enableCache' => true,
        ]);

        return $response = $client->request();
    }

    /**
     * Get one list
     *
     * Note, the results returned by this endpoint can be cached.
     *
     * @param  string  $listUid
     * @return MailWizzApi_Http_Response
     *
     * @throws ReflectionException
     */
    public function getList($listUid)
    {
        $client = new MailWizzApi_Http_Client([
            'method' => MailWizzApi_Http_Client::METHOD_GET,
            'url' => $this->getConfig()->getApiUrl(sprintf('lists/%s', (string) $listUid)),
            'paramsGet' => [],
            'enableCache' => true,
        ]);

        return $response = $client->request();
    }

    /**
     * Create a new mail list for the customer
     *
     * The $data param must contain following indexed arrays:
     * -> general
     * -> defaults
     * -> notifications
     * -> company
     *
     *
     * @return MailWizzApi_Http_Response
     *
     * @throws ReflectionException
     */
    public function create(array $data)
    {
        $client = new MailWizzApi_Http_Client([
            'method' => MailWizzApi_Http_Client::METHOD_POST,
            'url' => $this->getConfig()->getApiUrl('lists'),
            'paramsPost' => $data,
        ]);

        return $response = $client->request();
    }

    /**
     * Update existing mail list for the customer
     *
     * The $data param must contain following indexed arrays:
     * -> general
     * -> defaults
     * -> notifications
     * -> company
     *
     * @param  string  $listUid
     * @return MailWizzApi_Http_Response
     *
     * @throws ReflectionException
     */
    public function update($listUid, array $data)
    {
        $client = new MailWizzApi_Http_Client([
            'method' => MailWizzApi_Http_Client::METHOD_PUT,
            'url' => $this->getConfig()->getApiUrl(sprintf('lists/%s', $listUid)),
            'paramsPut' => $data,
        ]);

        return $response = $client->request();
    }

    /**
     * Copy existing mail list for the customer
     *
     * @param  string  $listUid
     * @return MailWizzApi_Http_Response
     *
     * @throws ReflectionException
     */
    public function copy($listUid)
    {
        $client = new MailWizzApi_Http_Client([
            'method' => MailWizzApi_Http_Client::METHOD_POST,
            'url' => $this->getConfig()->getApiUrl(sprintf('lists/%s/copy', $listUid)),
        ]);

        return $response = $client->request();
    }

    /**
     * Delete existing mail list for the customer
     *
     * @param  string  $listUid
     * @return MailWizzApi_Http_Response
     *
     * @throws ReflectionException
     */
    public function delete($listUid)
    {
        $client = new MailWizzApi_Http_Client([
            'method' => MailWizzApi_Http_Client::METHOD_DELETE,
            'url' => $this->getConfig()->getApiUrl(sprintf('lists/%s', $listUid)),
        ]);

        return $response = $client->request();
    }
}
