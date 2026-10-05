<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminMediasController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProjectCategoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\HomeSettingController;
use App\Http\Controllers\AboutSettingController;
use App\Http\Controllers\PortfolioSettingController;
use App\Http\Controllers\PricingSettingController;
use App\Http\Controllers\BlogSettingController;
use App\Http\Controllers\AdZoneController;
use App\Http\Controllers\HomeSectionController;
use App\Http\Controllers\ContactSettingController;
use App\Http\Controllers\HeaderFooterSettingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NoteController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => 'setlang'], function () {

    Auth::routes();

    Route::get('/email/verify-code', [\App\Http\Controllers\Auth\EmailCodeVerificationController::class, 'showForm'])->name('verification.code.form');
    Route::post('/email/verify-code', [\App\Http\Controllers\Auth\EmailCodeVerificationController::class, 'verify'])->name('verification.code.verify');
    Route::post('/email/verify-code/resend', [\App\Http\Controllers\Auth\EmailCodeVerificationController::class, 'resend'])->name('verification.code.resend');
      
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/manifest.json', [\App\Http\Controllers\ManifestController::class, 'show'])->name('pwa.manifest');
    Route::get('/sitemap.xml', [\App\Http\Controllers\SitemapController::class, 'index'])->name('sitemap');
    
    
    Route::get('/search', [HomeController::class, 'search'])->name('search');




    Route::get('/changelanguage/{lang}', [HomeController::class, 'changeLanguage'])->name('changeLanguage');
    
    Route::get('/about-us', [HomeController::class, 'about'])->name('about');
    Route::get('/portfolio', [HomeController::class, 'portfolio'])->name('portfolio');
    Route::get('/pricing', [HomeController::class, 'pricing'])->name('pricing');
    Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
    Route::get('/shop', [\App\Http\Controllers\ShopController::class, 'index'])->name('shop.index');
    Route::get('/product/{slug}', [\App\Http\Controllers\ShopController::class, 'show'])->name('shop.show');
    Route::post('/product/{slug}/review', [\App\Http\Controllers\ShopController::class, 'storeReview'])->name('shop.review.store')->middleware('auth');

    // Mini games — browsing is public, same as currency/marketplace above;
    // playing (start/ad/answer/etc., in the auth group below) requires login.
    Route::get('/mini-games', [\App\Http\Controllers\MiniGameController::class, 'index'])->name('games.index');
    Route::get('/mini-games/{slug}', [\App\Http\Controllers\MiniGameController::class, 'show'])->name('games.show');

    // Currency exchange — browsing is public, everything else needs login.
    Route::get('/currency', [\App\Http\Controllers\CurrencyExchangeController::class, 'index'])->name('currency.index');
    Route::get('/currency/create', [\App\Http\Controllers\CurrencyExchangeController::class, 'create'])->name('currency.create')->middleware('auth');
    Route::post('/currency', [\App\Http\Controllers\CurrencyExchangeController::class, 'store'])->name('currency.store')->middleware('auth');
    Route::get('/currency/{listing}', [\App\Http\Controllers\CurrencyExchangeController::class, 'show'])->name('currency.show');
    Route::post('/currency/{listing}/buy', [\App\Http\Controllers\CurrencyExchangeController::class, 'buy'])->name('currency.buy')->middleware('auth');
    Route::post('/currency/{listing}/toggle', [\App\Http\Controllers\CurrencyExchangeController::class, 'toggleListing'])->name('currency.toggle')->middleware('auth');
    Route::get('/currency-orders/{order}/pay', [\App\Http\Controllers\CurrencyExchangeController::class, 'payment'])->name('currency.payment')->middleware('auth');
    Route::post('/currency-orders/{order}/pay', [\App\Http\Controllers\CurrencyExchangeController::class, 'submitPayment'])->name('currency.submit-payment')->middleware('auth');
    Route::post('/currency-orders/{order}/seller-release', [\App\Http\Controllers\CurrencyExchangeController::class, 'sellerRelease'])->name('currency.seller-release')->middleware('auth');
    Route::post('/currency-orders/{order}/seller-reject', [\App\Http\Controllers\CurrencyExchangeController::class, 'sellerReject'])->name('currency.seller-reject')->middleware('auth');
    Route::post('/currency-orders/{order}/buyer-confirm', [\App\Http\Controllers\CurrencyExchangeController::class, 'buyerConfirm'])->name('currency.buyer-confirm')->middleware('auth');

    // Marketplace — same public-browse / auth-for-everything-else split as
    // currency exchange above.
    Route::get('/marketplace', [\App\Http\Controllers\MarketplaceController::class, 'index'])->name('marketplace.index');
    Route::get('/marketplace/create', [\App\Http\Controllers\MarketplaceController::class, 'create'])->name('marketplace.create')->middleware('auth');
    Route::post('/marketplace', [\App\Http\Controllers\MarketplaceController::class, 'store'])->name('marketplace.store')->middleware('auth');
    Route::get('/marketplace/{listing}', [\App\Http\Controllers\MarketplaceController::class, 'show'])->name('marketplace.show');
    Route::post('/marketplace/{listing}/buy', [\App\Http\Controllers\MarketplaceController::class, 'buy'])->name('marketplace.buy')->middleware('auth');
    Route::post('/marketplace/{listing}/bid', [\App\Http\Controllers\MarketplaceController::class, 'bid'])->name('marketplace.bid')->middleware('auth');
    Route::post('/marketplace/{listing}/toggle', [\App\Http\Controllers\MarketplaceController::class, 'toggleListing'])->name('marketplace.toggle')->middleware('auth');
    Route::get('/marketplace-orders/{order}/pay', [\App\Http\Controllers\MarketplaceController::class, 'payment'])->name('marketplace.payment')->middleware('auth');
    Route::post('/marketplace-orders/{order}/pay', [\App\Http\Controllers\MarketplaceController::class, 'submitPayment'])->name('marketplace.submit-payment')->middleware('auth');
    Route::post('/marketplace-orders/{order}/seller-release', [\App\Http\Controllers\MarketplaceController::class, 'sellerRelease'])->name('marketplace.seller-release')->middleware('auth');
    Route::post('/marketplace-orders/{order}/seller-reject', [\App\Http\Controllers\MarketplaceController::class, 'sellerReject'])->name('marketplace.seller-reject')->middleware('auth');
    Route::post('/marketplace-orders/{order}/buyer-confirm', [\App\Http\Controllers\MarketplaceController::class, 'buyerConfirm'])->name('marketplace.buyer-confirm')->middleware('auth');

    // Cart — open to guests too; checkout (below, in the auth group) is
    // where a login is actually required.
    Route::get('/cart', [\App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [\App\Http\Controllers\CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [\App\Http\Controllers\CartController::class, 'updateQuantity'])->name('cart.update');
    Route::post('/cart/remove', [\App\Http\Controllers\CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart/count', [\App\Http\Controllers\CartController::class, 'count'])->name('cart.count');
    Route::get('/cart/mini', [\App\Http\Controllers\CartController::class, 'mini'])->name('cart.mini');

    // Donations — open to guests as well as logged-in users.
    Route::get('/donate', [\App\Http\Controllers\DonationController::class, 'index'])->name('donations.index');
    Route::post('/donate', [\App\Http\Controllers\DonationController::class, 'store'])->name('donations.store');
    Route::get('/donate/manual/{reference}', [\App\Http\Controllers\DonationController::class, 'manual'])->name('donations.manual');
    Route::post('/donate/manual/{reference}', [\App\Http\Controllers\DonationController::class, 'manualSubmit'])->name('donations.manual.submit');
    Route::get('/donate/thanks/{reference}', [\App\Http\Controllers\DonationController::class, 'thanks'])->name('donations.thanks');

    // Payment gateway callbacks — these are hit by the gateway itself (SSLCommerz
    // posts back via the browser redirect, bKash via its callbackURL), not by a
    // person clicking a link, so they must stay outside auth and are CSRF-exempt
    // (see VerifyCsrfToken::$except).
    Route::match(['get', 'post'], '/donate/callback/sslcommerz/success/{reference}', [\App\Http\Controllers\DonationController::class, 'sslcommerzSuccess'])->name('donations.callback.success');
    Route::match(['get', 'post'], '/donate/callback/sslcommerz/fail/{reference}', [\App\Http\Controllers\DonationController::class, 'sslcommerzFail'])->name('donations.callback.fail');
    Route::match(['get', 'post'], '/donate/callback/sslcommerz/cancel/{reference}', [\App\Http\Controllers\DonationController::class, 'sslcommerzCancel'])->name('donations.callback.cancel');
    Route::match(['get', 'post'], '/donate/callback/bkash/{reference}', [\App\Http\Controllers\DonationController::class, 'bkashCallback'])->name('donations.callback.bkash');
    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
    Route::post('/contact', [HomeController::class, 'contactPost'])->name('contactPost');

    Route::get('auth/facebook', [SocialController::class, 'facebookRedirect']);

    Route::get('auth/facebook/callback', [SocialController::class, 'loginWithFacebook']);

    // Public, shareable "view this file" page — plays audio/video inline,
    // shows images/PDFs in-browser. No login required, since the whole
    // point is that the link can be shared with anyone.
    Route::get('/media/view/{photo}', [\App\Http\Controllers\MediaViewController::class, 'show'])->name('media.public.view');

});


// Accessible to every logged-in user regardless of role (subscriber, author, administrator).
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile/update-request', [ProfileController::class, 'submitUpdateRequest'])->name('profile.update-request');
    Route::post('/wallet/withdraw', [\App\Http\Controllers\WalletController::class, 'requestWithdrawal'])->name('wallet.withdraw');
    Route::post('/wallet/topup', [\App\Http\Controllers\WalletController::class, 'requestTopup'])->name('wallet.topup');
    Route::post('/wallet/convert-points', [\App\Http\Controllers\WalletController::class, 'convertPointsToWallet'])->name('wallet.convert-points');
    Route::post('/wallet/convert-to-points', [\App\Http\Controllers\WalletController::class, 'convertWalletToPoints'])->name('wallet.convert-to-points');
    Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');
    Route::put('/notes/{note}', [NoteController::class, 'update'])->name('notes.update');
    Route::delete('/notes/{note}', [NoteController::class, 'destroy'])->name('notes.destroy');

    // Checkout — shipping address, then Cash On Delivery or any active
    // manual payment method (bKash personal number, bank transfer, etc.).
    Route::get('/checkout/checkout', [\App\Http\Controllers\CheckoutController::class, 'address'])->name('checkout.address');
    Route::post('/checkout/address', [\App\Http\Controllers\CheckoutController::class, 'storeAddress'])->name('checkout.address.store');
    Route::get('/checkout/payment', [\App\Http\Controllers\CheckoutController::class, 'payment'])->name('checkout.payment');
    Route::post('/checkout/place-order', [\App\Http\Controllers\CheckoutController::class, 'placeOrder'])->name('checkout.place');
    Route::get('/checkout/manual/{order}', [\App\Http\Controllers\CheckoutController::class, 'manual'])->name('checkout.manual');
    Route::post('/checkout/manual/{order}', [\App\Http\Controllers\CheckoutController::class, 'manualSubmit'])->name('checkout.manual.submit');
    Route::get('/checkout/thanks/{order}', [\App\Http\Controllers\CheckoutController::class, 'thanks'])->name('checkout.thanks');
    Route::get('/checkout/confirmation/{order}', [\App\Http\Controllers\CheckoutController::class, 'confirmation'])->name('checkout.confirmation');
    Route::get('/checkout/orders/{order}/receipt', [\App\Http\Controllers\CheckoutController::class, 'downloadReceipt'])->name('checkout.receipt');
    Route::post('/checkout/orders/{order}/cancel', [\App\Http\Controllers\CheckoutController::class, 'cancelOrder'])->name('checkout.cancel');
    Route::post('/checkout/orders/{order}/return', [\App\Http\Controllers\CheckoutController::class, 'requestReturn'])->name('checkout.return.request');
    // Mini games — playing needs login; browsing does not (see the public
    // games.index / games.show routes near the currency/marketplace routes above).
    Route::get('/mini-games/ad/{play}', [\App\Http\Controllers\MiniGameController::class, 'ad'])->name('games.ad');
    Route::post('/mini-games/play/{play}/loaded', [\App\Http\Controllers\MiniGameController::class, 'adLoaded'])->name('games.loaded')->middleware('throttle:60,1');
    Route::post('/mini-games/play/{play}/question', [\App\Http\Controllers\MiniGameController::class, 'question'])->name('games.question')->middleware('throttle:60,1');
    Route::post('/mini-games/play/{play}/progress', [\App\Http\Controllers\MiniGameController::class, 'progress'])->name('games.progress')->middleware('throttle:120,1');
Route::post('/mini-games/play/{play}/leave', [\App\Http\Controllers\MiniGameController::class, 'leave'])->name('games.leave')->middleware('throttle:30,1');
    Route::post('/mini-games/play/{play}/answer', [\App\Http\Controllers\MiniGameController::class, 'answer'])->name('games.answer')->middleware('throttle:60,1');
    Route::post('/mini-games/{slug}/start', [\App\Http\Controllers\MiniGameController::class, 'start'])->name('games.start')->middleware('throttle:30,1');
    Route::get('/my-orders', [\App\Http\Controllers\CheckoutController::class, 'myOrders'])->name('checkout.my-orders');
    Route::post('/checkout/coupon/apply', [\App\Http\Controllers\CheckoutController::class, 'applyCoupon'])->name('checkout.coupon.apply');
    Route::post('/checkout/coupon/remove', [\App\Http\Controllers\CheckoutController::class, 'removeCoupon'])->name('checkout.coupon.remove');
});


Route::middleware(['author'])->group(function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    // Written out per action rather than as a resource so each one can carry
    // its own permission — viewing the user list and deleting an account are
    // very different levels of trust.
    Route::get('admin/users', [UserController::class, 'index'])->name('users.index')->middleware('permission:users.view');
    Route::get('admin/users/create', [UserController::class, 'create'])->name('users.create')->middleware('permission:users.create');
    Route::post('admin/users', [UserController::class, 'store'])->name('users.store')->middleware('permission:users.create');
    Route::get('admin/users/{user}', [UserController::class, 'show'])->name('users.show')->middleware('permission:users.view');
    Route::get('admin/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('permission:users.update');
    Route::put('admin/users/{user}', [UserController::class, 'update'])->name('users.update')->middleware('permission:users.update');
    Route::patch('admin/users/{user}', [UserController::class, 'update'])->middleware('permission:users.update');
    Route::delete('admin/users/{user}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('permission:users.delete');

    Route::post('admin/users/{user}/toggle-active', [UserController::class, 'toggleActive'])
        ->name('users.toggle-active')
        ->middleware('permission:users.toggle_active');

    // Role builder — the screen where each role's permission checkboxes live.
    Route::resource('admin/roles', \App\Http\Controllers\RoleController::class)
        ->except(['show'])
        ->middleware('permission:users.roles.manage');

    Route::get('admin/profile-requests', [\App\Http\Controllers\AdminProfileRequestController::class, 'index'])->name('profile-requests.admin.index')->middleware('permission:users.profile_requests');
    Route::post('admin/profile-requests/{profileUpdateRequest}/approve', [\App\Http\Controllers\AdminProfileRequestController::class, 'approve'])->name('profile-requests.admin.approve')->middleware('permission:users.profile_requests');
    Route::post('admin/profile-requests/{profileUpdateRequest}/reject', [\App\Http\Controllers\AdminProfileRequestController::class, 'reject'])->name('profile-requests.admin.reject')->middleware('permission:users.profile_requests');

    // Wallet — balances overview, escrow release/reject, withdrawal
    // approve/reject, and the fixed+percent fee settings used by every
    // P2P module (currency exchange, marketplace, auction).
    Route::get('admin/wallet', [\App\Http\Controllers\AdminWalletController::class, 'index'])->name('wallet.admin.index')->middleware('permission:wallet.view');

    Route::get('admin/wallet/escrow', [\App\Http\Controllers\AdminWalletController::class, 'escrowIndex'])->name('wallet.admin.escrow.index')->middleware('permission:wallet.view');
    Route::post('admin/wallet/escrow/{escrowHold}/release', [\App\Http\Controllers\AdminWalletController::class, 'releaseEscrow'])->name('wallet.admin.escrow.release')->middleware('permission:wallet.escrow.manage');
    Route::post('admin/wallet/escrow/{escrowHold}/reject', [\App\Http\Controllers\AdminWalletController::class, 'rejectEscrow'])->name('wallet.admin.escrow.reject')->middleware('permission:wallet.escrow.manage');

    Route::get('admin/wallet/withdrawals', [\App\Http\Controllers\AdminWalletController::class, 'withdrawalIndex'])->name('wallet.admin.withdrawals.index')->middleware('permission:wallet.view');
    Route::post('admin/wallet/withdrawals/{withdrawalRequest}/approve', [\App\Http\Controllers\AdminWalletController::class, 'approveWithdrawal'])->name('wallet.admin.withdrawals.approve')->middleware('permission:wallet.withdrawals.manage');
    Route::post('admin/wallet/withdrawals/{withdrawalRequest}/reject', [\App\Http\Controllers\AdminWalletController::class, 'rejectWithdrawal'])->name('wallet.admin.withdrawals.reject')->middleware('permission:wallet.withdrawals.manage');

    Route::get('admin/wallet/topups', [\App\Http\Controllers\AdminWalletController::class, 'topupIndex'])->name('wallet.admin.topups.index')->middleware('permission:wallet.view');
    Route::post('admin/wallet/topups/{walletTopupRequest}/approve', [\App\Http\Controllers\AdminWalletController::class, 'approveTopup'])->name('wallet.admin.topups.approve')->middleware('permission:wallet.topups.manage');
    Route::post('admin/wallet/topups/{walletTopupRequest}/reject', [\App\Http\Controllers\AdminWalletController::class, 'rejectTopup'])->name('wallet.admin.topups.reject')->middleware('permission:wallet.topups.manage');

    Route::get('admin/wallet/fees', [\App\Http\Controllers\AdminWalletController::class, 'feesEdit'])->name('wallet.admin.fees.edit')->middleware('permission:wallet.fees.manage');
    Route::post('admin/wallet/fees', [\App\Http\Controllers\AdminWalletController::class, 'feesUpdate'])->name('wallet.admin.fees.update')->middleware('permission:wallet.fees.manage');

    Route::get('admin/currency-listings', [\App\Http\Controllers\AdminCurrencyController::class, 'index'])->name('currency.admin.index')->middleware('permission:currency_exchange.manage');
    Route::post('admin/currency-listings/{listing}/close', [\App\Http\Controllers\AdminCurrencyController::class, 'close'])->name('currency.admin.close')->middleware('permission:currency_exchange.manage');
    Route::get('admin/currencies', [\App\Http\Controllers\AdminCurrencyController::class, 'currenciesIndex'])->name('currency.admin.currencies.index')->middleware('permission:currency_exchange.manage');
    Route::post('admin/currencies', [\App\Http\Controllers\AdminCurrencyController::class, 'currenciesStore'])->name('currency.admin.currencies.store')->middleware('permission:currency_exchange.manage');
    Route::post('admin/currencies/{currency}/toggle', [\App\Http\Controllers\AdminCurrencyController::class, 'currenciesToggle'])->name('currency.admin.currencies.toggle')->middleware('permission:currency_exchange.manage');
    Route::delete('admin/currencies/{currency}', [\App\Http\Controllers\AdminCurrencyController::class, 'currenciesDestroy'])->name('currency.admin.currencies.destroy')->middleware('permission:currency_exchange.manage');

    Route::get('admin/marketplace-listings', [\App\Http\Controllers\AdminMarketplaceController::class, 'index'])->name('marketplace.admin.index')->middleware('permission:marketplace.manage');
    Route::post('admin/marketplace-listings/{listing}/close', [\App\Http\Controllers\AdminMarketplaceController::class, 'close'])->name('marketplace.admin.close')->middleware('permission:marketplace.manage');

    Route::resource('admin/media', AdminMediasController::class)->middleware('permission:content.media.manage');
    Route::resource('admin/comments', \App\Http\Controllers\AdminCommentController::class)->only(['index', 'edit', 'update', 'destroy'])->parameters(['comments' => 'comment'])->middleware('permission:content.comments.manage');
    Route::resource('admin/products', \App\Http\Controllers\ProductController::class)->parameters(['products' => 'product'])->middleware('permission:shop.products.manage');
    Route::resource('admin/product-categories', \App\Http\Controllers\ProductCategoryController::class)->parameters(['product-categories' => 'category'])->middleware('permission:shop.categories.manage');
    Route::resource('admin/brands', \App\Http\Controllers\BrandController::class)->parameters(['brands' => 'brand'])->middleware('permission:shop.brands.manage');
    Route::delete('/delete/media', [AdminMediasController::class, 'deleteMedia'])->name('delete.media');

    Route::resource('admin/funds', \App\Http\Controllers\FundController::class)->parameters(['funds' => 'fund'])->middleware('permission:donations.funds.manage');
    Route::resource('admin/payment-methods', \App\Http\Controllers\PaymentMethodController::class)->parameters(['payment-methods' => 'paymentMethod'])->middleware('permission:donations.payment_methods.manage');
    Route::get('admin/donations', [\App\Http\Controllers\AdminDonationController::class, 'index'])->name('donations.admin.index')->middleware('permission:donations.view');
    Route::post('admin/donations/{donation}/verify', [\App\Http\Controllers\AdminDonationController::class, 'verify'])->name('donations.admin.verify')->middleware('permission:donations.verify');
    Route::post('admin/donations/{donation}/reject', [\App\Http\Controllers\AdminDonationController::class, 'reject'])->name('donations.admin.reject')->middleware('permission:donations.verify');

    Route::resource('admin/shop-payment-methods', \App\Http\Controllers\ShopPaymentMethodController::class)->parameters(['shop-payment-methods' => 'shopPaymentMethod'])->middleware('permission:shop.payment_methods.manage');
    Route::resource('admin/pickup-locations', \App\Http\Controllers\PickupLocationController::class)->parameters(['pickup-locations' => 'pickupLocation'])->middleware('permission:shop.pickup_locations.manage');
    Route::resource('admin/coupons', \App\Http\Controllers\CouponController::class)->parameters(['coupons' => 'coupon'])->middleware('permission:shop.coupons.manage');

    Route::get('admin/orders', [\App\Http\Controllers\AdminOrderController::class, 'index'])->name('orders.admin.index')->middleware('permission:orders.view');
    Route::get('admin/orders/{order}', [\App\Http\Controllers\AdminOrderController::class, 'show'])->name('orders.admin.show')->middleware('permission:orders.view');
    Route::post('admin/orders/{order}/verify-payment', [\App\Http\Controllers\AdminOrderController::class, 'verifyPayment'])->name('orders.admin.verify')->middleware('permission:orders.verify_payment');
    Route::post('admin/orders/{order}/reject-payment', [\App\Http\Controllers\AdminOrderController::class, 'rejectPayment'])->name('orders.admin.reject')->middleware('permission:orders.verify_payment');
    Route::post('admin/orders/{order}/status', [\App\Http\Controllers\AdminOrderController::class, 'updateStatus'])->name('orders.admin.status')->middleware('permission:orders.update_status');

    // Customer return requests
    Route::get('admin/order-returns', [\App\Http\Controllers\AdminOrderReturnController::class, 'index'])->name('order-returns.admin.index')->middleware('permission:orders.returns.manage');
    Route::post('admin/order-returns/{orderReturn}/accept', [\App\Http\Controllers\AdminOrderReturnController::class, 'accept'])->name('order-returns.admin.accept')->middleware('permission:orders.returns.manage');
    Route::post('admin/order-returns/{orderReturn}/reject', [\App\Http\Controllers\AdminOrderReturnController::class, 'reject'])->name('order-returns.admin.reject')->middleware('permission:orders.returns.manage');

    // Mini games admin
    Route::get('admin/game-settings', [\App\Http\Controllers\GameSettingController::class, 'edit'])->name('game-settings.edit')->middleware('permission:games.settings.manage');
    Route::put('admin/game-settings', [\App\Http\Controllers\GameSettingController::class, 'update'])->name('game-settings.update')->middleware('permission:games.settings.manage');
    Route::resource('admin/game-ads', \App\Http\Controllers\GameAdController::class)->except(['show'])->parameters(['game-ads' => 'gameAd'])->middleware('permission:games.ads.manage');
    Route::get('admin/game-plays', [\App\Http\Controllers\GamePlayAdminController::class, 'index'])->name('game-plays.index')->middleware('permission:games.plays.view');

    // Point of Sale
    Route::get('admin/pos', [\App\Http\Controllers\PosController::class, 'index'])->name('pos.index')->middleware('permission:pos.access');
    Route::get('admin/pos/products', [\App\Http\Controllers\PosController::class, 'products'])->name('pos.products')->middleware('permission:pos.access');
    Route::post('admin/pos/barcode', [\App\Http\Controllers\PosController::class, 'barcode'])->name('pos.barcode')->middleware('permission:pos.access');
    Route::get('admin/pos/products/{product}/variation', [\App\Http\Controllers\PosController::class, 'showVariation'])->name('pos.variation')->middleware('permission:pos.access');
    Route::post('admin/pos/cart/add', [\App\Http\Controllers\PosController::class, 'addItem'])->name('pos.cart.add')->middleware('permission:pos.access');
    Route::post('admin/pos/cart/update', [\App\Http\Controllers\PosController::class, 'updateQuantity'])->name('pos.cart.update')->middleware('permission:pos.access');
    Route::post('admin/pos/cart/remove', [\App\Http\Controllers\PosController::class, 'removeItem'])->name('pos.cart.remove')->middleware('permission:pos.access');
    Route::post('admin/pos/cart/cancel', [\App\Http\Controllers\PosController::class, 'cancel'])->name('pos.cart.cancel')->middleware('permission:pos.access');
    Route::post('admin/pos/customer/set', [\App\Http\Controllers\PosController::class, 'setCustomer'])->name('pos.customer.set')->middleware('permission:pos.access');
    Route::post('admin/pos/customer', [\App\Http\Controllers\PosController::class, 'storeCustomer'])->name('pos.customer.store')->middleware('permission:pos.access');
    Route::post('admin/pos/discount', [\App\Http\Controllers\PosController::class, 'applyDiscount'])->name('pos.discount.apply')->middleware('permission:pos.access');
    Route::delete('admin/pos/discount', [\App\Http\Controllers\PosController::class, 'removeDiscount'])->name('pos.discount.remove')->middleware('permission:pos.access');
    Route::post('admin/pos/checkout', [\App\Http\Controllers\PosController::class, 'checkout'])->name('pos.checkout')->middleware('permission:pos.access');
    Route::get('admin/pos/catalog', [\App\Http\Controllers\PosController::class, 'catalog'])->name('pos.catalog')->middleware('permission:pos.access');
    Route::post('admin/pos/sync', [\App\Http\Controllers\PosController::class, 'sync'])->name('pos.sync')->middleware('permission:pos.access');
    Route::get('admin/pos/refunds/search', [\App\Http\Controllers\PosController::class, 'refundSearch'])->name('pos.refunds.search')->middleware('permission:pos.access');
    Route::get('admin/pos/refunds/{order}', [\App\Http\Controllers\PosController::class, 'refundDetail'])->name('pos.refunds.detail')->middleware('permission:pos.access');
    Route::post('admin/pos/refunds/{order}', [\App\Http\Controllers\PosController::class, 'refundProcess'])->name('pos.refunds.process')->middleware('permission:pos.refunds.process');

    Route::get('admin/pos-orders', [\App\Http\Controllers\PosOrderController::class, 'index'])->name('pos-orders.index')->middleware('permission:pos.access');
    Route::get('admin/pos-orders-export', [\App\Http\Controllers\PosOrderController::class, 'export'])->name('pos-orders.export')->middleware('permission:pos.access');
    Route::get('admin/pos-orders/{order}', [\App\Http\Controllers\PosOrderController::class, 'show'])->name('pos-orders.show')->middleware('permission:pos.access');
    Route::get('admin/pos-orders/{order}/print', [\App\Http\Controllers\PosOrderController::class, 'print'])->name('pos-orders.print')->middleware('permission:pos.access');
    Route::delete('admin/pos-orders/{order}', [\App\Http\Controllers\PosOrderController::class, 'destroy'])->name('pos-orders.destroy')->middleware('permission:pos.orders.delete');

    Route::resource('admin/post', PostController::class)->middleware('permission:content.posts.manage');
    Route::delete('/delete/post', [PostController::class, 'delete_post'])->name('delete.post');

    Route::resource('admin/category', CategoryController::class)->middleware('permission:content.categories.manage');
    Route::delete('/delete/category', [CategoryController::class, 'delete_category'])->name('delete.category');
});


Route::middleware(['admin'])->group(function () {


    Route::delete('/delete/users', [UserController::class, 'delete_users'])->name('delete.users')->middleware('permission:users.delete');
    
    Route::resource('admin/menu', MenuController::class);
    Route::delete('/delete/menu', [MenuController::class, 'delete_menu'])->name('delete.menu');

    Route::resource('admin/slider', SliderController::class);
    Route::delete('/delete/slider', [SliderController::class, 'delete_slider'])->name('delete.slider');
    Route::post('admin/slider/autoplay', [SettingController::class, 'updateSliderAutoplay'])->name('slider.autoplay.update');

    Route::resource('admin/service', ServiceController::class);
    Route::delete('/delete/service', [ServiceController::class, 'delete_service'])->name('delete.service');

    Route::resource('admin/testimonial', TestimonialController::class);
    Route::delete('/delete/testimonial', [TestimonialController::class, 'delete_testimonial'])->name('delete.testimonial');

    Route::resource('admin/client', ClientController::class);
    Route::delete('/delete/client', [ClientController::class, 'delete_client'])->name('delete.client');

    Route::resource('admin/member', MemberController::class);
    Route::delete('/delete/member', [MemberController::class, 'delete_member'])->name('delete.member');
    
    Route::resource('admin/pricing', PricingController::class);
    Route::delete('/delete/pricing', [PricingController::class, 'delete_pricing'])->name('delete.pricing');

    Route::resource('admin/project', ProjectController::class);
    Route::delete('/delete/project', [ProjectController::class, 'delete_project'])->name('delete.project');

    Route::resource('admin/language', LanguageController::class);
    Route::delete('/delete/language', [LanguageController::class, 'delete_language'])->name('delete.language');

    Route::resource('admin/project-category', ProjectCategoryController::class);
    Route::delete('/delete/project-category', [ProjectCategoryController::class, 'delete_project_category'])->name('delete.project-category');

    Route::resource('admin/page', PageController::class);
    Route::delete('/delete/page', [PageController::class, 'delete_page'])->name('delete.page');
    Route::get('admin/custom-page', [PageController::class, 'index_custom'])->name('index-custom');

    Route::get('admin/home-settings', [HomeSettingController::class, 'edit'])->name('home-setting.edit');
    Route::put('admin/home-settings/{langid}/update', [HomeSettingController::class, 'update'])->name('home-setting.update');

    Route::get('admin/about-settings', [AboutSettingController::class, 'edit'])->name('about-setting.edit');
    Route::put('admin/about-settings/{langid}/update', [AboutSettingController::class, 'update'])->name('about-setting.update');

    Route::get('admin/portfolio-settings', [PortfolioSettingController::class, 'edit'])->name('portfolio-setting.edit');
    Route::put('admin/portfolio-settings/{langid}/update', [PortfolioSettingController::class, 'update'])->name('portfolio-setting.update');

    Route::get('admin/pricing-settings', [PricingSettingController::class, 'edit'])->name('pricing-setting.edit');
    Route::put('admin/pricing-settings/{langid}/update', [PricingSettingController::class, 'update'])->name('pricing-setting.update');

    Route::get('admin/blog-settings', [BlogSettingController::class, 'edit'])->name('blog-setting.edit');
    Route::put('admin/blog-settings/{langid}/update', [BlogSettingController::class, 'update'])->name('blog-setting.update');
    Route::get('admin/notification-settings', [\App\Http\Controllers\NotificationSettingController::class, 'edit'])->name('notification-setting.edit');
    Route::post('admin/notification-settings/{langid}/update', [\App\Http\Controllers\NotificationSettingController::class, 'update'])->name('notification-setting.update');

    Route::get('admin/ads', [AdZoneController::class, 'index'])->name('ad-zone.index');
    Route::put('admin/ads/update', [AdZoneController::class, 'update'])->name('ad-zone.update');

    Route::get('admin/home-sections', [HomeSectionController::class, 'index'])->name('home-section.index');
    Route::put('admin/home-sections/update', [HomeSectionController::class, 'update'])->name('home-section.update');

    Route::get('admin/contact-settings', [ContactSettingController::class, 'edit'])->name('contact-setting.edit');
    Route::put('admin/contact-settings/{langid}/update', [ContactSettingController::class, 'update'])->name('contact-setting.update');

    Route::get('admin/header-footer-settings', [HeaderFooterSettingController::class, 'edit'])->name('headerfooter-setting.edit');
    Route::put('admin/header-footer-settings/{langid}/update', [HeaderFooterSettingController::class, 'update'])->name('headerfooter-setting.update');
    Route::get('admin/header-footer-settings', [HeaderFooterSettingController::class, 'edit'])->name('headerfooter-setting.edit');
  //  Route::get('/action', [HeaderFooterSettingController::class, 'action'])->name('live_search.action');
  



    Route::get('admin/settings', [SettingController::class, 'edit'])->name('setting.edit');
    Route::put('admin/settings/{langid}/update', [SettingController::class, 'update'])->name('setting.update');


});
Route::middleware(['XSS'])->group(function () { 
   
});
Route::group(['middleware' => 'setlang'], function () {

    Route::get('/post/{slug}',  [PostController::class, 'show_slug']);
    Route::post('/post/{slug}/comment', [\App\Http\Controllers\CommentController::class, 'store'])->name('comments.store');
    Route::get('/project/{slug}',  [ProjectController::class, 'show_slug']);
    Route::get('/{slug}',  [PageController::class, 'show_slug']);
});










