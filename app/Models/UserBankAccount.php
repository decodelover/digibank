<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBankAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bank_name',
        'account_name',
        'account_number',
        'routing_number',
        'swift_code',
        'iban',
        'branch_code',
        'branch_name',
        'account_type',
        'currency',
        'is_primary',
        'status',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'status' => 'boolean',
    ];

    /**
     * Get the user that owns the bank account.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Generate realistic bank account details for a user
     */
    public static function generateForUser(User $user): self
    {
        // Generate realistic-looking account number (10-12 digits)
        $accountNumber = self::generateAccountNumber();
        
        // Generate routing number (9 digits, US format)
        $routingNumber = self::generateRoutingNumber();
        
        // Generate SWIFT code (8-11 characters)
        $swiftCode = self::generateSwiftCode();
        
        // Generate IBAN (international format)
        $iban = self::generateIBAN($accountNumber);
        
        // Generate branch code
        $branchCode = self::generateBranchCode();

        return self::create([
            'user_id' => $user->id,
            'bank_name' => 'DigiBank International',
            'account_name' => $user->full_name ?? $user->first_name . ' ' . $user->last_name,
            'account_number' => $accountNumber,
            'routing_number' => $routingNumber,
            'swift_code' => $swiftCode,
            'iban' => $iban,
            'branch_code' => $branchCode,
            'branch_name' => 'Main Branch - Digital Services',
            'account_type' => 'Savings',
            'currency' => 'USD',
            'is_primary' => true,
            'status' => true,
        ]);
    }

    /**
     * Generate a unique account number
     */
    private static function generateAccountNumber(): string
    {
        do {
            // Format: 2 + random 9 digits (total 10 digits)
            $number = '2' . str_pad(random_int(100000000, 999999999), 9, '0', STR_PAD_LEFT);
        } while (self::where('account_number', $number)->exists());

        return $number;
    }

    /**
     * Generate routing number (ABA format)
     */
    private static function generateRoutingNumber(): string
    {
        // Common routing number prefixes for major banks
        $prefixes = ['021', '026', '031', '036', '041', '051', '061', '071', '081', '091'];
        $prefix = $prefixes[array_rand($prefixes)];
        
        // Generate remaining 6 digits
        $middle = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        return $prefix . $middle;
    }

    /**
     * Generate SWIFT/BIC code
     */
    private static function generateSwiftCode(): string
    {
        // Bank code (4 letters) + Country code (2 letters) + Location code (2 alphanumeric) + Branch (3 alphanumeric optional)
        return 'DGBKUS' . chr(rand(65, 90)) . chr(rand(65, 90)) . 'XXX';
    }

    /**
     * Generate IBAN
     */
    private static function generateIBAN(string $accountNumber): string
    {
        // US doesn't use IBAN, but for international compatibility we create a pseudo-IBAN
        // Format: US + 2 check digits + routing (9) + account (variable)
        $checkDigits = str_pad(random_int(10, 99), 2, '0', STR_PAD_LEFT);
        return 'US' . $checkDigits . '0000' . substr($accountNumber, 0, 10);
    }

    /**
     * Generate branch code
     */
    private static function generateBranchCode(): string
    {
        return 'DB' . str_pad(random_int(1, 999), 3, '0', STR_PAD_LEFT);
    }

    /**
     * Get formatted account details for display
     */
    public function getFormattedDetailsAttribute(): array
    {
        return [
            'Bank Name' => $this->bank_name,
            'Account Name' => $this->account_name,
            'Account Number' => $this->account_number,
            'Routing Number' => $this->routing_number,
            'SWIFT/BIC Code' => $this->swift_code,
            'IBAN' => $this->iban,
            'Branch Code' => $this->branch_code,
            'Branch Name' => $this->branch_name,
            'Account Type' => $this->account_type,
            'Currency' => $this->currency,
        ];
    }
}
