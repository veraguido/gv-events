<?php


namespace Tests;


use Exception;
use Gvera\Events\Event;

class TestListener implements \Gvera\Listeners\EventListenerInterface
{

    /**
     * @param Event $event
     * @throws Exception
     */
    public function handleEvent(Event $event)
    {
        throw new Exception('event fired!');
    }
}