<?php

namespace Smoya\Component\Omniata;

/**
 * This Service allows to track user-generated events via HTTP.
 * The data sent through this interface will be used for building analytics,
 * define segments, etc. using the Omniata Event Api
 *
 * @see https://omniata.atlassian.net/wiki/display/DOC/Event+API
 * @author Sergio Moya <smoya89@gmail.com>
 */
class Tracker
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

    public function __construct(Client $client, $url = 'https://api.omniata.com/event', $timeout = null)
    {
        $this->client = $client;
        $this->url = $url;
        $this->timeout = $timeout;
    }

    public function track(Event $event, $uid)
    {
        $parameters = $event->getParameters();
        $parameters['om_event_type'] = $event->getType();

        $this->client->doGet($this->url, $uid, $parameters, $this->timeout);
    }
}
