<?php

namespace App\Services\Subscription;

use App\Entities\Subscription;
use App\Entities\ScheduledOrder;

class GetScheduledOrders
{
    /**
     * Handle generating the array of scheduled orders for the given number of weeks and subscription.
     *
     * @param \App\Entities\Subscription $subscription
     * @param int                        $forNumberOfWeeks
     *
     * @return array
     */
    public function handle(Subscription $subscription, $forNumberOfWeeks = 6)
    {
        $scheduledOrders = [];
        if ($subscription->getStatus() == "Cancelled") {
            return $scheduledOrders;
        }

        for ($i = 0; $i < $forNumberOfWeeks; $i++) {
            $nextDeliveryDate = (new \Carbon\Carbon($subscription->getNextDeliveryDate()))->startOfDay();
            if ($subscription->getPlan() == "Fortnightly") {
                $scheduledOrder = new ScheduledOrder($nextDeliveryDate->addWeek($i), $i%2 == 0);
            } else {
                $scheduledOrder = new ScheduledOrder($nextDeliveryDate->addWeek($i), true);
            }
            $scheduledOrders[] = $scheduledOrder;
        }

        return $scheduledOrders;
    }
}