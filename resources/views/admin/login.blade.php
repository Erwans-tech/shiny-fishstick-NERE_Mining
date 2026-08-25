<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accès administration — Néré Mining</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root { --green:#4b1716; --gold:#ffc247; --red:#d72f2f; --line:#eadcc5; --muted:#70645c; }
        *, *::before, *::after { box-sizing:border-box; margin:0; padding:0; }
        body {
            font-family:'Inter',sans-serif;
            background: linear-gradient(135deg, #1a0505 0%, #4b1716 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .box {
            background: #fff;
            border-radius: 12px;
            padding: 44px 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 24px 64px rgba(0,0,0,.35);
        }
        .box-logo { display:block; width:160px; margin:0 auto 28px; }
        .box-title {
            text-align:center;
            font:600 14px Inter,sans-serif;
            letter-spacing:.12em;
            text-transform:uppercase;
            color:var(--muted);
            margin-bottom:28px;
        }
        .alert {
            padding:11px 14px;
            border-radius:6px;
            font:500 13px Inter,sans-serif;
            margin-bottom:18px;
        }
        .alert-error   { background:#fee2e2; color:#991b1b; }
        .alert-success { background:#dcfce7; color:#166534; }
        label {
            display:block;
            font:600 11px Inter,sans-serif;
            letter-spacing:.07em;
            text-transform:uppercase;
            color:var(--muted);
            margin-bottom:6px;
        }
        input {
            width:100%;
            border:1px solid var(--line);
            border-radius:6px;
            padding:11px 13px;
            font:14px Inter,sans-serif;
            margin-bottom:16px;
            transition:border-color .15s;
        }
        input:focus { outline:none; border-color:var(--gold); }
        button {
            width:100%;
            padding:13px;
            background:var(--green);
            color:#fff;
            border:none;
            border-radius:6px;
            font:600 12px Inter,sans-serif;
            letter-spacing:.1em;
            text-transform:uppercase;
            cursor:pointer;
            transition:background .15s;
        }
        button:hover { background:#3a100f; }
        .box-footer {
            text-align:center;
            margin-top:20px;
            font:500 12px Inter,sans-serif;
            color:#ccc;
        }
        .input-error { color:#dc2626; font:12px Inter,sans-serif; margin-top:-12px; margin-bottom:12px; }
    </style>
</head>
<body>
<div class="box">
    <img class="box-logo" src="{{ asset('images/logo-nere.png') }}" alt="Néré Mining">
    <div class="box-title">Accès restreint</div>

    @if(session('error'))
    <div class="alert alert-error">{{ session('error') }}</div>
    @endif
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.login.post') }}" autocomplete="off">
        @csrf
        <label for="email">Adresse e-mail</label>
        <input id="email" type="email" name="email"
               value="{{ old('email') }}"
               required autofocus
               autocomplete="username">
        @error('email')<div class="input-error">{{ $message }}</div>@enderror

        <label for="password">Mot de passe</label>
        <input id="password" type="password" name="password"
               required autocomplete="current-password">

        <button type="submit">Connexion</button>
    </form>

    <div class="box-footer">Néré Mining S.A. — Usage interne uniquement</div>
</div>
</body>
</html>
