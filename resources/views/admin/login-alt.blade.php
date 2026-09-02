<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Diagnostic — Néré Mining</title>
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
        .box-title {
            text-align:center;
            font:600 14px sans-serif;
            letter-spacing:.12em;
            text-transform:uppercase;
            color:var(--muted);
            margin-bottom:28px;
        }
        .alert {
            padding:11px 14px;
            border-radius:6px;
            font:500 13px sans-serif;
            margin-bottom:18px;
        }
        .alert-error   { background:#fee2e2; color:#991b1b; }
        .alert-success { background:#dcfce7; color:#166534; }
        .alert-info    { background:#dbeafe; color:#1e40af; }
        label {
            display:block;
            font:600 11px sans-serif;
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
            font:14px sans-serif;
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
            font:600 12px sans-serif;
            letter-spacing:.1em;
            text-transform:uppercase;
            cursor:pointer;
            transition:background .15s;
            margin-bottom:10px;
        }
        button:hover { background:#3a100f; }
        .debug-info {
            font:11px monospace;
            background:#f8f9fa;
            padding:10px;
            border-radius:4px;
            color:#666;
            margin-top:15px;
        }
        .input-error { color:#dc2626; font:12px sans-serif; margin-top:-12px; margin-bottom:12px; }
        a { color:var(--green); text-decoration:none; font-size:12px; }
    </style>
</head>
<body>
<div class="box">
    <div class="box-title">Login Diagnostic (Sans CSRF)</div>
    
    <div class="alert alert-info">
        ⚠️ Version diagnostic sans protection CSRF. À utiliser uniquement pour diagnostiquer le problème de session.
    </div>

    @if(session('error'))
    <div class="alert alert-error">{{ session('error') }}</div>
    @endif
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('admin.login.alt.post') }}">
        <label for="email">Adresse e-mail</label>
        <input id="email" type="email" name="email"
               value="{{ old('email', 'admin@nere-mining.com') }}"
               required autofocus>
        @error('email')<div class="input-error">{{ $message }}</div>@enderror

        <label for="password">Mot de passe</label>
        <input id="password" type="password" name="password"
               placeholder="NereAdmin2024!"
               required>

        <button type="submit">Connexion (sans CSRF)</button>
    </form>
    
    <div style="text-align:center; margin-top:15px;">
        <a href="{{ route('admin.diagnostic') }}">🔍 Voir diagnostic système</a> |
        <a href="{{ route('admin.login') }}">🔒 Login normal</a>
    </div>

    <div class="debug-info">
        <strong>Debug Info:</strong><br>
        Session Driver: {{ config('session.driver') }}<br>
        App Env: {{ config('app.env') }}<br>
        App Key Set: {{ config('app.key') ? 'Oui' : 'Non' }}<br>
        Current Time: {{ now() }}<br>
        
        <div style="margin-top:10px;">
            <strong>Actions:</strong><br>
            <button onclick="createAdmin()" style="padding:5px 10px; font-size:10px; margin:2px;">Créer Admin</button>
            <button onclick="location.reload()" style="padding:5px 10px; font-size:10px; margin:2px;">Recharger</button>
        </div>
    </div>

<script>
function createAdmin() {
    fetch('/gestion-nm/create-admin', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({})
    })
    .then(response => response.json())
    .then(data => {
        alert('Résultat: ' + JSON.stringify(data, null, 2));
        if(data.success) {
            document.getElementById('email').value = data.admin_email;
            document.getElementById('password').value = data.admin_password;
        }
    })
    .catch(error => {
        alert('Erreur: ' + error);
    });
}
</script>
</div>
</body>
</html>