<?php

/*
|--------------------------------------------------------------------------
| Permission catalogue
|--------------------------------------------------------------------------
|
| THIS IS THE ONLY FILE YOU EDIT WHEN YOU ADD A NEW FEATURE TO THE SITE.
|
| Every permission the admin panel knows about lives here, grouped into the
| sections you see on the "New role" screen. Add a line here and the
| checkbox appears on the role screen automatically — no migration, no
| seeder, no code change anywhere else.
|
| Format:
|
|   'group.key' => [
|       'group' => 'Human readable section heading',
|       'label' => 'What ticking this box lets the user do',
|       'dangerous' => true,   // optional, shows a red DANGEROUS tag
|   ],
|
| The key is what you use in routes (->middleware('permission:shop.products.manage'))
| and in blade (@haspermission('shop.products.manage') ... @endhaspermission).
|
*/

return [

    /*
    |----------------------------------------------------------------------
    | Dashboard
    |----------------------------------------------------------------------
    */
    'dashboard.view' => [
        'group' => 'Dashboard',
        'label' => 'Open the admin dashboard',
    ],

    /*
    |----------------------------------------------------------------------
    | Shop
    |----------------------------------------------------------------------
    */
    'shop.products.view' => [
        'group' => 'Shop',
        'label' => 'View products',
    ],
    'shop.products.manage' => [
        'group' => 'Shop',
        'label' => 'Create, edit and delete products',
    ],
    'shop.categories.manage' => [
        'group' => 'Shop',
        'label' => 'Manage product categories',
    ],
    'shop.brands.manage' => [
        'group' => 'Shop',
        'label' => 'Manage brands',
    ],
    'shop.coupons.manage' => [
        'group' => 'Shop',
        'label' => 'Manage discount coupons',
    ],
    'shop.pickup_locations.manage' => [
        'group' => 'Shop',
        'label' => 'Manage pickup locations',
    ],
    'shop.payment_methods.manage' => [
        'group' => 'Shop',
        'label' => 'Manage shop payment methods',
    ],

    /*
    |----------------------------------------------------------------------
    | Point of Sale
    |----------------------------------------------------------------------
    */
    'pos.access' => [
        'group' => 'Point of Sale',
        'label' => 'Open the POS screen and ring up in-store sales',
    ],
    'pos.orders.delete' => [
        'group' => 'Point of Sale',
        'label' => 'Delete a POS order',
        'dangerous' => true,
    ],
    'pos.refunds.process' => [
        'group' => 'Point of Sale',
        'label' => 'Process a refund / return for a POS sale',
        'dangerous' => true,
    ],

    /*
    |----------------------------------------------------------------------
    | Mini Games
    |----------------------------------------------------------------------
    */
    'games.settings.manage' => [
        'group' => 'Mini Games',
        'label' => 'Change win percentage, hourly limit and points for the mini games',
    ],
    'games.ads.manage' => [
        'group' => 'Mini Games',
        'label' => 'Manage the advertisements shown during mini games',
    ],
    'games.plays.view' => [
        'group' => 'Mini Games',
        'label' => 'View the mini game play history',
    ],

    /*
    |----------------------------------------------------------------------
    | Orders
    |----------------------------------------------------------------------
    */
    'orders.view' => [
        'group' => 'Orders',
        'label' => 'View customer orders',
    ],
    'orders.verify_payment' => [
        'group' => 'Orders',
        'label' => 'Confirm or reject order payments',
        'dangerous' => true,
    ],
    'orders.update_status' => [
        'group' => 'Orders',
        'label' => 'Change order status (processing, delivered, etc.)',
    ],
    'orders.returns.manage' => [
        'group' => 'Orders',
        'label' => 'Review and accept/reject customer return requests',
        'dangerous' => true,
    ],

    /*
    |----------------------------------------------------------------------
    | Donations
    |----------------------------------------------------------------------
    */
    'donations.view' => [
        'group' => 'Donations',
        'label' => 'View donations',
    ],
    'donations.verify' => [
        'group' => 'Donations',
        'label' => 'Confirm or reject donation payments',
        'dangerous' => true,
    ],
    'donations.funds.manage' => [
        'group' => 'Donations',
        'label' => 'Manage donation funds',
    ],
    'donations.payment_methods.manage' => [
        'group' => 'Donations',
        'label' => 'Manage donation payment methods',
    ],

    /*
    |----------------------------------------------------------------------
    | Users
    |----------------------------------------------------------------------
    */
    'users.view' => [
        'group' => 'Users',
        'label' => 'View the user list',
    ],
    'users.create' => [
        'group' => 'Users',
        'label' => 'Create new users',
    ],
    'users.update' => [
        'group' => 'Users',
        'label' => 'Edit existing users',
    ],
    'users.delete' => [
        'group' => 'Users',
        'label' => 'Delete users',
        'dangerous' => true,
    ],
    'users.toggle_active' => [
        'group' => 'Users',
        'label' => 'Activate or deactivate user accounts',
    ],
    'users.profile_requests' => [
        'group' => 'Users',
        'label' => 'Approve or reject customer profile change requests',
    ],
    'users.roles.manage' => [
        'group' => 'Users',
        'label' => 'Create roles and change what each role is allowed to do',
        'dangerous' => true,
    ],

    /*
    |----------------------------------------------------------------------
    | Content
    |----------------------------------------------------------------------
    */
    'content.posts.manage' => [
        'group' => 'Content',
        'label' => 'Manage blog posts',
    ],
    'content.categories.manage' => [
        'group' => 'Content',
        'label' => 'Manage blog categories',
    ],
    'content.comments.manage' => [
        'group' => 'Content',
        'label' => 'Moderate comments',
    ],
    'content.pages.manage' => [
        'group' => 'Content',
        'label' => 'Manage site pages',
    ],
    'content.projects.manage' => [
        'group' => 'Content',
        'label' => 'Manage projects and project categories',
    ],
    'content.media.manage' => [
        'group' => 'Content',
        'label' => 'Upload and delete media files',
    ],

    /*
    |----------------------------------------------------------------------
    | Site elements
    |----------------------------------------------------------------------
    */
    'elements.sliders.manage' => [
        'group' => 'Site elements',
        'label' => 'Manage homepage sliders',
    ],
    'elements.services.manage' => [
        'group' => 'Site elements',
        'label' => 'Manage services',
    ],
    'elements.testimonials.manage' => [
        'group' => 'Site elements',
        'label' => 'Manage testimonials',
    ],
    'elements.clients.manage' => [
        'group' => 'Site elements',
        'label' => 'Manage clients',
    ],
    'elements.members.manage' => [
        'group' => 'Site elements',
        'label' => 'Manage team members',
    ],
    'elements.pricing.manage' => [
        'group' => 'Site elements',
        'label' => 'Manage pricing tables',
    ],
    'elements.menu.manage' => [
        'group' => 'Site elements',
        'label' => 'Manage navigation menus',
    ],
    'elements.ads.manage' => [
        'group' => 'Site elements',
        'label' => 'Manage ad zones',
    ],

    /*
    |----------------------------------------------------------------------
    | Settings
    |----------------------------------------------------------------------
    */
    'settings.general' => [
        'group' => 'Settings',
        'label' => 'Change general site settings',
        'dangerous' => true,
    ],
    'settings.pages' => [
        'group' => 'Settings',
        'label' => 'Change home / about / contact / blog page settings',
    ],
    'settings.header_footer' => [
        'group' => 'Settings',
        'label' => 'Change header and footer settings',
    ],
    'settings.notifications' => [
        'group' => 'Settings',
        'label' => 'Change notification settings',
    ],
    'settings.languages' => [
        'group' => 'Settings',
        'label' => 'Manage site languages',
        'dangerous' => true,
    ],

    /*
    |----------------------------------------------------------------------
    | Wallet (P2P marketplace foundation — balances, escrow, withdrawals)
    |----------------------------------------------------------------------
    */
    'wallet.view' => [
        'group' => 'Wallet',
        'label' => "View every user's wallet balance and transaction history",
    ],
    'wallet.escrow.manage' => [
        'group' => 'Wallet',
        'label' => 'Release or reject held escrow payments',
        'dangerous' => true,
    ],
    'wallet.withdrawals.manage' => [
        'group' => 'Wallet',
        'label' => 'Approve or reject withdrawal requests',
        'dangerous' => true,
    ],
    'wallet.topups.manage' => [
        'group' => 'Wallet',
        'label' => 'Approve or reject wallet top-up (load money) requests',
        'dangerous' => true,
    ],
    'wallet.fees.manage' => [
        'group' => 'Wallet',
        'label' => 'Change the fixed/percentage fees charged on wallet services',
        'dangerous' => true,
    ],
    'wallet.adjust' => [
        'group' => 'Wallet',
        'label' => "Manually credit or debit a user's wallet",
        'dangerous' => true,
    ],

    /*
    |----------------------------------------------------------------------
    | Currency Exchange (P2P — anyone logged in can post/buy; this is just
    | the admin moderation permission)
    |----------------------------------------------------------------------
    */
    'currency_exchange.manage' => [
        'group' => 'Currency Exchange',
        'label' => 'View and close any listing (moderation)',
    ],

    /*
    |----------------------------------------------------------------------
    | Marketplace (P2P — anyone logged in can post/bid/buy; this is just
    | the admin moderation permission)
    |----------------------------------------------------------------------
    */
    'marketplace.manage' => [
        'group' => 'Marketplace',
        'label' => 'View and close any listing (moderation)',
    ],

];
