<?php

namespace App\Jobs\StripeWebhooks;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\WebhookClient\Models\WebhookCall;
use Stripe\Event;

class HandleCustomerSubscriptionUpdated implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /** @var \Spatie\WebhookClient\Models\WebhookCall */
    public $webhookCall;

    public function __construct(WebhookCall $webhookCall)
    {
        $this->webhookCall = $webhookCall;
    }

    public function handle()
    {
        $stripeObject = Event::constructFrom($this->webhookCall->payload)->data?->object;

        $user = User::where('stripe_id', $stripeObject->customer)->first();

        if ($user) {
            $data = $stripeObject->toArray();

            $user->subscriptions()->where('stripe_id', $data['id'])->update([
                'stripe_status' => $data['status'],
            ]);
        }

        return response()->json(['success' => true]);
    }
}
