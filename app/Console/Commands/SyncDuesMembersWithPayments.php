<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Payment;
use App\Models\DuesMember;

class SyncDuesMembersWithPayments extends Command
{
    protected $signature = 'sync:dues-members-payments';

    protected $description = 'Sync dues_members status and idpayment based on payments';

    public function handle()
    {
        $payments = Payment::all();

        foreach ($payments as $payment) {
            $userId = $payment->iduser;
            $categoryId = $payment->idduescategory;
            $paymentId = $payment->id;
            $nominal = $payment->nominal;

            $categoryNominal = $payment->duesCategory ? $payment->duesCategory->nominal : 0;
            if ($categoryNominal == 0) {
                $this->warn("Payment ID {$paymentId} has zero nominal category, skipping.");
                continue;
            }

            $monthsPaid = floor($nominal / $categoryNominal);
            $paymentDate = $payment->payment_date ? date('Y-m', strtotime($payment->payment_date)) : null;

            if (!$paymentDate) {
                $this->warn("Payment ID {$paymentId} has no payment_date, skipping.");
                continue;
            }

            for ($i = 0; $i < $monthsPaid; $i++) {
                $month = date('Y-m', strtotime($paymentDate . " +{$i} month"));

                $duesMember = DuesMember::where('iduser', $userId)
                    ->where('idduescategory', $categoryId)
                    ->where('bulan', $month)
                    ->first();

                if ($duesMember) {
                    $duesMember->status = 'lunas';
                    $duesMember->idpayment = $paymentId;
                    $duesMember->tanggal_bayar = $payment->payment_date;
                    $duesMember->save();

                    $this->info("Updated dues_member ID {$duesMember->id} for month {$month}");
                } else {
                    // Create dues_member if not exists
                    DuesMember::create([
                        'iduser' => $userId,
                        'idduescategory' => $categoryId,
                        'bulan' => $month,
                        'status' => 'lunas',
                        'idpayment' => $paymentId,
                        'tanggal_bayar' => $payment->payment_date,
                    ]);
                    $this->info("Created dues_member for user {$userId}, month {$month}");
                }
            }
        }

        $this->info('Sync completed.');
        return 0;
    }
}
