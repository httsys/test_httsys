<?php

return [
    'breadcrumb_home' => 'Home',
    'breadcrumb_current' => 'Donate',
    'page_title' => 'Make a Donation',

    'step1_title' => "1. Choose what you're donating to",
    'no_funds' => 'No funds are open for donations right now.',
    'progress' => ':collected raised of :target (:percent%)',

    'step2_title' => '2. Your contact details',
    'name_label' => 'Name (optional)',
    'mobile_label' => 'Mobile Number',
    'email_label' => 'Email',
    'email_required_note' => 'required if no mobile number',
    'contact_help' => 'Enter at least your mobile number or your email so we can send a receipt and you can look this donation up later.',

    'step3_title' => '3. Amount',

    'step4_title' => '4. Payment method',

    'submit_button' => 'Donate Now',

    // Manual payment page
    'manual_title' => 'Complete Your Donation',
    'fund_label' => 'Fund',
    'amount_label' => 'Amount',
    'reference_label' => 'Reference',
    'how_to_pay' => 'How to pay with :method',
    'no_instructions' => 'Please contact us for payment instructions.',
    'manual_reference_label' => 'Enter your transaction / reference number after paying',
    'pay_to_label' => 'Send payment to',
    'copy_button' => 'Copy',
    'copied_button' => 'Copied!',
    'manual_submit' => "I've Paid \xe2\x80\x94 Submit",

    // Thank-you / status page
    'thanks_completed_title' => 'Thank you for your donation!',
    'thanks_completed_body' => 'Your donation of :amount to :fund has been received.',
    'thanks_pending_title' => 'Donation Submitted',
    'thanks_pending_body' => "We've recorded your donation of :amount to :fund. It will be confirmed shortly.",
    'thanks_cancelled_title' => 'Donation Cancelled',
    'thanks_cancelled_body' => 'Your donation was cancelled. No payment was taken.',
    'thanks_failed_title' => 'Donation Not Completed',
    'thanks_failed_body' => 'Something went wrong and the payment was not completed. Please try again.',
    'donate_again' => 'Donate Again',
    'view_my_donations' => 'View My Donations',

    // Error messages (flashed from DonationController)
    'error_no_gateway' => 'Could not start :method payment. Please try again.',
    'error_gateway_connect' => 'Could not connect to :method. Please try again.',
    'error_nagad_unavailable' => 'Nagad payments are not fully configured yet. Please choose another payment method.',
];
