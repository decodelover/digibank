<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedDepositMethods();
        $this->seedWithdrawMethods();
    }

    /**
     * Seed deposit methods
     */
    protected function seedDepositMethods(): void
    {
        $depositMethods = [
            [
                'gateway_id' => null,
                'logo' => 'global/gateway/paypal.png', // placeholder - replace with bank icon
                'name' => 'Bank Transfer',
                'type' => 'manual',
                'gateway_code' => 'bank_transfer',
                'charge' => 0,
                'charge_type' => 'fixed',
                'minimum_deposit' => 10,
                'maximum_deposit' => 100000,
                'rate' => 1,
                'currency' => 'USD',
                'currency_symbol' => '$',
                'field_options' => json_encode([
                    'bank_name' => 'DigiBank International',
                    'account_name' => 'DigiBank Ltd',
                    'account_number' => '1234567890',
                    'routing_number' => '021000021',
                    'swift_code' => 'DIGIUS33'
                ]),
                'payment_details' => 'Please transfer the exact amount to the bank account below. Include your username as reference.',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'gateway_id' => 1,
                'logo' => null,
                'name' => 'PayPal',
                'type' => 'auto',
                'gateway_code' => 'paypal',
                'charge' => 2.5,
                'charge_type' => 'percentage',
                'minimum_deposit' => 5,
                'maximum_deposit' => 10000,
                'rate' => 1,
                'currency' => 'USD',
                'currency_symbol' => '$',
                'field_options' => null,
                'payment_details' => null,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'gateway_id' => 2,
                'logo' => null,
                'name' => 'Stripe',
                'type' => 'auto',
                'gateway_code' => 'stripe',
                'charge' => 2.9,
                'charge_type' => 'percentage',
                'minimum_deposit' => 5,
                'maximum_deposit' => 50000,
                'rate' => 1,
                'currency' => 'USD',
                'currency_symbol' => '$',
                'field_options' => null,
                'payment_details' => null,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'gateway_id' => 8,
                'logo' => null,
                'name' => 'Flutterwave',
                'type' => 'auto',
                'gateway_code' => 'flutterwave',
                'charge' => 1.5,
                'charge_type' => 'percentage',
                'minimum_deposit' => 5,
                'maximum_deposit' => 25000,
                'rate' => 1,
                'currency' => 'USD',
                'currency_symbol' => '$',
                'field_options' => null,
                'payment_details' => null,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'gateway_id' => 6,
                'logo' => null,
                'name' => 'Paystack',
                'type' => 'auto',
                'gateway_code' => 'paystack',
                'charge' => 1.5,
                'charge_type' => 'percentage',
                'minimum_deposit' => 5,
                'maximum_deposit' => 25000,
                'rate' => 1,
                'currency' => 'USD',
                'currency_symbol' => '$',
                'field_options' => null,
                'payment_details' => null,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'gateway_id' => 24,
                'logo' => null,
                'name' => 'Razorpay',
                'type' => 'auto',
                'gateway_code' => 'razorpay',
                'charge' => 2,
                'charge_type' => 'percentage',
                'minimum_deposit' => 5,
                'maximum_deposit' => 25000,
                'rate' => 1,
                'currency' => 'USD',
                'currency_symbol' => '$',
                'field_options' => null,
                'payment_details' => null,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        DB::table('deposit_methods')->insertOrIgnore($depositMethods);
    }

    /**
     * Seed withdraw methods
     */
    protected function seedWithdrawMethods(): void
    {
        $withdrawMethods = [
            [
                'icon' => 'fas fa-university',
                'type' => 'manual',
                'gateway_id' => null,
                'name' => 'Bank Transfer',
                'currency' => 'USD',
                'rate' => 1,
                'required_time' => 24,
                'required_time_format' => 'hours',
                'charge' => 1,
                'charge_type' => 'fixed',
                'min_withdraw' => 10,
                'max_withdraw' => 50000,
                'fields' => json_encode([
                    ['name' => 'bank_name', 'label' => 'Bank Name', 'type' => 'text', 'required' => true],
                    ['name' => 'account_name', 'label' => 'Account Holder Name', 'type' => 'text', 'required' => true],
                    ['name' => 'account_number', 'label' => 'Account Number', 'type' => 'text', 'required' => true],
                    ['name' => 'routing_number', 'label' => 'Routing Number', 'type' => 'text', 'required' => false],
                    ['name' => 'swift_code', 'label' => 'SWIFT/BIC Code', 'type' => 'text', 'required' => false],
                ]),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'icon' => 'fab fa-paypal',
                'type' => 'auto',
                'gateway_id' => 1,
                'name' => 'PayPal',
                'currency' => 'USD',
                'rate' => 1,
                'required_time' => 1,
                'required_time_format' => 'hours',
                'charge' => 2.5,
                'charge_type' => 'percentage',
                'min_withdraw' => 5,
                'max_withdraw' => 10000,
                'fields' => json_encode([
                    ['name' => 'paypal_email', 'label' => 'PayPal Email', 'type' => 'email', 'required' => true],
                ]),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'icon' => 'fab fa-bitcoin',
                'type' => 'manual',
                'gateway_id' => null,
                'name' => 'Crypto (USDT)',
                'currency' => 'USD',
                'rate' => 1,
                'required_time' => 2,
                'required_time_format' => 'hours',
                'charge' => 1,
                'charge_type' => 'fixed',
                'min_withdraw' => 20,
                'max_withdraw' => 100000,
                'fields' => json_encode([
                    ['name' => 'wallet_address', 'label' => 'USDT Wallet Address (TRC20)', 'type' => 'text', 'required' => true],
                    ['name' => 'network', 'label' => 'Network', 'type' => 'select', 'options' => ['TRC20', 'ERC20', 'BEP20'], 'required' => true],
                ]),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'icon' => 'fas fa-mobile-alt',
                'type' => 'manual',
                'gateway_id' => null,
                'name' => 'Mobile Money',
                'currency' => 'USD',
                'rate' => 1,
                'required_time' => 4,
                'required_time_format' => 'hours',
                'charge' => 1.5,
                'charge_type' => 'percentage',
                'min_withdraw' => 5,
                'max_withdraw' => 5000,
                'fields' => json_encode([
                    ['name' => 'provider', 'label' => 'Provider', 'type' => 'select', 'options' => ['M-Pesa', 'MTN Mobile Money', 'Airtel Money', 'Orange Money'], 'required' => true],
                    ['name' => 'phone_number', 'label' => 'Phone Number', 'type' => 'text', 'required' => true],
                    ['name' => 'account_name', 'label' => 'Account Name', 'type' => 'text', 'required' => true],
                ]),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        DB::table('withdraw_methods')->insertOrIgnore($withdrawMethods);
    }
}
