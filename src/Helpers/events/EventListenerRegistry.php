<?php
namespace Gvera\Helpers\events;

use Gvera\Events\ThrowableFiredEvent;
use Gvera\Events\UserRegisteredEvent;
use Gvera\Helpers\dependencyInjection\DIContainer;
use Gvera\Listeners\EventListenerInterface;
use ReflectionException;

/**
 * Class EventListenerRegistry
 * @package Gvera\Helpers\events
 * All event listeners should be added to this registry
 */
class EventListenerRegistry
{
    public function registerEventListeners()
    {
    }

    public function registerEventListener(string $eventId, EventListenerInterface $listener)
    {
        EventDispatcher::addEventListener($eventId, $listener);
    }
}
