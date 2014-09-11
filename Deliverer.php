<?php

namespace Smoya\Component\Omniata;

/**
 * This Service allows you to deliver custom content to a specific segment
 * of your users at a time you specify using the Omniata Channel API
 *
 * @see https://omniata.atlassian.net/wiki/display/DOC/Channel+API
 * @author Sergio Moya <smoya89@gmail.com>
 */
class Deliverer
{
    /**
     * @var int
     */
    private $timeout;

    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $url;

    public function __construct(Client $client, $url = 'https://api.omniata.com/channel', $timeout = null)
    {
        $this->client = $client;
        $this->url = $url;
        $this->timeout = $timeout;
    }

    /**
     * @param int $chanelId
     * @param int $uid
     * @return array
     */
    public function deliver($chanelId, $uid)
    {
        $response = $this->client->doGet($this->url, $uid, array('channel_id' => $chanelId), $this->timeout);

        if (false !== $response) {
            $content = json_decode($response, true);
            $response = $content['content'];
        }

        return $response;
    }
}
