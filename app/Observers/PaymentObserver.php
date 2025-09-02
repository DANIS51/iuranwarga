<?php

namespace App\Observers;

use App\Models\Payment;
use App\Models\DuesMember;

class PaymentObserver
{
    /**
     * Handle the Payment "created" event.
     */
    public function created(Payment $payment): void
    {
        $this->updateDuesMemberStatus($payment);
    }

    /**
     * Handle the Payment "updated" event.
     */
    public function updated(Payment $payment): void
    {
        $this->updateDuesMemberStatus($payment);
    }

    /**
     * Handle the Payment "deleted" event.
     */
    public function deleted(Payment $payment): void
    {
        $this->updateDuesMemberStatus($payment);
    }

    /**
     * Update the status of the related DuesMember based on total payments.
     */
    protected function updateDuesMemberStatus(Payment $payment): void
    {
        $member = DuesMember::find($payment->idmember);
        if (!$member) {
            return;
        }

        $totalPaid = $member->payments()->where('status', 'completed')->sum('nominal');
        $expectedAmount = $member->duesCategory ? $member->duesCategory->nominal : 0;

        if ($totalPaid >= $expectedAmount) {
            $status = 'lunas';
        } elseif ($totalPaid > 0) {
            $status = 'sebagian';
        } else {
            $status = 'belum_bayar';
        }

        if ($member->status !== $status) {
            $member->status = $status;
            $member->save();
        }
    }
}
