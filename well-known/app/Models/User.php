<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'fb_id',
        'role_id',
        'is_active',
        'photo_id',
        'address',
        'city',
        'phone',
        'note',
        'last_login_at',
        'last_login_ip',
        'verification_code',
        'verification_code_expires_at',
        'verification_sent_at',
        'verification_resend_count',
        'email_verification_override',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
        'note',
        'verification_code',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'verification_code_expires_at' => 'datetime',
        'verification_sent_at' => 'datetime',
        'email_verification_override' => 'boolean',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function isAdmin(){
        if($this->role != NULL) {
            if ($this->role->name == "administrator") {
                return true;
            }
        }
        return false;
    }

    public function isAuthor(){
        if($this->role != NULL) {
            if ($this->role->name == "author" || $this->role->name == "administrator") {
                return true;
            }
        }
        return false;
    }

    /**
     * Whether this user's role grants the given permission key from
     * config/permissions.php. Administrators always pass, and a
     * deactivated account never does.
     */
    public function hasPermission($key)
    {
        if (! $this->isActive()) {
            return false;
        }

        if ($this->role === null) {
            return false;
        }

        return $this->role->hasPermission($key);
    }

    /**
     * Accounts created before the is_active column existed have NULL
     * there, which must read as active rather than silently locking
     * somebody out.
     */
    public function isActive()
    {
        return $this->is_active === null || (bool) $this->is_active;
    }

    // Anyone who is not an author/administrator is treated as a plain subscriber.
    public function isSubscriber(){
        return !$this->isAuthor();
    }

    /**
     * Whether this user must still enter an email verification code before
     * being allowed to use the site. False if the site-wide toggle is off,
     * if an admin has manually exempted this specific user, or if the user
     * already completed verification.
     */
    public function needsEmailVerification()
    {
        if ($this->email_verification_override) {
            return false;
        }

        if ($this->email_verified_at !== null) {
            return false;
        }

        $setting = \App\Models\Setting::first();

        return (bool) ($setting->email_verification_enabled ?? false);
    }

    /**
     * Generate a fresh 6-digit code, store it (valid for 10 minutes), and
     * email it to the user. Does not touch the resend counter — callers
     * that are doing a "resend" should increment verification_resend_count
     * themselves after checking the cooldown/limit.
     */
    public function sendVerificationCode()
    {
        $code = (string) random_int(100000, 999999);

        $this->forceFill([
            'verification_code' => $code,
            'verification_code_expires_at' => now()->addMinutes(10),
            'verification_sent_at' => now(),
        ])->save();

        \Illuminate\Support\Facades\Mail::to($this->email)
            ->send(new \App\Mail\VerificationCodeMail($code, $this->name));
    }

    public function logins(){
        return $this->hasMany('App\Models\LoginLog')->latest('logged_in_at');
    }

    public function notes(){
        return $this->hasMany('App\Models\Note')->latest();
    }

    public function role(){
        return $this->belongsTo('App\Models\Role');
    }
    public function photo(){
        return $this->belongsTo('App\Models\Photo', 'photo_id');
    }
    public function profileUpdateRequests()
    {
        return $this->hasMany(\App\Models\ProfileUpdateRequest::class);
    }

    public function pendingProfileUpdateRequest()
    {
        return $this->profileUpdateRequests()->where('status', 'pending')->latest()->first();
    }

    public function wallet()
    {
        return $this->hasOne(\App\Models\Wallet::class);
    }

    /**
     * Current wallet balance as a string (e.g. "1250.00"), 0.00 for a
     * user who has never had a wallet row created yet. Does not create
     * the wallet row — use Wallet::forUser() for that when about to
     * credit/debit.
     */
    public function walletBalance()
    {
        return $this->wallet ? $this->wallet->balance : '0.00';
    }
    public function posts(){
        return $this->hasMany('App\Models\Post');
    }
    public function pages(){
        return $this->hasMany('App\Models\Page');
    }
    public function donations(){
        return $this->hasMany(\App\Models\Donation::class);
    }

    public function projects(){
        return $this->hasMany('App\Models\Project');
    }

    public function addresses()
    {
        return $this->hasMany(\App\Models\Address::class)->orderByDesc('is_default')->latest();
    }

    public function orders()
    {
        return $this->hasMany(\App\Models\Order::class)->latest();
    }

    const WALKING_CUSTOMER_EMAIL = 'walking-customer@pos.local';

    /**
     * The fallback account POS sales are attached to when the cashier
     * doesn't pick a specific customer. Seeded by the POS migration/SQL
     * patch — see database/migrations/2026_09_16_000000_add_pos_support.php.
     */
    public static function walkingCustomer()
    {
        return static::where('email', self::WALKING_CUSTOMER_EMAIL)->first();
    }

    public function isWalkingCustomer()
    {
        return $this->email === self::WALKING_CUSTOMER_EMAIL;
    }

}
