<?php
/**
 * This file contains the campaign bounces endpoint for MailWizzApi PHP-SDK.
 *
 * @author Serban George Cristian <cristian.serban@mailwizz.com>
 *
 * @link https://www.mailwizz.com/
 *
 * @copyright 2013-2020 https://www.mailwizz.com/
 */

/**
 * MailWizzApi_Endpoint_CampaignBounces handles all the API calls for campaign bounces.
 *
 * @author Serban George Cristian <cristian.serban@mailwizz.com>
 *
 * @since 1.0
 */
class MailWizzApi_Endpoint_CampaignBounces extends MailWizzApi_Base
{
    /**
     * Get bounces from a certain campaign
     *
     * Note, the results returned by this endpoint can be cached.
     *
     * @param  string  $campaignUid
     * @param  int  $page
     * @param  int  $perPage
     * @return MailWizzApi_Http_Response
     *
     * @throws ReflectionException
     */
    public function getBounces($campaignUid, $page = 1, $perPage = 10)
    {
        $client = new MailWizzApi_Http_Client([
            'method' => MailWizzApi_Http_Client::METHOD_GET,
            'url' => $this->getConfig()->getApiUrl(sprintf('campaigns/%s/bounces', $campaignUid)),
            'paramsGet' => [
                'page' => (int) $page,
                'per_page' => (int) $perPage,
            ],
            'enableCache' => true,
        ]);

        return $response = $client->request();
    }

    /**
     * Create a new bounce in the given campaign
     *
     * @param  string  $campaignUid
     * @return MailWizzApi_Http_Response
     *
     * @throws ReflectionException
     */
    public function create($campaignUid, array $data)
    {
        $client = new MailWizzApi_Http_Client([
            'method' => MailWizzApi_Http_Client::METHOD_POST,
            'url' => $this->getConfig()->getApiUrl(sprintf('campaigns/%s/bounces', (string) $campaignUid)),
            'paramsPost' => $data,
        ]);

        return $response = $client->request();
    }
}
