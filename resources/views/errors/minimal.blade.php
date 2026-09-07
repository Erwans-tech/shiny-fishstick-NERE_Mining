<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | Néré Mining</title>
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <style>
        body{min-height:100vh;margin:0;display:grid;place-items:center;background:#f8f3ee;color:#281d18;font-family:Inter,Arial,sans-serif}
        main{max-width:620px;padding:40px;text-align:center}strong{display:block;color:#4b1716;font-size:clamp(56px,12vw,120px);line-height:1}h1{font-size:28px;margin:18px 0 10px}p{color:#70645c;line-height:1.7}a{display:inline-block;margin-top:18px;padding:12px 18px;border-radius:6px;background:#4b1716;color:#fff;text-decoration:none;font-weight:700}
    </style>
</head>
<body><main><strong>@yield('code')</strong><h1>@yield('title')</h1><p>@yield('message')</p><a href="{{ url('/') }}">Retour à l’accueil</a></main></body>
</html>