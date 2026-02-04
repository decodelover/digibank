<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * This seeder creates only Bank Transfer and Crypto payment methods.
     * All automatic gateways have been disabled.
     */
    public function run(): void
    {
        // Clear existing methods
        DB::table('deposit_methods')->truncate();
        DB::table('withdraw_methods')->truncate();
        
        // Disable all automatic gateways
        DB::table('gateways')->update(['status' => 0]);
        
        $this->seedDepositMethods();
        $this->seedWithdrawMethods();
    }

    /**
     * Seed deposit methods - Bank Transfer and Crypto only
     */
    protected function seedDepositMethods(): void
    {
        $depositMethods = [
            [
                'gateway_id' => null,
                'logo' => 'global/images/bank-transfer.png',
                'name' => 'Bank Transfer',
                'type' => 'manual',
                'gateway_code' => 'bank_transfer',
                'charge' => 0,
                'charge_type' => 'fixed',
                'minimum_deposit' => 50,
                'maximum_deposit' => 1000000,
                'rate' => 1,
                'currency' => 'USD',
                'currency_symbol' => '$',
                'field_options' => json_encode([
                    ['name' => 'Sender Bank Name', 'type' => 'text', 'validation' => 'required'],
                    ['name' => 'Sender Account Number', 'type' => 'text', 'validation' => 'required'],
                    ['name' => 'Transaction Reference', 'type' => 'text', 'validation' => 'required'],
                    ['name' => 'Transfer Date', 'type' => 'text', 'validation' => 'required'],
                    ['name' => 'Proof of Payment', 'type' => 'file', 'validation' => 'required']
                ]),
                'payment_details' => '<h4>Bank Transfer Instructions</h4><p>Please transfer the exact amount to the DigiBank account details shown below. Your deposit will be credited within 24 hours after verification.</p><p><strong>Important:</strong> Please upload your payment receipt/screenshot as proof of payment.</p>',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'gateway_id' => null,
                'logo' => 'global/images/crypto.png',
                'name' => 'Cryptocurrency (USDT/BTC)',
                'type' => 'manual',
                'gateway_code' => 'crypto_deposit',
                'charge' => 0,
                'charge_type' => 'fixed',
                'minimum_deposit' => 10,
                'maximum_deposit' => 500000,
                'rate' => 1,
                'currency' => 'USD',
                'currency_symbol' => '$',
                'field_options' => json_encode([
                    ['name' => 'Cryptocurrency Type', 'type' => 'text', 'validation' => 'required'],
                    ['name' => 'Transaction Hash (TXID)', 'type' => 'text', 'validation' => 'required'],
                    ['name' => 'Sender Wallet Address', 'type' => 'text', 'validation' => 'required'],
                    ['name' => 'Proof of Payment', 'type' => 'file', 'validation' => 'required']
                ]),
                'payment_details' => '<h4>Cryptocurrency Deposit</h4><p><strong>USDT (TRC20):</strong> TDiGiBaNk7xYzPqR3nM5wKvL2sJ8hF4cNe</p><p><strong>USDT (ERC20):</strong> 0x1234DiGiBaNk5678AbCdEfGh9012IjKlMnOp</p><p><strong>Bitcoin (BTC):</strong> bc1qdigibank2024example7btcaddress</p><p>Send the exact amount and provide the transaction hash. Deposits are credited after 3 network confirmations.</p>',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        foreach ($depositMethods as $method) {
            DB::table('deposit_methods')->insert($method);
        }
    }

    /**
     * Seed withdraw methods - Bank Transfer and Crypto only
     */
    protected function seedWithdrawMethods(): void
    {
        $withdrawMethods = [
            [
                'icon' => 'global/images/bank-transfer.png',
                'type' => 'manual',
                'gateway_id' => null,
                'name' => 'Bank Transfer',
                'currency' => 'USD',
                'rate' => 1,
                'required_time' => '1-3',
                'required_time_format' => 'Business Days',
                'charge' => 0,
                'charge_type' => 'fixed',
                'min_withdraw' => 50,
                'max_withdraw' => 500000,
                'fields' => json_encode([
                    ['name' => 'Bank Name', 'type' => 'text', 'validation' => 'required'],
                    ['name' => 'Account Holder Name', 'type' => 'text', 'validation' => 'required'],
                    ['name' => 'Account Number', 'type' => 'text', 'validation' => 'required'],
                    ['name' => 'Routing Number', 'type' => 'text', 'validation' => 'required'],
                    ['name' => 'SWIFT Code', 'type' => 'text', 'validation' => 'optional']
                ]),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'icon' => 'global/images/crypto.png',
                'type' => 'manual',
                'gateway_id' => null,
                'name' => 'Cryptocurrency (USDT/BTC)',
                'currency' => 'USD',
                'rate' => 1,
                'required_time' => '30-60',
                'required_time_format' => 'Minutes',
                'charge' => 0,
                'charge_type' => 'fixed',
                'min_withdraw' => 10,
                'max_withdraw' => 500000,
                'fields' => json_encode([
                    ['name' => 'Cryptocurrency Type', 'type' => 'text', 'validation' => 'required'],
                    ['name' => 'Wallet Address', 'type' => 'text', 'validation' => 'required'],
                    ['name' => 'Network', 'type' => 'text', 'validation' => 'required']
                ]),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        foreach ($withdrawMethods as $method) {
            DB::table('withdraw_methods')->insert($method);
        }
    }
}
