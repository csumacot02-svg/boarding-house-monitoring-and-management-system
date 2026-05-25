<?php

namespace App\Console\Commands;

use App\Models\Billing;
use App\Services\SemaphoreSmsService;
use Illuminate\Console\Command;

class SendBillingDueSms extends Command
{
    protected $signature = 'billing:send-due-sms';
    protected $description = 'Send SMS reminders to tenants 2-3 days before due date';

    public function handle(SemaphoreSmsService $sms): int
    {
        $billings = Billing::with('tenant')
            ->whereIn('status', ['Unpaid', 'Partial'])
            ->whereNull('sms_reminder_sent_at')
            ->whereBetween('due_date', [
                now()->addDays(2)->toDateString(),
                now()->addDays(3)->toDateString(),
            ])
            ->get();

        foreach ($billings as $billing) {
            if (! $billing->tenant || empty($billing->tenant->phone)) {
                continue;
            }

            $message = "Hello {$billing->tenant->name}, your boarding house bill of PHP {$billing->amount} is due on {$billing->due_date->format('M d, Y')}. Please settle your payment on time. Thank you.";

            if ($sms->send($billing->tenant->phone, $message)) {
                $billing->update([
                    'sms_reminder_sent_at' => now(),
                ]);

                $this->info("SMS sent to {$billing->tenant->name}");
            }
        }

        return self::SUCCESS;
    }
}