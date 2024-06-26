<?php
/**
 * This file contains the lists fields endpoint for MailWizzApi PHP-SDK.
 *
 * @author Serban George Cristian <cristian.serban@mailwizz.com>
 *
 * @link https://www.mailwizz.com/
 *
 * @copyright 2013-2020 https://www.mailwizz.com/
 */

/**
 * MailWizzApi_Endpoint_ListFields handles all the API calls for handling the list custom fields.
 *
 * @author Serban George Cristian <cristian.serban@mailwizz.com>
 *
 * @since 1.0
 */
class MailWizzApi_Endpoint_ListFields extends MailWizzApi_Base
{
    /**
     * Get fields from a certain mail list
     *
     * Note, the results returned by this endpoint can be cached.
     *
     * @param  string  $listUid
     * @return MailWizzApi_Http_Response
     *
     * @throws ReflectionException
     */
    public function getFields($listUid)
    {
        $client = new MailWizzApi_Http_Client([
            'method' => MailWizzApi_Http_Client::METHOD_GET,
            'url' => $this->getConfig()->getApiUrl(sprintf('lists/%s/fields', $listUid)),
            'paramsGet' => [],
            'enableCache' => true,
        ]);

        return $response = $client->request();
    }
}
