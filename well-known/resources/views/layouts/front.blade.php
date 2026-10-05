<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    @php $setting = App\Models\Setting::find($currentLang->id); @endphp
    <!-- Page Title -->
    <title>@yield('title')</title>
    @if($setting->loader_status == 1) 
        <script type="text/javascript">
            window.paceOptions = { ajax: false, restartOnRequestAfter: false, restartOnPushState: false};
        </script>
    @endif
    <!-- Meta Data -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Browser address/status bar color (Android Chrome & iOS Safari 15+).
         Browsers only support a single solid color here, not a gradient —
         this is a blend of the site's two brand blues (#0078ff / #00b5ff). -->
    <meta name="theme-color" content="#0097ff">
    <meta name="msapplication-navbutton-color" content="#0097ff">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <meta name="description" content="@yield('meta')">
    <link rel="canonical" href="{{url()->current()}}">
    <meta name="keywords" content="{{$setting->keywords}}" />
    <meta name="publisher" content="{{url()->current()}}">
    <meta name="copyright" content="Copyright (c) {{$setting->title}}" />
    <meta name="author" content="{{$setting->author}}" />
    <meta name="contact" content="{{$setting->contact}}" />

    <meta name="revisit-after" content="7 Days" />
    <meta name="robots" content="index, follow" />
    <meta name="googlebot" content="index, follow" />
    <meta name="subjects" content="{{$setting->title}}" />
    <meta name="classification" content="{{$setting->title}}" />

    <meta itemprop="name" content="@yield('title')">
    <meta itemprop="description" content="@yield('meta')">
    <meta itemprop="image" content="{{route('home')}}{{$setting->photo ? '/public/images/media/' . $setting->photo->file : '/public/img/200x200.png'}}">
    
    @if($setting->OGgraph_switch == 1)

    <meta property="og:title" content="@yield('title')" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{route('home')}}" />
    <meta property="og:image" content="{{route('home')}}{{$setting->photo ? '/public/images/media/' . $setting->photo->file : '/public/img/200x200.png'}}" />
    <meta property="og:site_name" content="{{$setting->author}}" />
    <meta property="og:description" content="@yield('meta')" />
    
    @endif

    @if($setting->analytics_switch == 1)

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{$setting->analytics}}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '{{$setting->analytics}}');
    </script>
    
    @endif

    @if($setting->facebook_pixel_switch == 1)

    <!-- Facebook Pixel Code --> <!-- dynamic pixel code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '{{$setting->facebook_pixel}}');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id={{$setting->facebook_pixel}}&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Facebook Pixel Code -->  <!-- dynamic pixel code -->
    
    @endif
    
    <!-- Favicon -->  <!-- dynamic favicon -->
    <link rel="shortcut icon" href="{{$setting->favicon}}" type="image/x-icon">
    <link rel="icon" href="{{$setting->favicon}}" type="image/x-icon">

    <!-- PWA: web app manifest (name/icon/colors pulled from site settings) -->
    <link rel="manifest" href="{{ route('pwa.manifest') }}">

    @php $pwaIcons = \App\Services\PwaIconGenerator::ensureIcons(); @endphp

    <!-- PWA: "Add to Home Screen" on iOS Safari, which doesn't fully use
         the manifest — these tags give a full-screen, no-address-bar
         experience and the home screen icon there too. -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="{{ $setting->title }}">
    <link rel="apple-touch-icon" href="{{ $pwaIcons[192] }}">

    <!-- PWA: standard "installable" hint for Android/Chromium browsers -->
    <meta name="mobile-web-app-capable" content="yes">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    @if($currentLang->rtl == 1) 
        <link href="{{$setting->font}}" rel="stylesheet">
    @else 
        <link href="{{$setting->font}}" rel="stylesheet">
    @endif

    @if($setting->maintenance_status == 0) 

        @if($setting->loader_status == 1)  <!-- dynamic loader -->
            <script type='text/javascript' src="{{ asset('js/front/pace.min.js') }}" id='pace-js'></script>
            <script> setTimeout(function () {Pace.stop();},4500);</script>
        @endif

     @endif

        <!-- Styles -->
        <link href="{{ asset('css/front/bootstrap.min.css') }}" type="text/css" rel="stylesheet">
        <link href="{{ asset('css/libs/fontawesome.min.css')}}" type="text/css" rel="stylesheet">
        <link href="{{ asset('css/front/owl.carousel.min.css')}}" type="text/css" rel="stylesheet">
        <link href="{{ asset('css/front/venor.css') }}?v={{ filemtime(public_path('css/front/venor.css')) }}" type="text/css" rel="stylesheet">

     

        @yield('styles')

        @if($currentLang->rtl == 1) 
            <link href="{{ asset('css/front/rtl.css') }}" type="text/css" rel="stylesheet">
        @endif


        <!-- Inline Styles -->  <!-- dynamic style -->
        <style>
            body {
                @if($currentLang->rtl == 1) 
                    font-family: 'Cairo', sans-serif;
                @else 
                    font-family: 'Quicksand', sans-serif;
                @endif
            }

            p {
                @if($currentLang->rtl == 1) 
                    font-family: 'Cairo', sans-serif;
                @else 
                    font-family: 'DM Sans', sans-serif;
                @endif
            }

            @if($setting->custom_css)
                {!! $setting->custom_css !!}
            @endif

            @if($setting->loader_status == 1) 
                .pace-cover {
                    background-image: url({!! $setting->loader_img !!});
                    background-color: {!! $setting->loader_color !!};
                }
            @endif

            /* Light / Dark logo swap */
            .header__logo .logo-dark {
                display: none;
            }
            body.dark-mode .header__logo .logo-light {
                display: none;
            }
            body.dark-mode .header__logo .logo-dark {
                display: inline-block;
            }

        </style>



    
    

</head>
<body class="common-front @if($currentLang->rtl == 1) rtl @endif @if($setting->ticker_status == 1) has-ticker @endif" @if($currentLang->rtl == 1) dir="rtl" @endif>
    <script>
        (function () {
            try {
                if (localStorage.getItem('siteTheme') === 'dark') {
                    document.body.classList.add('dark-mode');
                }
            } catch (e) {}
        })();
    </script>

    @include('ads.zone', ['key' => 'site_top', 'label' => 'Site-wide - Top of Page (every page)'])
    
    @if($setting->maintenance_status == 1) 

        <div class="maintenance_cls"><div class="maintenance_inner">{!!$setting->maintenance_text!!}</div></div>

    @endif

    @if($setting->maintenance_status == 0) 

    <!-- body -->

    @if($setting->loader_status == 1) 
    <div class="pace-cover"></div>
    @endif


    <header class="header">

        

        <div class="header__content__venor">
            <div class="header__logo">
                <a href="{{url('/')}}" title="{{$setting->title}}">
                    <img width="105" height="22" class="img-fluid logo-front logo-light" src="{{$setting->photo ? '/public/images/media/' . $setting->photo->file : '/public/img/200x200.png'}}" alt="logo">
                    <img width="105" height="22" class="img-fluid logo-front logo-dark" src="{{$setting->photoDark ? '/public/images/media/' . $setting->photoDark->file : ($setting->photo ? '/public/images/media/' . $setting->photo->file : '/public/img/200x200.png')}}" alt="logo">
                </a>
            </div>

            <div class="header__actions__venor">

                @if($headerfooter->sidebar_title2)
                <div class="header__action">
                    <a  class="header__action-btn header__action-btn--start-project" href="{{$headerfooter->sidebar_description2}}">
                        {{$headerfooter->sidebar_title2}} <svg width="11.4" height="9.2"> <use xlink:href="#arrow"></use></svg> 
                    </a>
                </div>
                @endif

                @if($headerfooter->sidebar_title)
                <div class="header__action">
                    <a  class="header__action-btn header__action-btn--start-project" href="{{$headerfooter->sidebar_description}}">
                        {{$headerfooter->sidebar_title}} <svg width="11.4" height="9.2"> <use xlink:href="#arrow"></use></svg>
                    </a>
                </div>
                @endif



                <div class="header__lang">

                    @if (!empty($currentLang) && count($langs) > 1)

                        <div class="ct-topbar-social">
                            @if (!empty($currentLang) && count($langs) > 1)
                                <a class="header__lang-btn" href="#" role="button" id="dropdownLang" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img width="16" height="16" src="{{$currentLang->photo ? '/public/images/media/' . $currentLang->photo->file : '/public/img/200x200.png'}}" alt="flag">
                                    <span>{{$currentLang->name}}</span>
                                </a>

                 
                                <ul class="dropdown-menu header__lang-dropdown" aria-labelledby="dropdownLang">
                                    @foreach ($langs as $key => $lang)
                                    <li><a title="{{$lang->name}}"  href='{{ route('changeLanguage', $lang->code) }}'><img width="16" height="16" src="{{$lang->photo ? '/public/images/media/' . $lang->photo->file : '/public/img/200x200.png'}}" alt="flag"><span>{{$lang->name}}</span></a></li>
                                    @endforeach
                                </ul>
                            @endif
                         </div>

                    @endif

                </div>

                <div class="header__cart" id="headerCartWrap" style="margin-left:14px; display:{{ app(\App\Services\CartService::class)->count() ? 'inline-flex' : 'none' }};">
                    <a href="{{ route('cart.index') }}" title="Cart" id="headerCartLink" style="position:relative; display:inline-flex; align-items:center; color:inherit;">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                        <span id="header-cart-count" style="position:absolute; top:-8px; right:-10px; background:#0097ff; color:#fff; font-size:11px; font-weight:700; line-height:1; border-radius:50%; min-width:16px; height:16px; align-items:center; justify-content:center; padding:2px; display:{{ app(\App\Services\CartService::class)->count() ? 'flex' : 'none' }};">{{ app(\App\Services\CartService::class)->count() }}</span>
                    </a>
                </div>

            </div>

            <div class="header-burger">
                <div class="burger"><span></span><span></span><span></span></div>
            </div>
        </div>
    </header>

    @if($setting->ticker_status == 1 && trim($setting->ticker_text))
    <div class="site-ticker">
        <span class="site-ticker__label">{{ $currentLang->code == 'bn' ? 'শিরোনাম' : 'Headlines' }}</span>
        <div class="site-ticker__track">
            <div class="site-ticker__content">
                @php
                    $rawTicker = $setting->ticker_text;
                    // Ticker textarea gets auto-converted to a rich-text (TinyMCE)
                    // editor site-wide, so line breaks arrive as <p>/<br> HTML
                    // instead of plain \n - normalize both formats to \n here.
                    $rawTicker = preg_replace('/<br\s*\/?>/i', "\n", $rawTicker);
                    $rawTicker = preg_replace('/<\/p>\s*<p[^>]*>/i', "\n", $rawTicker);
                    $rawTicker = strip_tags($rawTicker);
                    $tickerItems = array_filter(array_map('trim', explode("\n", $rawTicker)));
                @endphp
                @foreach (array_merge($tickerItems, $tickerItems) as $item)
                    <span class="site-ticker__item">{{ $item }}</span>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <div class="fixed-sidebar-menu-overlay" style="opacity: 0;"></div>

    <div class="fixed-sidebar-menu-holder header7">
        <div class="fixed-sidebar-menu">
            <div class="header7 sidebar-content">
                <div class="left-side">

                    <div class="left-side-inner">

                        <div class="header__menu__venor">
                            <ul class="header__nav">

                                @foreach( $menus->sortBy('order') as $prod )
                                   
                                    @if($prod->on_off_submenu == 1)
                                       <li class="header__nav-item dropdown">
                                            <a class="header__nav-link dropdown-toggle" href="{{$prod->link}}"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{$prod->name}}
                                            </a>
                                            {!! $prod->submenu !!}
                                           
                                        </li>
                                    @else 
                                         <li class="header__nav-item"> <a title="{{$prod->name}}" class="header__nav-link" href="{{$prod->link}}">{{$prod->name}}</a> </li>
                                    @endif
                                @endforeach

                            </ul>
                        </div>

                        <div class="menu-description">
                            {!!$headerfooter->sidebar_menu_description!!}
                        </div>

                        <div class="header-social-share">
                            {!!$headerfooter->social_links!!}
                        </div>


                        <div class="address-sidebar">
                            <div><img width="16" height="16" src="/public/img/map-pin.svg" alt="map-pin.svg" > {!!$setting->address!!}</div>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>


    @include('ads.zone', ['key' => 'site_below_header', 'label' => 'Site-wide - Below Header (every page)'])

        </div>


    <div id="dm-content-wrap">
    @yield('content')

    @php
        // Admin-set font sizes (Settings > Header and footer). Empty = theme default.
        $hfSizes = [
            '.typed-section H4, .typed-section H4 span' => [$headerfooter->typed_font_size ?? null, 1.35],
            '.footer-section .inner > span' => [$headerfooter->footer_col1_subtitle_size ?? null, 1.4],
            '.footer-section .inner h4' => [$headerfooter->footer_col1_title_size ?? null, 1.25],
            '.footer-section h4.title' => [$headerfooter->footer_col2_title_size ?? null, 1.3],
            '.footer-section .menu-quick-link-container, .footer-section .menu-quick-link-container a, .footer-section .menu-quick-link-container li, .footer-section .custom-html-widget, .footer-section .custom-html-widget a, .footer-section .custom-html-widget li, .footer-section .custom-html-widget p, .footer-section ul.ft-link li a' => [$headerfooter->footer_col2_text_size ?? null, 1.5],
            '.footer-section .copyright-text, .footer-section .copyright-text p, .footer-section .copyright-text a' => [$headerfooter->footer_copyright_size ?? null, 1.5],
        ];
    @endphp
    <style>
    @foreach ($hfSizes as $selector => $def)
        @if (! empty($def[0]))
        {!! $selector !!} { font-size: {{ (int) $def[0] }}px !important; line-height: {{ $def[1] }} !important; min-height: 0 !important; }
        @endif
    @endforeach
    </style>
    <div class="typed-section">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                        <h4 class="parent-typed-text">
                        <span class="mt_typed-beforetext">{{$headerfooter->typed_title}} </span>
                            <span class="mt_typed_text"></span>

                        </h4>
                </div>
                <div class="col-md-4 text-right">
                    <a href="{{$headerfooter->typed_buttonlink}}" target="_self" class="btn btn-style1"><span>{{$headerfooter->typed_buttontext}}</span><svg width="11.4" height="9.2"> <use xlink:href="#arrow"></use></svg></a>
                </div>
            </div>
        </div>
    </div>   


    @include('ads.zone', ['key' => 'site_above_footer', 'label' => 'Site-wide - Above Footer (every page)'])

    <footer class="footer-section">
        <div class="footer-wrapper">
            <div class="row align-items-end">
                <div class="col-lg-6">
                    <div class="footer-left">
                        <div class="inner">
                            <span>{{$headerfooter->footer_col1_subtitle}}</span>
                            <h4>{{$headerfooter->footer_col1_title}}</h4>
                            <a class="btn btn-style2" href="{{$headerfooter->footer_col1_buttonlink}}"> <span>{{$headerfooter->footer_col1_buttontext}}</span> <svg width="11.4" height="9.2"> <use xlink:href="#arrow"></use></svg></a> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="footer-right">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="footer-widget">
                                    <div class="footer-widget widget_nav_menu">
                                        <h4 class="title">{{$headerfooter->footer_col2_title1}}</h4>
                                        <span class="venor-animate-border"></span>
                                        <div class="menu-quick-link-container">
                                            {!!$headerfooter->footer_col2_html1!!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="footer-widget">
                                    <div class="widget widget_custom_html">
                                        <h4 class="title">{{$headerfooter->footer_col2_title2}}</h4>
                                        <span class="venor-animate-border"></span>
                                        <div class="custom-html-widget">
                                            {!!$headerfooter->footer_col2_html2!!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="copyright-text">
                                    {!!$headerfooter->footer_copyright!!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    </div>


    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"/>
        </svg>
    </div>
  




    @if($setting->SchmeaORG_switch == 1)

    <div class="hidden"  itemscope="" itemtype="https://schema.org/LocalBusiness">
        <span itemprop="description">@yield('meta')</span> 
        <a itemprop="url" href="{{route('home')}}"> </a>
        <div itemprop="image" itemscope itemtype="http://schema.org/ImageObject">
        <img src="{{route('home')}}{{$setting->photo ? '/public/images/media/' . $setting->photo->file : '/public/img/200x200.png'}}" alt="logo" width="120" itemprop="url"></div>
        <span itemprop="name">{{$setting->title}}</span>
        <em><span itemprop="priceRange">{{$setting->price_range}}</span></em>
        <div itemprop="address" itemscope="" itemtype="https://schema.org/PostalAddress"> 
            <span itemprop="addressLocality">{{$setting->address}}</span> | 
            <span itemprop="addressCountry">{{$setting->country}}</span> | 
            <span itemprop="telephone">{{$setting->phone}}</span> | 
            <span itemprop="email">{{$setting->contact}}</span>
        </div>
    </div> 

    @endif

    <button type="button" class="theme-toggle-btn theme-toggle-btn--floating" id="themeToggleBtn" aria-label="Toggle dark mode" title="Toggle dark mode">
        <svg class="theme-toggle-icon theme-toggle-icon--sun" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>
        <svg class="theme-toggle-icon theme-toggle-icon--moon" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
    </button>

    @if($setting->whatsapp == 1)

    <a target="_blank" class="codeless-add-purchase-button" href="https://wa.me/{{$setting->phone}}"><i class="icon"><svg height="682pt" viewBox="-23 -21 682 682.66669" width="682pt" xmlns="http://www.w3.org/2000/svg"><path d="m544.386719 93.007812c-59.875-59.945312-139.503907-92.9726558-224.335938-93.007812-174.804687 0-317.070312 142.261719-317.140625 317.113281-.023437 55.894531 14.578125 110.457031 42.332032 158.550781l-44.992188 164.335938 168.121094-44.101562c46.324218 25.269531 98.476562 38.585937 151.550781 38.601562h.132813c174.785156 0 317.066406-142.273438 317.132812-317.132812.035156-84.742188-32.921875-164.417969-92.800781-224.359376zm-224.335938 487.933594h-.109375c-47.296875-.019531-93.683594-12.730468-134.160156-36.742187l-9.621094-5.714844-99.765625 26.171875 26.628907-97.269531-6.269532-9.972657c-26.386718-41.96875-40.320312-90.476562-40.296875-140.28125.054688-145.332031 118.304688-263.570312 263.699219-263.570312 70.40625.023438 136.589844 27.476562 186.355469 77.300781s77.15625 116.050781 77.132812 186.484375c-.0625 145.34375-118.304687 263.59375-263.59375 263.59375zm144.585938-197.417968c-7.921875-3.96875-46.882813-23.132813-54.148438-25.78125-7.257812-2.644532-12.546875-3.960938-17.824219 3.96875-5.285156 7.929687-20.46875 25.78125-25.09375 31.066406-4.625 5.289062-9.242187 5.953125-17.167968 1.984375-7.925782-3.964844-33.457032-12.335938-63.726563-39.332031-23.554687-21.011719-39.457031-46.960938-44.082031-54.890626-4.617188-7.9375-.039062-11.8125 3.476562-16.171874 8.578126-10.652344 17.167969-21.820313 19.808594-27.105469 2.644532-5.289063 1.320313-9.917969-.664062-13.882813-1.976563-3.964844-17.824219-42.96875-24.425782-58.839844-6.4375-15.445312-12.964843-13.359374-17.832031-13.601562-4.617187-.230469-9.902343-.277344-15.1875-.277344-5.28125 0-13.867187 1.980469-21.132812 9.917969-7.261719 7.933594-27.730469 27.101563-27.730469 66.105469s28.394531 76.683594 32.355469 81.972656c3.960937 5.289062 55.878906 85.328125 135.367187 119.648438 18.90625 8.171874 33.664063 13.042968 45.175782 16.695312 18.984374 6.03125 36.253906 5.179688 49.910156 3.140625 15.226562-2.277344 46.878906-19.171875 53.488281-37.679687 6.601563-18.511719 6.601563-34.375 4.617187-37.683594-1.976562-3.304688-7.261718-5.285156-15.183593-9.253906zm0 0" fill-rule="evenodd"></path></svg></i></a>
    
    @endif

    {{-- Slide-in shopping cart drawer (opens over any page when the header
         cart icon is clicked, or right after Add to Cart) --}}
    <div class="cart-drawer-backdrop" id="cartDrawerBackdrop" onclick="closeCartDrawer()"></div>
    <div class="cart-drawer" id="cartDrawer">
        <div class="cart-drawer__head">
            <h5>Shopping Cart</h5>
            <button type="button" class="cart-drawer__close" onclick="closeCartDrawer()">&times;</button>
        </div>
        <div class="cart-drawer__body" id="cartDrawerBody">
            <div class="cart-drawer__empty">Loading…</div>
        </div>
        <div class="cart-drawer__foot" id="cartDrawerFoot" style="display:none;">
            <div class="cart-drawer__subtotal"><span>Subtotal</span><span id="cartDrawerSubtotal"></span></div>
            <a href="{{ route('cart.index') }}" class="cart-drawer__checkout-btn" id="cartDrawerCheckoutBtn">Process to Checkout</a>
            <div class="cart-drawer__note">Shipping, Taxes &amp; Discount Calculate At Checkout</div>
        </div>
    </div>

    <!-- PWA: "Install App" button — hidden until the browser tells us
         (via beforeinstallprompt) that this site is actually installable,
         and hidden again if it's already installed/running standalone. -->
    <button type="button" id="pwaInstallBtn" class="pwa-install-btn" style="display:none;">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
        <span>Install App</span>
    </button>

    <style>
        .pwa-install-btn {
            position: fixed;
            left: 20px;
            bottom: 20px;
            z-index: 999;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 18px;
            border: none;
            border-radius: 30px;
            background: #0097ff;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            box-shadow: 0 6px 20px rgba(0,151,255,0.4);
            cursor: pointer;
        }
        .pwa-install-btn:hover { background: #0078ff; }
        @media (max-width: 767px) {
            .pwa-install-btn { left: 12px; bottom: 12px; padding: 10px 16px; font-size: 13px; }
        }
        /* In RTL layouts the WhatsApp/theme-toggle buttons move to the
           left, so keep this one on the right instead to avoid overlap. */
        .rtl .pwa-install-btn { left: auto; right: 20px; }
        @media (max-width: 767px) {
            .rtl .pwa-install-btn { right: 12px; }
        }

        /* Cart icon overlaps the burger menu button on narrow screens
           because .header-burger is absolutely positioned — give the
           cart its own safe zone on mobile without touching venor.css. */
        @media (max-width: 767px) {
            .header__actions__venor { margin-right: 58px !important; }
            .header__cart { margin-left: 6px !important; }
        }

        /* Slide-in cart drawer (desktop: fixed-width panel from the
           right; mobile: full-width). Markup lives in
           layouts/partials/cart-drawer.blade.php */
        .cart-drawer-backdrop {
            position: fixed; inset: 0; background: rgba(15,17,23,.45);
            z-index: 10000; opacity: 0; pointer-events: none; transition: opacity .25s ease;
        }
        .cart-drawer-backdrop.open { opacity: 1; pointer-events: auto; }
        .cart-drawer {
            position: fixed; top: 0; right: 0; height: 100vh; height: 100dvh; width: 420px; max-width: 100vw;
            background: #fff; z-index: 10001; box-shadow: -8px 0 30px rgba(0,0,0,.12);
            transform: translateX(100%); transition: transform .3s ease;
            display: flex; flex-direction: column;
        }
        .cart-drawer.open { transform: translateX(0); }
        @media (max-width: 767px) {
            .cart-drawer { width: 100vw; }
        }
        .cart-drawer__head {
            display: flex; align-items: center; justify-content: space-between;
            padding: 20px 24px; border-bottom: 1px solid #eee; flex: 0 0 auto;
        }
        .cart-drawer__head h5 { margin: 0; font-weight: 700; }
        .cart-drawer__close { background: none; border: none; font-size: 22px; line-height: 1; color: #999; cursor: pointer; }
        .cart-drawer__body { flex: 1 1 auto; min-height: 0; overflow-y: auto; padding: 8px 24px; }
        .cart-drawer__item { display: flex; gap: 14px; align-items: center; padding: 16px 0; border-bottom: 1px solid #f2f2f2; }
        .cart-drawer__item img { width: 64px; height: 64px; object-fit: cover; border-radius: 10px; background: #f7f7f7; }
        .cart-drawer__item .name { font-weight: 700; font-size: 14px; }
        .cart-drawer__item .variant { color: #888; font-size: 12px; }
        .cart-drawer__item .price { margin-top: 4px; font-weight: 600; font-size: 14px; }
        .cart-drawer-qty { display: inline-flex; align-items: center; border: 1px solid #e2e6ee; border-radius: 30px; }
        .cart-drawer-qty button { width: 24px; height: 24px; border-radius: 50%; border: none; background: transparent; font-weight: 700; }
        .cart-drawer-qty span { padding: 0 8px; font-size: 13px; }
        .cart-drawer__remove { background: none; border: none; color: #e34a4a; }
        .cart-drawer__foot { padding: 18px 24px 24px; border-top: 1px solid #eee; flex: 0 0 auto; }
        .cart-drawer__subtotal { display: flex; justify-content: space-between; font-weight: 700; margin-bottom: 14px; }
        .cart-drawer__checkout-btn {
            display: block; width: 100%; text-align: center; padding: 14px; border-radius: 30px;
            background: #0097ff; color: #fff; font-weight: 700; text-decoration: none; box-sizing: border-box;
        }
        .cart-drawer__checkout-btn:hover { background: #0078ff; color: #fff; }
        .cart-drawer__note { text-align: center; font-size: 12px; color: #999; margin-top: 10px; }
        .cart-drawer__empty { text-align: center; color: #999; padding: 60px 10px; }
    </style>

    <script>
        (function () {
            var installBtn = document.getElementById('pwaInstallBtn');
            var deferredPrompt = null;

            // Already running as an installed app — nothing to offer.
            if (window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone === true) {
                return;
            }

            window.addEventListener('beforeinstallprompt', function (e) {
                e.preventDefault();
                deferredPrompt = e;
                installBtn.style.display = 'flex';
            });

            installBtn.addEventListener('click', function () {
                if (!deferredPrompt) return;
                deferredPrompt.prompt();
                deferredPrompt.userChoice.finally(function () {
                    deferredPrompt = null;
                    installBtn.style.display = 'none';
                });
            });

            window.addEventListener('appinstalled', function () {
                installBtn.style.display = 'none';
            });
        })();
    </script>

    @php
        $notif = \App\Models\NotificationSetting::find($currentLang->id);
        $showNotif = $notif && $notif->is_enabled && ($notif->title || $notif->description);
        $notifHasButton = $notif && $notif->button_text && $notif->button_link;
    @endphp

    @if ($showNotif)
    <div id="siteNotifOverlay" class="site-notif-overlay">
        <div class="site-notif-card">
            <button type="button" id="siteNotifClose" class="site-notif-close" aria-label="Close">&times;</button>

            <div class="site-notif-top">
                @if ($notif->photo)
                    <img src="/public/images/media/{{ $notif->photo->file }}" alt="" class="site-notif-icon">
                @endif
                @if ($notif->badge_text)
                    <span class="site-notif-badge">{{ $notif->badge_text }}</span>
                @endif
            </div>

            @if ($notif->title)
                <h3 class="site-notif-title">{{ $notif->title }}</h3>
            @endif

            @if ($notif->description)
                <p class="site-notif-desc">{{ $notif->description }}</p>
            @endif

            @if ($notifHasButton)
                <a href="{{ $notif->button_link }}" target="_blank" rel="noopener" class="site-notif-btn">{{ $notif->button_text }}</a>
            @endif
        </div>
    </div>

    <style>
        .site-notif-overlay {
            position: fixed;
            inset: 0;
            z-index: 10000;
            background: rgba(0,0,0,0.45);
            display: flex;
            align-items: flex-end;
            justify-content: center;
        }
        @media (min-width: 768px) {
            .site-notif-overlay { align-items: center; }
        }
        .site-notif-card {
            position: relative;
            background: #fff;
            width: 100%;
            max-width: 480px;
            padding: 30px 24px 26px;
            border-radius: 20px 20px 0 0;
            box-shadow: 0 -10px 40px rgba(0,0,0,0.2);
            animation: siteNotifSlideUp 0.35s ease-out;
        }
        @media (min-width: 768px) {
            .site-notif-card { border-radius: 20px; margin: 0 16px; }
        }
        @keyframes siteNotifSlideUp {
            from { transform: translateY(40px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .site-notif-close {
            position: absolute;
            top: 14px;
            right: 16px;
            background: #f1f1f1;
            border: none;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            font-size: 20px;
            line-height: 1;
            color: #555;
            cursor: pointer;
        }
        .site-notif-top {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 14px;
        }
        .site-notif-icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            object-fit: cover;
        }
        .site-notif-badge {
            background: #e6f7ee;
            color: #0f9d58;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: .04em;
            padding: 5px 12px;
            border-radius: 20px;
        }
        .site-notif-title {
            font-size: 24px;
            font-weight: 700;
            margin: 0 0 10px;
            color: #1a1a1a;
        }
        .site-notif-desc {
            font-size: 15px;
            color: #666;
            margin: 0 0 20px;
            line-height: 1.5;
        }
        .site-notif-btn {
            display: block;
            text-align: center;
            background: #0097ff;
            color: #fff !important;
            font-weight: 600;
            padding: 14px 20px;
            border-radius: 30px;
            text-decoration: none;
        }
        .site-notif-btn:hover { background: #0078ff; }
    </style>

    <script>
        (function () {
            var STORAGE_KEY = 'siteNotifDismissed_{{ $notif->updated_at->timestamp ?? 0 }}';
            var overlay = document.getElementById('siteNotifOverlay');
            if (!overlay) return;

            // Show once per browser session per version of this notification
            // (re-editing it in the admin will show it again to everyone).
            if (sessionStorage.getItem(STORAGE_KEY)) {
                overlay.remove();
                return;
            }

            function dismiss() {
                sessionStorage.setItem(STORAGE_KEY, '1');
                overlay.remove();
            }

            document.getElementById('siteNotifClose').addEventListener('click', dismiss);
            overlay.addEventListener('click', function (e) {
                if (e.target === overlay) dismiss();
            });
        })();
    </script>
    @endif



    <script src="{{ asset('js/libs/jquery.min.js') }}"></script>
    <script src="{{ asset('js/front/popper.min.js') }}"></script>
    <script src="{{ asset('js/front/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('js/front/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/front/simpleParallax.min.js') }}" defer></script>
    <script src="{{ asset('js/front/countTO.js') }}" defer></script>
    <script src="{{ asset('js/front/typed.min.js') }}" defer></script>
    <script src="{{ asset('js/front/shuffleLetters.js') }} " defer></script>
    <script src="{{ asset('js/front/magnific.min.js') }}" defer></script>
    <script src="{{ asset('js/front/scrollreveal.min.js') }}" defer></script>
    <script>
        var sliderAutoplaySeconds = {{ (int) ($setting->slider_autoplay_seconds ?? 8) }};
    </script>
    <script src="{{ asset('js/front/venor.js') }}" defer></script>

    <script>
        (function () {
            var btn = document.getElementById('themeToggleBtn');
            if (!btn) { return; }
            btn.addEventListener('click', function () {
                var isDark = document.body.classList.toggle('dark-mode');
                try {
                    localStorage.setItem('siteTheme', isDark ? 'dark' : 'light');
                } catch (e) {}
            });
        })();
    </script>

    <svg width="0" height="0" display="none" xmlns="http://www.w3.org/2000/svg">
        <symbol id="arrow" xmlns="http://www.w3.org/2000/svg" width="11.4" height="9.2"><path d="M11.3 4.1L8.1.2c-.3-.2-.7-.3-1 0-.3.2-.3.6-.1.9l2.3 2.8H.7c-.4 0-.7.3-.7.7 0 .4.3.7.7.7h8.6L7 8c-.2.3-.2.8.1 1 .3.2.7.2 1-.1L11.3 5c.2-.3.2-.6 0-.9z"/></symbol>
        <symbol id="chat" xmlns="http://www.w3.org/2000/svg" width="30.2" height="30.2" viewBox="0 0 30.2 30.2"><path d="M15.1 29c-2.5 0-5-.7-7.2-2l-.2-.1-5.1 1.5c-.2.1-.4 0-.5-.1-.2-.1-.2-.3-.2-.5l1.5-5.1-.1-.2c-1.3-2.2-2-4.7-2-7.3 0-7.7 6.2-13.9 13.9-13.9S29 7.4 29 15.1C29 22.8 22.7 29 15.1 29zm0-29C6.8 0 0 6.8 0 15.1c0 2.7.7 5.3 2 7.6l.1.1-1.3 4.6c-.2.6 0 1.2.4 1.7.4.4 1.1.6 1.7.4l4.7-1.3.1.1c2.3 1.3 4.9 2 7.5 2 8.3 0 15.1-6.8 15.1-15.1S23.4 0 15.1 0z"/><path d="M7.7 18.1c-1.6 0-3-1.3-3-3 0-1.6 1.3-3 3-3 1.6 0 3 1.3 3 3s-1.4 3-3 3zm0-5c-1.1 0-2.1.9-2.1 2.1 0 1.1.9 2.1 2.1 2.1s2.1-.9 2.1-2.1c0-1.2-1-2.1-2.1-2.1zM14.8 18.1c-1.6 0-3-1.3-3-3 0-1.6 1.3-3 3-3 1.6 0 3 1.3 3 3s-1.3 3-3 3zm0-5c-1.1 0-2.1.9-2.1 2.1 0 1.1.9 2.1 2.1 2.1s2.1-.9 2.1-2.1c0-1.2-.9-2.1-2.1-2.1zM21.8 18.1c-1.6 0-3-1.3-3-3 0-1.6 1.3-3 3-3 1.6 0 3 1.3 3 3s-1.4 3-3 3zm0-5c-1.1 0-2.1.9-2.1 2.1 0 1.1.9 2.1 2.1 2.1 1.1 0 2.1-.9 2.1-2.1-.1-1.2-1-2.1-2.1-2.1z"/></symbol>
        <symbol id="scroll" xmlns="http://www.w3.org/2000/svg" width="15" height="22.1"><path class="st0" d="M7.5 16.5c.6 0 1.1.5 1.1 1.1 0 .6-.5 1.1-1.1 1.1-.6 0-1.1-.5-1.1-1.1 0-.6.5-1.1 1.1-1.1zM7.5 9.8c.6 0 1.1.5 1.1 1.1 0 .6-.5 1.1-1.1 1.1-.6 0-1.1-.5-1.1-1.1 0-.6.5-1.1 1.1-1.1zM7.5 6.5c.6 0 1.1.5 1.1 1.1 0 .6-.5 1.1-1.1 1.1-.6 0-1.1-.5-1.1-1.1 0-.6.5-1.1 1.1-1.1zM7.5 3.2c.6 0 1.1.5 1.1 1.1 0 .6-.5 1.1-1.1 1.1-.6 0-1.1-.5-1.1-1.1 0-.6.5-1.1 1.1-1.1zM7.5 0c.6 0 1.1.5 1.1 1.1 0 .6-.5 1.1-1.1 1.1-.6 0-1.1-.5-1.1-1.1C6.4.5 6.9 0 7.5 0zM7.5 19.8c.6 0 1.1.5 1.1 1.1 0 .6-.5 1.1-1.1 1.1-.6 0-1.1-.5-1.1-1.1 0-.6.5-1.1 1.1-1.1zM4.2 16.5c.6 0 1.1.5 1.1 1.1 0 .6-.5 1.1-1.1 1.1-.6 0-1.1-.5-1.1-1.1 0-.6.5-1.1 1.1-1.1zM10.6 16.5c.6 0 1.1.5 1.1 1.1 0 .6-.5 1.1-1.1 1.1-.6 0-1.1-.5-1.1-1.1 0-.6.5-1.1 1.1-1.1zM7.5 13.2c.6 0 1.1.5 1.1 1.1 0 .6-.5 1.1-1.1 1.1-.6 0-1.1-.5-1.1-1.1 0-.6.5-1.1 1.1-1.1zM1.9 13.5c.4.4.4 1.2 0 1.6-.4.4-1.2.4-1.6 0-.4-.4-.4-1.2 0-1.6.5-.4 1.2-.4 1.6 0M4.3 13.2c.6 0 1.1.5 1.1 1.1 0 .6-.5 1.1-1.1 1.1-.6 0-1.1-.5-1.1-1.1 0-.6.5-1.1 1.1-1.1zM14.7 13.5c.4.4.4 1.2 0 1.6-.4.4-1.2.4-1.6 0-.4-.4-.4-1.2 0-1.6.4-.4 1.1-.4 1.6 0M10.7 13.2c.6 0 1.1.5 1.1 1.1 0 .6-.5 1.1-1.1 1.1-.6 0-1.1-.5-1.1-1.1 0-.6.5-1.1 1.1-1.1z"/></symbol>

    </svg>


    @include('cookieConsent::index')

    <script>
        (function () {
            var currency = @json(config('shop.currency_symbol'));
            var isAuthed = @json(auth()->check());
            var loginUrl = @json(route('login'));

            function csrfToken() {
                var m = document.querySelector('meta[name="csrf-token"]');
                return m ? m.getAttribute('content') : '';
            }

            function postForm(url, data) {
                var body = new URLSearchParams(data);
                return fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken(),
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: body
                }).then(function (r) { return r.json(); });
            }

            function getJson(url) {
                return fetch(url, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
                }).then(function (r) { return r.json(); });
            }

            function renderDrawer(data) {
                var body = document.getElementById('cartDrawerBody');
                var foot = document.getElementById('cartDrawerFoot');
                var badge = document.getElementById('header-cart-count');

                if (badge) {
                    badge.textContent = data.count;
                    badge.style.display = data.count ? 'flex' : 'none';
                }

                var headerCartWrap = document.getElementById('headerCartWrap');
                if (headerCartWrap) {
                    headerCartWrap.style.display = data.count ? 'inline-flex' : 'none';
                }

                if (!data.items || data.items.length === 0) {
                    body.innerHTML = '<div class="cart-drawer__empty">Your cart is empty.</div>';
                    foot.style.display = 'none';
                    return;
                }

                var html = '';
                data.items.forEach(function (item) {
                    html += '' +
                        '<div class="cart-drawer__item" data-key="' + item.key + '">' +
                            '<img src="' + item.image + '" alt="">' +
                            '<div class="flex-grow-1">' +
                                '<div class="name">' + item.title + '</div>' +
                                (item.variant ? '<div class="variant">' + item.variant + '</div>' : '') +
                                '<div class="price">' + currency + item.unit_price + '</div>' +
                            '</div>' +
                            '<div class="cart-drawer-qty">' +
                                '<button type="button" onclick="cartDrawerChangeQty(\'' + item.key + '\', ' + (item.quantity - 1) + ')">-</button>' +
                                '<span>' + item.quantity + '</span>' +
                                '<button type="button" onclick="cartDrawerChangeQty(\'' + item.key + '\', ' + (item.quantity + 1) + ')">+</button>' +
                            '</div>' +
                            '<button type="button" class="cart-drawer__remove" onclick="cartDrawerRemove(\'' + item.key + '\')" title="Remove">&times;</button>' +
                        '</div>';
                });
                body.innerHTML = html;
                foot.style.display = 'block';
                document.getElementById('cartDrawerSubtotal').textContent = currency + data.subtotal;

                var checkoutBtn = document.getElementById('cartDrawerCheckoutBtn');
                checkoutBtn.href = isAuthed ? '{{ route('checkout.address') }}' : loginUrl;
                checkoutBtn.textContent = isAuthed ? 'Process to Checkout' : 'Login to Checkout';
            }

            window.refreshCartDrawer = function () {
                getJson('{{ route('cart.mini') }}').then(renderDrawer);
            };

            window.openCartDrawer = function () {
                document.getElementById('cartDrawer').classList.add('open');
                document.getElementById('cartDrawerBackdrop').classList.add('open');
                document.body.style.overflow = 'hidden';
                window.refreshCartDrawer();
            };

            window.closeCartDrawer = function () {
                document.getElementById('cartDrawer').classList.remove('open');
                document.getElementById('cartDrawerBackdrop').classList.remove('open');
                document.body.style.overflow = '';
            };

            window.cartDrawerChangeQty = function (key, quantity) {
                postForm('{{ route('cart.update') }}', { key: key, quantity: quantity }).then(renderDrawer);
            };

            window.cartDrawerRemove = function (key) {
                postForm('{{ route('cart.remove') }}', { key: key }).then(renderDrawer);
            };

            document.addEventListener('DOMContentLoaded', function () {
                var link = document.getElementById('headerCartLink');
                if (link) {
                    link.addEventListener('click', function (e) {
                        e.preventDefault();
                        openCartDrawer();
                    });
                }

                document.querySelectorAll('form.js-add-to-cart-form').forEach(function (form) {
                    form.addEventListener('submit', function (e) {
                        e.preventDefault();
                        var data = new URLSearchParams(new FormData(form));
                        fetch(form.action, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken(),
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            },
                            body: data
                        })
                        .then(function (r) { return r.json(); })
                        .then(function (resp) {
                            if (resp.error) {
                                alert(resp.error);
                                return;
                            }
                            openCartDrawer();
                        });
                    });
                });
            });
        })();
    </script>






    @yield('scripts')


    <!-- body -->

    @endif



    @include('ads.zone', ['key' => 'site_bottom', 'label' => 'Site-wide - Bottom of Page / popup scripts (every page)'])

    <!-- PWA: register the service worker (enables Add to Home Screen,
         fast repeat loads, and basic offline support). -->
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function () {
                navigator.serviceWorker.register('/sw.js').catch(function (err) {
                    console.warn('Service worker registration failed:', err);
                });
            });
        }
    </script>

</body>
</html>
