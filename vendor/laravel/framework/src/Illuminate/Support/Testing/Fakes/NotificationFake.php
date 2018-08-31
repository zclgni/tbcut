<?php

namespace Illuminate\Support\Testing\Fakes;

use Ramsey\Uuid\Uuid;
use Illuminate\Support\Collection;
use PHPUnit\Framework\Assert as PHPUnit;
use Illuminate\Contracts\Notifications\Factory as NotificationFactory;
use Illuminate\Contracts\Notifications\Dispatcher as NotificationDispatcher;

class NotificationFake implements NotificationFactory, NotificationDispatcher
{
    /**
     * All of the notifications that have been sent.
     *
     * @var array
     */
    protected $notifications = [];

    /**
     * Assert if a notification was sent based on a truth-test callback.
     *
     * @param  mixed  $notifiable
     * @param  string  $notification
     * @param  callable|null  $callback
     * @return void
     */
    public function assertSentTo($notifiable, $notification, $callback = null)
    {
        if (is_array($notifiable) || $notifiable instanceof Collection) {
            foreach ($notifiable as $singleNotifiable) {
                $this->assertSentTo($singleNotifiable, $notification, $callback);
            }

            return;
        }

        if (is_numeric($callback)) {
            return $this->assertSentToTimes($notifiable, $notification, $callback);
        }

        PHPUnit::assertTrue(
            $this->sent($notifiable, $notification, $callback)->count() > 0,
            "The expected [{$notification}] notification was not sent."
        );
    }

    /**
     * Assert if a notification was sent a number of times.
     *
     * @param  mixed  $notifiable
     * @param  string  $notification
     * @param  int  $times
     * @return void
     */
    public function assertSentToTimes($notifiable, $notification, $times = 1)
    {
        PHPUnit::assertTrue(
            ($count = $this->sent($notifiable, $notification)->count()) === $times,
            "The expected [{$notification}] notification was sent {$count} times instead of {$times} times."
        );
    }

    /**
     * Determine if a notification was sent based on a truth-test callback.
     *
     * @param  mixed  $notifiable
     * @param  string  $notification
     * @param  callable|null  $callback
     * @return void
     */
    public function assertNotSentTo($notifiable, $notification, $callback = null)
    {
        if (is_array($notifiable) || $notifiable instanceof Collection) {
            foreach ($notifiable as $singleNotifiable) {
                $this->assertNotSentTo($singleNotifiable, $notification, $callback);
            }

            return;
        }

        PHPUnit::assertTrue(
            $this->sent($notifiable, $notification, $callback)->count() === 0,
            "The unexpected [{$notification}] notification was sent."
        );
    }

    /**
     * Assert that no notifications were sent.
     *
     * @return void
     */
    public function assertNothingSent()
    {
        PHPUnit::assertEmpty($this->notifications, 'Notifications were sent unexpectedly.');
    }

    /**
     * Get all of the notifications matching a truth-test callback.
     *
     * @param  mixed  $notifiable
     * @param  string  $notification
     * @param  callable|null  $callback
     * @return \Illuminate\Support\Collection
     */
    public function sent($notifiable, $notification, $callback = null)
    {
        if (! $this->hasSent($notifiable, $notification)) {
            return collect();
        }

        $callback = $callback ?: function () {
            return true;
        };

        $notifications = collect($this->notificationsFor($notifiable, $notification));

        return $notifications->filter(function ($arguments) use ($callback) {
            return $callback(...array_values($arguments));
        })->pluck('notification');
    }

    /**
     * Determine if there are more notifications left to inspect.
     *
     * @param  mixed  $notifiable
     * @param  string  $notification
     * @return bool
     */
    public function hasSent($notifiable, $notification)
    {
        return ! empty($this->notificationsFor($notifiable, $notification));
    }

    /**
     * Get all of the notifications for a notifiable entity by type.
     *
     * @param  mixed  $notifiable
     * @param  string  $notification
     * @return array
     */
    protected function notificationsFor($notifiable, $notification)
    {
        if (isset($this->notifications[get_class($notifiable)][$notifiable->getKey()][$notification])) {
            return $this->notifications[get_class($notifiable)][$notifiable->getKey()][$notification];
        }

        return [];
    }

    /**
     * Send the given notification to the given notifiable entities.
     *
     * @param  \Illuminate\Support\Collection|array|mixed  $notifiables
     * @param  mixed  $notification
     * @return void
     */
    public function send($notifiables, $notification)
    {
        return $this->sendNow($notifiables, $notification);
    }

    /**
     * Send the given notification immediately.
     *
     * @param  \Illuminate\Support\Collection|array|mixed  $notifiables
     * @param  mixed  $notification
     * @return void
     */
    public function sendNow($notifiables, $notification)
    {
        if (! $notifiables instanceof Collection && ! is_array($notifiables)) {
            $notifiables = [$notifiables];
        }

        foreach ($notifiables as $notifiable) {
            $notification->id = Uuid::uuid4()->toString();

            $this->notifications[get_class($notifiable)][$notifiable->getKey()][get_class($notification)][] = [
                'notification' => $notification,
                'channels' => $notification->via($notifiable),
                'notifiable' => $notifiable,
            ];
        }
    }

    /**
     * Get a channel instance by name.
     *
     * @param  string|null  $name
     * @return mixed
     */
    public function channel($name = null)
    {
        //
    }
}
