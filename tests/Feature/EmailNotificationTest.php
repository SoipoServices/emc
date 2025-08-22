<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Laravel\Fortify\Features;

test('registration sends verification email when email verification is enabled', function () {
    Mail::fake();
    Notification::fake();
    
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'position' => 'Developer',
        'terms' => true,
    ]);

    $user = User::where('email', 'test@example.com')->first();
    expect($user)->not->toBeNull();
    
    // Check if verification email was sent
    Notification::assertSentTo($user, VerifyEmail::class);
    
})->skip(function () {
    return ! Features::enabled(Features::registration()) || ! Features::enabled(Features::emailVerification());
}, 'Registration or email verification not enabled.');

test('password reset request sends email', function () {
    Mail::fake();
    Notification::fake();
    
    $user = User::factory()->create([
        'email' => 'test@example.com',
    ]);

    $response = $this->post('/forgot-password', [
        'email' => 'test@example.com',
    ]);

    // Fortify redirects after successful password reset request
    $response->assertStatus(302);
    
    // Check if password reset email was sent
    Notification::assertSentTo($user, ResetPassword::class);
    
})->skip(function () {
    return ! Features::enabled(Features::resetPasswords());
}, 'Password reset not enabled.');

test('email verification notification can be resent', function () {
    Mail::fake();
    Notification::fake();
    
    $user = User::factory()->create([
        'email' => 'test@example.com',
        'email_verified_at' => null,
    ]);

    $response = $this->actingAs($user)->post('/email/verification-notification');

    // Fortify redirects after successful verification notification
    $response->assertStatus(302);
    
    // Check if verification email was sent
    Notification::assertSentTo($user, VerifyEmail::class);
    
})->skip(function () {
    return ! Features::enabled(Features::emailVerification());
}, 'Email verification not enabled.');

test('mail configuration is properly set up', function () {
    $mailer = config('mail.default');
    $fromAddress = config('mail.from.address');
    $fromName = config('mail.from.name');
    
    expect($mailer)->not->toBeEmpty();
    expect($fromAddress)->not->toBeEmpty();
    expect($fromName)->not->toBeEmpty();
    
    // Log the configuration for debugging
    echo "\nMail Configuration:\n";
    echo "Default Mailer: {$mailer}\n";
    echo "From Address: {$fromAddress}\n";
    echo "From Name: {$fromName}\n";
    
    if ($mailer === 'smtp') {
        $host = config('mail.mailers.smtp.host');
        $port = config('mail.mailers.smtp.port');
        echo "SMTP Host: {$host}\n";
        echo "SMTP Port: {$port}\n";
    }
});
