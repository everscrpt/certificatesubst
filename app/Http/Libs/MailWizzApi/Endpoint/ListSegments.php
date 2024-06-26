<?php
/**
 * This file contains the list segments endpoint for MailWizzApi PHP-SDK.
 *
 * @author Serban George Cristian <cristian.serban@mailwizz.com>
 *
 * @link https://www.mailwizz.com/
 *
 * @copyright 2013-2020 https://www.mailwizz.com/
 */

/**
 * MailWizzApi_Endpoint_ListSegments handles all the API calls for handling the list segments.
 *
 * @author Serban George Cristian <cristian.serban@mailwizz.com>
 *
 * @since 1.0
 */
class MailWizzApi_Endpoint_ListSegments extends MailWizzApi_Base
{
    /**
     * Get segments from a certain mail list
     *
     * Note, the results returned by this endpoint can be cached.
     *
     * @param  string  $listUid
     * @param  int  $page
     * @param  int  $perPage
     * @return MailWizzApi_Http_Response
     *
     * @throws ReflectionException
     */
    public function getSegments($listUid, $page = 1, $perPage = 10)
    {
        $client = new MailWizzApi_Http_Client([
            'method' => MailWizzApi_Http_Client::METHOD_GET,
            'url' => $this->getConfig()->getApiUrl(sprintf('lists/%s/segments', $listUid)),
            'paramsGet' => [
                'page' => (int) $page,
                'per_page' => (int) $perPage,
            ],
            'enableCache' => true,
        ]);

        return $response = $client->request();
    }
}
