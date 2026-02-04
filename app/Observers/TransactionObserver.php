<?php

namespace App\Observers;

use App\Enums\TxnStatus;
use App\Enums\TxnType;
use App\Models\Transaction;
use App\Traits\NotifyTrait;

class TransactionObserver
{
    use NotifyTrait;

    /**
     * Handle the Transaction "created" event.
     */
    public function created(Transaction $transaction): void
    {
        // Only send emails for successful transactions
        if ($transaction->status !== TxnStatus::Success) {
            return;
        }

        $this->sendTransactionEmail($transaction);
    }

    /**
     * Handle the Transaction "updated" event.
     */
    public function updated(Transaction $transaction): void
    {
        // Send email when transaction status changes to Success
        if ($transaction->isDirty('status') && $transaction->status === TxnStatus::Success) {
            $this->sendTransactionEmail($transaction);
        }
    }

    /**
     * Send appropriate email based on transaction type
     */
    protected function sendTransactionEmail(Transaction $transaction): void
    {
        $user = $transaction->user;
        
        if (!$user || !$user->email) {
            return;
        }

        $currency = setting('site_currency', 'global');
        $shortcodes = $this->getBaseShortcodes($transaction, $user, $currency);

        switch ($transaction->type) {
            case TxnType::Deposit:
            case TxnType::ManualDeposit:
                // All deposits (user or admin) send deposit email
                $this->sendDepositEmail($transaction, $user, $shortcodes);
                break;

            case TxnType::Withdraw:
            case TxnType::WithdrawAuto:
            case TxnType::Subtract:
                // All withdrawals and subtractions send withdrawal email
                $this->sendWithdrawalEmail($transaction, $user, $shortcodes);
                break;

            case TxnType::SendMoney:
            case TxnType::FundTransfer:
                $this->sendTransferSentEmail($transaction, $user, $shortcodes);
                break;

            case TxnType::ReceiveMoney:
                $this->sendTransferReceivedEmail($transaction, $user, $shortcodes);
                break;
        }
    }

    /**
     * Get base shortcodes for all transaction emails
     */
    protected function getBaseShortcodes(Transaction $transaction, $user, string $currency): array
    {
        return [
            '[[full_name]]' => $user->full_name,
            '[[amount]]' => number_format($transaction->amount, 2),
            '[[currency]]' => $currency,
            '[[txn_id]]' => $transaction->tnx,
            '[[new_balance]]' => number_format($user->balance, 2),
            '[[date]]' => $transaction->created_at->format('M d, Y h:i A'),
            '[[description]]' => $transaction->description,
            '[[method]]' => $transaction->method,
            '[[charge]]' => number_format($transaction->charge, 2),
            '[[dashboard_link]]' => route('user.dashboard'),
            '[[site_title]]' => setting('site_title', 'global'),
            '[[site_url]]' => route('home'),
        ];
    }

    /**
     * Send deposit success email
     */
    protected function sendDepositEmail(Transaction $transaction, $user, array $shortcodes): void
    {
        try {
            $this->mailNotify($user->email, 'deposit_successful', $shortcodes);
            $this->pushNotify('deposit_successful', $shortcodes, route('user.deposit.log'), $user->id);
        } catch (\Exception $e) {
            \Log::error('Failed to send deposit email: ' . $e->getMessage());
        }
    }

    /**
     * Send withdrawal success email
     */
    protected function sendWithdrawalEmail(Transaction $transaction, $user, array $shortcodes): void
    {
        try {
            $this->mailNotify($user->email, 'withdrawal_successful', $shortcodes);
            $this->pushNotify('withdrawal_successful', $shortcodes, route('user.withdraw.log'), $user->id);
        } catch (\Exception $e) {
            \Log::error('Failed to send withdrawal email: ' . $e->getMessage());
        }
    }

    /**
     * Send transfer sent email
     */
    protected function sendTransferSentEmail(Transaction $transaction, $user, array $shortcodes): void
    {
        try {
            // Get recipient info
            $recipient = $transaction->fromUser ?? null;
            $shortcodes['[[recipient]]'] = $recipient ? $recipient->full_name : 'Recipient';
            
            $this->mailNotify($user->email, 'transfer_sent', $shortcodes);
            $this->pushNotify('transfer_sent', $shortcodes, route('user.transfer.log'), $user->id);
        } catch (\Exception $e) {
            \Log::error('Failed to send transfer sent email: ' . $e->getMessage());
        }
    }

    /**
     * Send transfer received email
     */
    protected function sendTransferReceivedEmail(Transaction $transaction, $user, array $shortcodes): void
    {
        try {
            // Get sender info
            $sender = $transaction->fromUser ?? null;
            $shortcodes['[[sender]]'] = $sender ? $sender->full_name : 'Someone';
            
            $this->mailNotify($user->email, 'transfer_received', $shortcodes);
            $this->pushNotify('transfer_received', $shortcodes, route('user.dashboard'), $user->id);
        } catch (\Exception $e) {
            \Log::error('Failed to send transfer received email: ' . $e->getMessage());
        }
    }

    /**
     * Send balance added email (admin action)
     */
    protected function sendBalanceAddedEmail(Transaction $transaction, $user, array $shortcodes): void
    {
        try {
            $this->mailNotify($user->email, 'balance_added', $shortcodes);
            $this->pushNotify('balance_added', $shortcodes, route('user.dashboard'), $user->id);
        } catch (\Exception $e) {
            \Log::error('Failed to send balance added email: ' . $e->getMessage());
        }
    }

    /**
     * Send balance subtracted email (admin action)
     */
    protected function sendBalanceSubtractedEmail(Transaction $transaction, $user, array $shortcodes): void
    {
        try {
            $this->mailNotify($user->email, 'balance_subtracted', $shortcodes);
            $this->pushNotify('balance_subtracted', $shortcodes, route('user.dashboard'), $user->id);
        } catch (\Exception $e) {
            \Log::error('Failed to send balance subtracted email: ' . $e->getMessage());
        }
    }
}
