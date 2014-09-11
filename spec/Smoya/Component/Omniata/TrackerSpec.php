<?php

namespace spec\Smoya\Omniata\Component;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Smoya\Omniata\Component\Client;
use Smoya\Omniata\Component\Event;

class TrackerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Smoya\Component\Omniata\Tracker');
    }

    public function let(Client $client)
    {
        $this->beConstructedWith($client, 'url', 3600);
    }

    public function it_should_allow_track_events(Event $event, Client $client)
    {
        $eventParameters = array('fake_param1' => rand(), 'fake_param2' => md5(rand()), 'fake_param3' => 'foo');

        $event->getType()->willReturn('om_load');
        $event->getParameters()->willReturn($eventParameters);
        $client->doGet(Argument::cetera())->shouldBeCalled();

        $this->track($event, 1)->shouldReturn(null);
    }
}
