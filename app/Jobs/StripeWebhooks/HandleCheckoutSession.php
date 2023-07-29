<?php

namespace App\Jobs\StripeWebhooks;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Spatie\WebhookClient\Models\WebhookCall;
use Stripe\Event;

class HandleCheckoutSession implements ShouldQueue
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

        $order = Order::where('session_id', $stripeObject->id)->first();

        if ($order && $order->status === 'unpaid') {
            $order->status = 'paid';
            $order->save();
            // Send email to customer
        }

        return response()->json(['success' => true]);
    }
}
