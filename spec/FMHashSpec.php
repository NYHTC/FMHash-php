<?php

namespace spec;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FMHashSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('FMHash');
    }

    function it_creates_a_hash_from_a_key_value_pair()
    {
    	$this::make('foo', 'bar')->shouldReturn('<:foo:=bar:>');
    }

    function it_gets_a_value_from_a_hash_by_key()
    {
    	$this::get('<:foo:=bar:>', 'foo')->shouldReturn('bar');
    }
}
