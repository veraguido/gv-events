<?php

namespace Tests;

use Exception;
use Gvera\Helpers\events\EventDispatcher;
use Gvera\Helpers\events\EventListenerRegistry;
use PHPUnit\Framework\TestCase;

class TestEvents extends TestCase
{
    /**
     * @test
     */
    public function testEvents()
    {
        $registry = new EventListenerRegistry();
        $registry->registerEventListeners();
        $registry->registerEventListener(SecondTestEvent::EVENT_ID, new SecondTestListener());
        EventDispatcher::addEventListener(SecondTestEvent::EVENT_ID, new TestListener());

        $event = new SecondTestEvent();
        $this->assertTrue($event->hasStopPropagation());

        EventDispatcher::dispatchEvent(SecondTestEvent::EVENT_ID, $event);
        EventDispatcher::removeEventListener(SecondTestEvent::EVENT_ID);

        EventDispatcher::destroyEventListeners();
        $this->assertEmpty(EventDispatcher::$eventsListeners);


        $registry->registerEventListener(TestEvent::EVENT_ID, new TestListener());

        $this->expectException(Exception::class);
        EventDispatcher::dispatchEvent(TestEvent::EVENT_ID, new TestEvent());


    }
}