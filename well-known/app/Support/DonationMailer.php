<?php

namespace App\Support;

use App\Models\Donation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * Small shared helper so the "submitted" / "completed" / "rejected" emails
 * are sent the same way from every place that triggers them (the public
 * donation form, the gateway success callbacks, and the admin panel).
 */
class DonationMailer
{
    public static function send(Donation $donation, $mailableClass)
    {
        if (empty($donation->donor_email)) {
            // Donor only gave a mobile number — nothing to email.
            return;
        }

        try {
            Mail::to($donation->donor_email)->send(new $mailableClass($donation));
        } catch (\Exception $e) {
            // A broken mail server should never break the donation flow
            // itself (the donor has already paid, or is mid-checkout).
            Log::warning('Donation email failed to send: ' . $e->getMessage());
        }
    }
}
