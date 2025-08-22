<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class TestEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:email {type=test} {--email=test@example.com}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test email functionality (types: test, verification, reset)';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $type = $this->argument('type');
        $email = $this->option('email');
        
        $this->info("Testing email functionality...");
        $this->info("Mail Driver: " . config('mail.default'));
        $this->info("Mail Host: " . config('mail.mailers.smtp.host', 'N/A'));
        $this->info("Mail Port: " . config('mail.mailers.smtp.port', 'N/A'));
        $this->info("From Address: " . config('mail.from.address'));
        
        switch ($type) {
            case 'test':
                $this->sendTestEmail($email);
                break;
            case 'verification':
                $this->sendVerificationEmail($email);
                break;
            case 'reset':
                $this->sendResetEmail($email);
                break;
            default:
                $this->error("Invalid type. Use: test, verification, or reset");
                return 1;
        }
        
        return 0;
    }
    
    private function sendTestEmail($email)
    {
        try {
            Mail::raw('This is a test email from ' . config('app.name'), function ($message) use ($email) {
                $message->to($email)
                        ->subject('Test Email from ' . config('app.name'));
            });
            
            $this->info("✅ Test email sent successfully to: {$email}");
        } catch (\Exception $e) {
            $this->error("❌ Failed to send test email: " . $e->getMessage());
        }
    }
    
    private function sendVerificationEmail($email)
    {
        try {
            $user = User::where('email', $email)->first();
            
            if (!$user) {
                $this->error("❌ User with email {$email} not found");
                return;
            }
            
            $user->notify(new VerifyEmail());
            $this->info("✅ Verification email sent successfully to: {$email}");
        } catch (\Exception $e) {
            $this->error("❌ Failed to send verification email: " . $e->getMessage());
        }
    }
    
    private function sendResetEmail($email)
    {
        try {
            $user = User::where('email', $email)->first();
            
            if (!$user) {
                $this->error("❌ User with email {$email} not found");
                return;
            }
            
            $token = app('auth.password.broker')->createToken($user);
            $user->notify(new ResetPassword($token));
            $this->info("✅ Password reset email sent successfully to: {$email}");
        } catch (\Exception $e) {
            $this->error("❌ Failed to send reset email: " . $e->getMessage());
        }
    }
}
