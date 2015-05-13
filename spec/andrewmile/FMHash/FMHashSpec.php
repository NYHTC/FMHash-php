<?php

namespace spec\andrewmile\FMHash;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FMHashSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('andrewmile\FMHash\FMHash');
    }

    function it_creates_a_hash_from_a_key_value_pair()
    {
    	$this::make('foo', 'bar')->shouldReturn('<:foo:=bar:>');
    }

    function it_gets_a_value_from_a_hash_by_key()
    {
    	$this::get('<:foo:=bar:>', 'foo')->shouldReturn('bar');
    }

    function it_accepts_an_array_to_make_a_hash()
    {
        $this::make(['foo' => 'bar', 'bazz' => 'buzz'])
            ->shouldReturn('<:foo:=bar:><:bazz:=buzz:>');
    }
}
