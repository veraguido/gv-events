<?php
namespace Gvera\Helpers\events;

use Gvera\Events\Event;
use Gvera\Listeners\EventListenerInterface;

/**
 * Class EventDispatcher
 * @package Gvera\Helpers\events
 * Event listeners are registered through the dispatcher, and the callbacks are handled in this class as well.
 */
class EventDispatcher
{
    public static array $eventsListeners = [];

    public static function addEventListener(string $eventId, EventListenerInterface $listener)
    {
        if (isset(self::$eventsListeners[$eventId]) && is_iterable(self::$eventsListeners[$eventId])) {
            array_push(self::$eventsListeners[$eventId], $listener);
            return;
        }

        self::$eventsListeners[$eventId] = [$listener];
    }

    public static function dispatchEvent($eventId, Event $event)
    {
        $listeners = isset(self::$eventsListeners[$eventId]) ? self::$eventsListeners[$eventId] : [];
        foreach ($listeners as $listener) {
            $listener->handleEvent($event);
            if ($event->hasStopPropagation()) {
                break;
            }
        }
    }

    public static function removeEventListener(string $eventId)
    {
        unset(self::$eventsListeners[$eventId]);
    }

    public static function destroyEventListeners()
    {
        self::$eventsListeners = [];
    }
}
