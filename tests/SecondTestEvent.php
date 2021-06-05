<?php

namespace Tests;

use Gvera\Events\Event;

class SecondTestEvent extends Event
{
    const EVENT_ID = 'second-event';
    public function __construct()
    {
        $this->setStopPropagation(true);
    }
}