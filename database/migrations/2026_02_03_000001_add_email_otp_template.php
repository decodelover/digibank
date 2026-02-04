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
        DB::table('email_templates')->insert([
            'name' => 'Email OTP Verification',
            'code' => 'email_otp',
            'for' => 'User',
            'banner' => null,
            'subject' => 'Your Verification Code',
            'title' => 'Email Verification Code',
            'salutation' => 'Hi [[full_name]],',
            'message_body' => 'Your email verification code is: <br><br><div style="text-align:center;font-size:32px;letter-spacing:8px;font-weight:bold;background:#f5f5f5;padding:20px;border-radius:8px;">[[otp_code]]</div><br><br>This code will expire in 10 minutes. Do not share this code with anyone.',
            'button_level' => '',
            'button_link' => '',
            'footer_status' => 1,
            'footer_body' => 'Regards,<br>[[site_title]]',
            'bottom_status' => 0,
            'bottom_title' => '',
            'bottom_body' => '',
            'short_codes' => '["[[otp_code]]","[[full_name]]","[[site_title]]","[[site_url]]"]',
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
        DB::table('email_templates')->where('code', 'email_otp')->delete();
    }
};
