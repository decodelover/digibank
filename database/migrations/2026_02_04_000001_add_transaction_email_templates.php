<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Balance Added (by admin or system)
        DB::table('email_templates')->insert([
            'name' => 'Balance Added',
            'code' => 'balance_added',
            'for' => 'User',
            'banner' => null,
            'subject' => 'Funds Added to Your Account',
            'title' => 'Funds Credited Successfully',
            'salutation' => 'Hi [[full_name]],',
            'message_body' => 'Great news! Your account has been credited.<br><br>
                <table style="width:100%;border-collapse:collapse;">
                    <tr><td style="padding:10px;border:1px solid #ddd;"><strong>Amount:</strong></td><td style="padding:10px;border:1px solid #ddd;">[[amount]] [[currency]]</td></tr>
                    <tr><td style="padding:10px;border:1px solid #ddd;"><strong>Transaction ID:</strong></td><td style="padding:10px;border:1px solid #ddd;">[[txn_id]]</td></tr>
                    <tr><td style="padding:10px;border:1px solid #ddd;"><strong>New Balance:</strong></td><td style="padding:10px;border:1px solid #ddd;">[[new_balance]] [[currency]]</td></tr>
                    <tr><td style="padding:10px;border:1px solid #ddd;"><strong>Date:</strong></td><td style="padding:10px;border:1px solid #ddd;">[[date]]</td></tr>
                    <tr><td style="padding:10px;border:1px solid #ddd;"><strong>Description:</strong></td><td style="padding:10px;border:1px solid #ddd;">[[description]]</td></tr>
                </table><br>
                If you did not authorize this transaction, please contact support immediately.',
            'button_level' => 'View Dashboard',
            'button_link' => '[[dashboard_link]]',
            'footer_status' => 1,
            'footer_body' => 'Regards,<br>[[site_title]]',
            'bottom_status' => 0,
            'bottom_title' => '',
            'bottom_body' => '',
            'short_codes' => '["[[full_name]]","[[amount]]","[[currency]]","[[txn_id]]","[[new_balance]]","[[date]]","[[description]]","[[dashboard_link]]","[[site_title]]","[[site_url]]"]',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Balance Subtracted (by admin or system)
        DB::table('email_templates')->insert([
            'name' => 'Balance Subtracted',
            'code' => 'balance_subtracted',
            'for' => 'User',
            'banner' => null,
            'subject' => 'Funds Deducted from Your Account',
            'title' => 'Funds Debited from Your Account',
            'salutation' => 'Hi [[full_name]],',
            'message_body' => 'A deduction has been made from your account.<br><br>
                <table style="width:100%;border-collapse:collapse;">
                    <tr><td style="padding:10px;border:1px solid #ddd;"><strong>Amount:</strong></td><td style="padding:10px;border:1px solid #ddd;">[[amount]] [[currency]]</td></tr>
                    <tr><td style="padding:10px;border:1px solid #ddd;"><strong>Transaction ID:</strong></td><td style="padding:10px;border:1px solid #ddd;">[[txn_id]]</td></tr>
                    <tr><td style="padding:10px;border:1px solid #ddd;"><strong>New Balance:</strong></td><td style="padding:10px;border:1px solid #ddd;">[[new_balance]] [[currency]]</td></tr>
                    <tr><td style="padding:10px;border:1px solid #ddd;"><strong>Date:</strong></td><td style="padding:10px;border:1px solid #ddd;">[[date]]</td></tr>
                    <tr><td style="padding:10px;border:1px solid #ddd;"><strong>Description:</strong></td><td style="padding:10px;border:1px solid #ddd;">[[description]]</td></tr>
                </table><br>
                If you did not authorize this transaction, please contact support immediately.',
            'button_level' => 'View Dashboard',
            'button_link' => '[[dashboard_link]]',
            'footer_status' => 1,
            'footer_body' => 'Regards,<br>[[site_title]]',
            'bottom_status' => 0,
            'bottom_title' => '',
            'bottom_body' => '',
            'short_codes' => '["[[full_name]]","[[amount]]","[[currency]]","[[txn_id]]","[[new_balance]]","[[date]]","[[description]]","[[dashboard_link]]","[[site_title]]","[[site_url]]"]',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Deposit Successful
        DB::table('email_templates')->insert([
            'name' => 'Deposit Successful',
            'code' => 'deposit_successful',
            'for' => 'User',
            'banner' => null,
            'subject' => 'Deposit Successful - [[amount]] [[currency]]',
            'title' => 'Deposit Confirmed',
            'salutation' => 'Hi [[full_name]],',
            'message_body' => 'Your deposit has been successfully processed.<br><br>
                <table style="width:100%;border-collapse:collapse;">
                    <tr><td style="padding:10px;border:1px solid #ddd;"><strong>Amount:</strong></td><td style="padding:10px;border:1px solid #ddd;">[[amount]] [[currency]]</td></tr>
                    <tr><td style="padding:10px;border:1px solid #ddd;"><strong>Payment Method:</strong></td><td style="padding:10px;border:1px solid #ddd;">[[method]]</td></tr>
                    <tr><td style="padding:10px;border:1px solid #ddd;"><strong>Transaction ID:</strong></td><td style="padding:10px;border:1px solid #ddd;">[[txn_id]]</td></tr>
                    <tr><td style="padding:10px;border:1px solid #ddd;"><strong>New Balance:</strong></td><td style="padding:10px;border:1px solid #ddd;">[[new_balance]] [[currency]]</td></tr>
                    <tr><td style="padding:10px;border:1px solid #ddd;"><strong>Date:</strong></td><td style="padding:10px;border:1px solid #ddd;">[[date]]</td></tr>
                </table><br>
                Thank you for using our services!',
            'button_level' => 'View Transaction',
            'button_link' => '[[dashboard_link]]',
            'footer_status' => 1,
            'footer_body' => 'Regards,<br>[[site_title]]',
            'bottom_status' => 0,
            'bottom_title' => '',
            'bottom_body' => '',
            'short_codes' => '["[[full_name]]","[[amount]]","[[currency]]","[[method]]","[[txn_id]]","[[new_balance]]","[[date]]","[[dashboard_link]]","[[site_title]]","[[site_url]]"]',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Withdrawal Successful
        DB::table('email_templates')->insert([
            'name' => 'Withdrawal Successful',
            'code' => 'withdrawal_successful',
            'for' => 'User',
            'banner' => null,
            'subject' => 'Withdrawal Processed - [[amount]] [[currency]]',
            'title' => 'Withdrawal Successful',
            'salutation' => 'Hi [[full_name]],',
            'message_body' => 'Your withdrawal request has been successfully processed.<br><br>
                <table style="width:100%;border-collapse:collapse;">
                    <tr><td style="padding:10px;border:1px solid #ddd;"><strong>Amount:</strong></td><td style="padding:10px;border:1px solid #ddd;">[[amount]] [[currency]]</td></tr>
                    <tr><td style="padding:10px;border:1px solid #ddd;"><strong>Withdrawal Method:</strong></td><td style="padding:10px;border:1px solid #ddd;">[[method]]</td></tr>
                    <tr><td style="padding:10px;border:1px solid #ddd;"><strong>Charge:</strong></td><td style="padding:10px;border:1px solid #ddd;">[[charge]] [[currency]]</td></tr>
                    <tr><td style="padding:10px;border:1px solid #ddd;"><strong>Transaction ID:</strong></td><td style="padding:10px;border:1px solid #ddd;">[[txn_id]]</td></tr>
                    <tr><td style="padding:10px;border:1px solid #ddd;"><strong>Remaining Balance:</strong></td><td style="padding:10px;border:1px solid #ddd;">[[new_balance]] [[currency]]</td></tr>
                    <tr><td style="padding:10px;border:1px solid #ddd;"><strong>Date:</strong></td><td style="padding:10px;border:1px solid #ddd;">[[date]]</td></tr>
                </table><br>
                Funds will be credited to your account within the specified processing time.',
            'button_level' => 'View Transaction',
            'button_link' => '[[dashboard_link]]',
            'footer_status' => 1,
            'footer_body' => 'Regards,<br>[[site_title]]',
            'bottom_status' => 0,
            'bottom_title' => '',
            'bottom_body' => '',
            'short_codes' => '["[[full_name]]","[[amount]]","[[currency]]","[[method]]","[[charge]]","[[txn_id]]","[[new_balance]]","[[date]]","[[dashboard_link]]","[[site_title]]","[[site_url]]"]',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Transfer Sent
        DB::table('email_templates')->insert([
            'name' => 'Transfer Sent',
            'code' => 'transfer_sent',
            'for' => 'User',
            'banner' => null,
            'subject' => 'Transfer Sent - [[amount]] [[currency]]',
            'title' => 'Money Sent Successfully',
            'salutation' => 'Hi [[full_name]],',
            'message_body' => 'Your money transfer has been completed.<br><br>
                <table style="width:100%;border-collapse:collapse;">
                    <tr><td style="padding:10px;border:1px solid #ddd;"><strong>Amount Sent:</strong></td><td style="padding:10px;border:1px solid #ddd;">[[amount]] [[currency]]</td></tr>
                    <tr><td style="padding:10px;border:1px solid #ddd;"><strong>Recipient:</strong></td><td style="padding:10px;border:1px solid #ddd;">[[recipient]]</td></tr>
                    <tr><td style="padding:10px;border:1px solid #ddd;"><strong>Charge:</strong></td><td style="padding:10px;border:1px solid #ddd;">[[charge]] [[currency]]</td></tr>
                    <tr><td style="padding:10px;border:1px solid #ddd;"><strong>Transaction ID:</strong></td><td style="padding:10px;border:1px solid #ddd;">[[txn_id]]</td></tr>
                    <tr><td style="padding:10px;border:1px solid #ddd;"><strong>Remaining Balance:</strong></td><td style="padding:10px;border:1px solid #ddd;">[[new_balance]] [[currency]]</td></tr>
                    <tr><td style="padding:10px;border:1px solid #ddd;"><strong>Date:</strong></td><td style="padding:10px;border:1px solid #ddd;">[[date]]</td></tr>
                </table>',
            'button_level' => 'View Transaction',
            'button_link' => '[[dashboard_link]]',
            'footer_status' => 1,
            'footer_body' => 'Regards,<br>[[site_title]]',
            'bottom_status' => 0,
            'bottom_title' => '',
            'bottom_body' => '',
            'short_codes' => '["[[full_name]]","[[amount]]","[[currency]]","[[recipient]]","[[charge]]","[[txn_id]]","[[new_balance]]","[[date]]","[[dashboard_link]]","[[site_title]]","[[site_url]]"]',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Transfer Received
        DB::table('email_templates')->insert([
            'name' => 'Transfer Received',
            'code' => 'transfer_received',
            'for' => 'User',
            'banner' => null,
            'subject' => 'You Received [[amount]] [[currency]]',
            'title' => 'Money Received',
            'salutation' => 'Hi [[full_name]],',
            'message_body' => 'Great news! You have received money.<br><br>
                <table style="width:100%;border-collapse:collapse;">
                    <tr><td style="padding:10px;border:1px solid #ddd;"><strong>Amount Received:</strong></td><td style="padding:10px;border:1px solid #ddd;">[[amount]] [[currency]]</td></tr>
                    <tr><td style="padding:10px;border:1px solid #ddd;"><strong>From:</strong></td><td style="padding:10px;border:1px solid #ddd;">[[sender]]</td></tr>
                    <tr><td style="padding:10px;border:1px solid #ddd;"><strong>Transaction ID:</strong></td><td style="padding:10px;border:1px solid #ddd;">[[txn_id]]</td></tr>
                    <tr><td style="padding:10px;border:1px solid #ddd;"><strong>New Balance:</strong></td><td style="padding:10px;border:1px solid #ddd;">[[new_balance]] [[currency]]</td></tr>
                    <tr><td style="padding:10px;border:1px solid #ddd;"><strong>Date:</strong></td><td style="padding:10px;border:1px solid #ddd;">[[date]]</td></tr>
                </table>',
            'button_level' => 'View Dashboard',
            'button_link' => '[[dashboard_link]]',
            'footer_status' => 1,
            'footer_body' => 'Regards,<br>[[site_title]]',
            'bottom_status' => 0,
            'bottom_title' => '',
            'bottom_body' => '',
            'short_codes' => '["[[full_name]]","[[amount]]","[[currency]]","[[sender]]","[[txn_id]]","[[new_balance]]","[[date]]","[[dashboard_link]]","[[site_title]]","[[site_url]]"]',
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('email_templates')->whereIn('code', [
            'balance_added',
            'balance_subtracted',
            'deposit_successful',
            'withdrawal_successful',
            'transfer_sent',
            'transfer_received',
        ])->delete();
    }
};
