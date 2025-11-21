<!DOCTYPE html>
<html lang="{{ getLocale() }}" dir="{{ getDirection() }}">

<head>
    @include('themes.basic.includes.head')
    <x-ad alias="head_code" />
    <!-- Facebook Pixel Code --><script>!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,'script','https://connect.facebook.net/en_US/fbevents.js'); fbq('init', '769044335569870'); fbq('track', 'PageView');</script><noscript> <img height="1" width="1" src="https://www.facebook.com/tr?id=769044335569870&ev=PageView&noscript=1"/></noscript><!-- End Facebook Pixel Code -->
</head>

<body {{ @$settings->announcement->status && !request()->hasCookie('announce_close') ? 'class=pt-0' : '' }}>
    <x-announcement />
    @include('themes.basic.includes.navbar')
    @yield('content')
    @include('themes.basic.includes.footer')
    @include('themes.basic.includes.config')
    @include('themes.basic.includes.scripts')
</body>

</html>
