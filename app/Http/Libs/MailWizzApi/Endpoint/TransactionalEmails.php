<?php
/**
 * This file contains the transactional emails endpoint for MailWizzApi PHP-SDK.
 *
 * @author Serban George Cristian <cristian.serban@mailwizz.com>
 *
 * @link https://www.mailwizz.com/
 *
 * @copyright 2013-2020 https://www.mailwizz.com/
 */

/**
 * MailWizzApi_Endpoint_TransactionalEmails handles all the API calls for transactional emails.
 *
 * @author Serban George Cristian <cristian.serban@mailwizz.com>
 *
 * @since 1.0
 */
class MailWizzApi_Endpoint_TransactionalEmails extends MailWizzApi_Base
{
    /**
     * Get all transactional emails of the current customer
     *
     * Note, the results returned by this endpoint can be cached.
     *
     * @param  int  $page
     * @param  int  $perPage
     * @return MailWizzApi_Http_Response
     *
     * @throws Exception
     */
    public function getEmails($page = 1, $perPage = 10)
    {
        $client = new MailWizzApi_Http_Client([
            'method' => MailWizzApi_Http_Client::METHOD_GET,
            'url' => $this->getConfig()->getApiUrl('transactional-emails'),
            'paramsGet' => [
                'page' => (int) $page,
                'per_page' => (int) $perPage,
            ],
            'enableCache' => true,
        ]);

        return $response = $client->request();
    }

    /**
     * Get one transactional email
     *
     * Note, the results returned by this endpoint can be cached.
     *
     * @param  string  $emailUid
     * @return MailWizzApi_Http_Response
     *
     * @throws Exception
     */
    public function getEmail($emailUid)
    {
        $client = new MailWizzApi_Http_Client([
            'method' => MailWizzApi_Http_Client::METHOD_GET,
            'url' => $this->getConfig()->getApiUrl(sprintf('transactional-emails/%s', (string) $emailUid)),
            'paramsGet' => [],
            'enableCache' => true,
        ]);

        return $response = $client->request();
    }

    /**
     * Create a new transactional email
     *
     *
     * @return MailWizzApi_Http_Response
     *
     * @throws Exception
     */
    public function create(array $data)
    {
        if (! empty($data['body'])) {
            $data['body'] = base64_encode($data['body']);
        }

        if (! empty($data['plain_text'])) {
            $data['plain_text'] = base64_encode($data['plain_text']);
        }

        $client = new MailWizzApi_Http_Client([
            'method' => MailWizzApi_Http_Client::METHOD_POST,
            'url' => $this->getConfig()->getApiUrl('transactional-emails'),
            'paramsPost' => [
                'email' => $data,
            ],
        ]);

        return $response = $client->request();
    }

    /**
     * Delete existing transactional email
     *
     * @param  string  $emailUid
     * @return MailWizzApi_Http_Response
     *
     * @throws Exception
     */
    public function delete($emailUid)
    {
        $client = new MailWizzApi_Http_Client([
            'method' => MailWizzApi_Http_Client::METHOD_DELETE,
            'url' => $this->getConfig()->getApiUrl(sprintf('transactional-emails/%s', $emailUid)),
        ]);

        return $response = $client->request();
    }
}
