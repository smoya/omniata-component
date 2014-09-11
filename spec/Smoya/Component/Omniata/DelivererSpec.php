<?php

namespace spec\Smoya\Component\Omniata;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Smoya\Component\Omniata\Client;

class DelivererSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Smoya\Component\Omniata\Deliverer');
    }

    public function let(Client $client)
    {
        $this->beConstructedWith($client, 'url', 3600);
    }

    public function it_should_allow_to_deliver_info_from_channels(Client $client)
    {
        $client->doGet(Argument::cetera())->willReturn('{ "content": [] }');

        $this->deliver('fake', 1)->shouldReturn(array());
    }

    public function it_should_return_false_when_the_client_has_an_error(Client $client)
    {
        $client->doGet(Argument::cetera())->willReturn(false);

        $this->deliver('fake', 1)->shouldReturn(false);
    }
}
