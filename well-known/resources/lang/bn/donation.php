<?php

return [
    'breadcrumb_home' => 'হোম',
    'breadcrumb_current' => 'দান করুন',
    'page_title' => 'দান করুন',

    'step1_title' => 'আপনি কোন খাতে দান করতে চান তা নির্বাচন করুন',
    'no_funds' => 'বর্তমানে দান করার জন্য কোনো খাত খোলা নেই।',
    'progress' => ':target এর মধ্যে :collected সংগ্রহ হয়েছে (:percent%)',

    'step2_title' => 'আপনার যোগাযোগের তথ্য',
    'name_label' => 'নাম (ঐচ্ছিক)',
    'mobile_label' => 'মোবাইল নম্বর',
    'email_label' => 'ইমেইল',
    'email_required_note' => 'মোবাইল নম্বর না দিলে আবশ্যক',
    'contact_help' => 'রশিদ পাঠানো এবং পরে এই দানটি খুঁজে পেতে অন্তত মোবাইল নম্বর বা ইমেইল দিন।',

    'step3_title' => 'পরিমাণ',

    'step4_title' => 'পেমেন্ট মাধ্যম',

    'submit_button' => 'দান করুন',

    // Manual payment page
    'manual_title' => 'আপনার দান সম্পন্ন করুন',
    'fund_label' => 'ফান্ড',
    'amount_label' => 'পরিমাণ',
    'reference_label' => 'রেফারেন্স',
    'how_to_pay' => ':method দিয়ে যেভাবে পেমেন্ট করবেন',
    'no_instructions' => 'পেমেন্ট নির্দেশনার জন্য আমাদের সাথে যোগাযোগ করুন।',
    'manual_reference_label' => 'পেমেন্ট করার পর আপনার ট্রানজেকশন / রেফারেন্স নম্বর লিখুন',
    'pay_to_label' => 'যেখানে পেমেন্ট পাঠাবেন',
    'copy_button' => 'কপি',
    'copied_button' => 'কপি হয়েছে!',
    'manual_submit' => 'পেমেন্ট করেছি — জমা দিন',

    // Thank-you / status page
    'thanks_completed_title' => 'আপনার দানের জন্য ধন্যবাদ!',
    'thanks_completed_body' => ':fund-এ আপনার :amount দান গ্রহণ করা হয়েছে।',
    'thanks_pending_title' => 'দান জমা হয়েছে',
    'thanks_pending_body' => ':fund-এ আপনার :amount দান রেকর্ড করা হয়েছে। শীঘ্রই তা নিশ্চিত করা হবে।',
    'thanks_cancelled_title' => 'দান বাতিল হয়েছে',
    'thanks_cancelled_body' => 'আপনার দান বাতিল করা হয়েছে। কোনো পেমেন্ট নেওয়া হয়নি।',
    'thanks_failed_title' => 'দান সম্পন্ন হয়নি',
    'thanks_failed_body' => 'কিছু একটা সমস্যা হয়েছে এবং পেমেন্ট সম্পন্ন হয়নি। অনুগ্রহ করে আবার চেষ্টা করুন।',
    'donate_again' => 'আবার দান করুন',
    'view_my_donations' => 'আমার দানসমূহ দেখুন',

    // Error messages (flashed from DonationController)
    'error_no_gateway' => ':method পেমেন্ট শুরু করা যায়নি। অনুগ্রহ করে আবার চেষ্টা করুন।',
    'error_gateway_connect' => ':method-এর সাথে সংযোগ করা যায়নি। অনুগ্রহ করে আবার চেষ্টা করুন।',
    'error_nagad_unavailable' => 'Nagad পেমেন্ট এখনো সম্পূর্ণভাবে সেটআপ করা হয়নি। অনুগ্রহ করে অন্য একটি পেমেন্ট মাধ্যম বেছে নিন।',
];
