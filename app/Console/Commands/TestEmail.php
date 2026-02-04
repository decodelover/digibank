<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailSend;
use App\Models\EmailTemplate;

class TestEmail extends Command
{
    protected $signature = 'test:email {email}';
    protected $description = 'Test sending email';

    public function handle()
    {
        $email = $this->argument('email');
        
        $this->info("Testing email to: {$email}");
        
        try {
            // Check mail config
            $this->info("Mail Host: " . config('mail.mailers.smtp.host'));
            $this->info("Mail Port: " . config('mail.mailers.smtp.port'));
            $this->info("Mail Username: " . config('mail.mailers.smtp.username'));
            
            // Check template
            $template = EmailTemplate::where('code', 'email_otp')->first();
            if (!$template) {
                $this->error("email_otp template NOT found!");
                return;
            }
            $this->info("Template found: " . $template->name);
            
            // Send test email
            $otp = random_int(100000, 999999);
            $details = [
                'subject' => 'Your Verification Code',
                'banner' => '',
                'title' => 'Email Verification Code',
                'salutation' => 'Hi there,',
                'message_body' => 'Your OTP code is: <strong>' . $otp . '</strong>',
                'button_level' => '',
                'button_link' => '',
                'footer_status' => 1,
                'footer_body' => 'Regards,<br>DigiBank',
                'bottom_status' => 0,
                'bottom_title' => '',
                'bottom_body' => '',
                'site_logo' => asset(setting('site_logo', 'global')),
                'site_title' => setting('site_title', 'global'),
                'site_link' => url('/'),
            ];
            
            Mail::to($email)->send(new MailSend($details));
            
            $this->info("Email sent successfully! OTP: {$otp}");
            
        } catch (\Exception $e) {
            $this->error("Error: " . $e->getMessage());
        }
    }
}
