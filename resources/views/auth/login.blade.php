<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login – Pixel Smashers</title>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Rajdhani:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        :root {
            --bg:#0a0a0f; --card:#12121a; --border:#2a2a3a;
            --purple:#7c3aed; --purple-light:#a78bfa;
            --gold:#f59e0b; --text:#e2e8f0; --muted:#64748b;
            --error:#f87171;
        }
        body {
            background:var(--bg); color:var(--text);
            font-family:'Rajdhani',sans-serif;
            min-height:100vh; display:flex; flex-direction:column;
        }
        /* NAVBAR */
        nav {
            display:flex; align-items:center; justify-content:space-between;
            padding:0 40px; height:64px;
            background:rgba(10,10,15,0.95);
            border-bottom:1px solid var(--border);
        }
        .logo { font-family:'Press Start 2P',monospace; font-size:12px; color:var(--purple-light); text-decoration:none; }
        .logo span { color:var(--gold); }

        /* MAIN */
        main {
            flex:1; display:flex; align-items:center; justify-content:center;
            padding:40px 20px;
            background:radial-gradient(ellipse at center, rgba(124,58,237,0.1) 0%, transparent 70%);
        }
        .auth-box {
            background:var(--card); border:1px solid var(--border);
            border-radius:12px; padding:40px; width:100%; max-width:420px;
        }
        .auth-title {
            font-family:'Press Start 2P',monospace; font-size:14px;
            color:white; margin-bottom:6px; text-align:center;
        }
        .auth-sub {
            font-size:14px; color:var(--muted);
            text-align:center; margin-bottom:32px;
        }
        /* ERRORS */
        .error-box {
            background:rgba(248,113,113,0.1); border:1px solid rgba(248,113,113,0.3);
            border-radius:6px; padding:12px 16px; margin-bottom:20px;
            font-size:13px; color:var(--error);
        }
        /* SUCCESS */
        .success-box {
            background:rgba(16,185,129,0.1); border:1px solid rgba(16,185,129,0.3);
            border-radius:6px; padding:12px 16px; margin-bottom:20px;
            font-size:13px; color:#10b981;
        }
        /* FORM */
        .form-group { margin-bottom:20px; }
        label {
            display:block; font-size:13px; font-weight:600;
            color:var(--muted); letter-spacing:1px;
            text-transform:uppercase; margin-bottom:8px;
        }
        input {
            width:100%; padding:12px 16px;
            background:#0d0d14; border:1px solid var(--border);
            border-radius:6px; color:var(--text);
            font-family:'Rajdhani',sans-serif; font-size:15px;
            transition:border-color 0.2s;
            outline:none;
        }
        input:focus { border-color:var(--purple); }
        input::placeholder { color:var(--muted); }

        .btn-submit {
            width:100%; padding:14px;
            background:var(--purple); color:white; border:none;
            border-radius:6px; font-family:'Rajdhani',sans-serif;
            font-weight:700; font-size:15px; letter-spacing:2px;
            cursor:pointer; text-transform:uppercase;
            transition:background 0.2s;
        }
        .btn-submit:hover { background:#6d28d9; }

        .auth-link {
            text-align:center; margin-top:24px;
            font-size:14px; color:var(--muted);
        }
        .auth-link a { color:var(--purple-light); text-decoration:none; font-weight:600; }
        .auth-link a:hover { text-decoration:underline; }

        /* FOOTER */
        footer {
            border-top:1px solid var(--border); padding:20px 40px;
            display:flex; align-items:center; justify-content:space-between;
        }
        .footer-logo { font-family:'Press Start 2P',monospace; font-size:10px; color:var(--purple-light); }
        .footer-logo span { color:var(--gold); }
        .footer-copy { font-size:12px; color:var(--muted); }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav>
    <a href="/" class="logo">PIXEL<span>SMASHERS</span></a>
</nav>

<!-- MAIN -->
<main>
    <div class="auth-box">
        <div class="auth-title">WELCOME BACK</div>
        <div class="auth-sub">Login to your account</div>

        {{-- Success Message --}}
        @if(session('success'))
            <div class="success-box">{{ session('success') }}</div>
        @endif

        {{-- Errors --}}
        @if($errors->any())
            <div class="error-box">
                @foreach($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="/login">
            @csrf
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" placeholder="you@example.com" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn-submit">LOGIN</button>
        </form>

        <div class="auth-link">
            Don't have an account? <a href="/register">Sign Up</a>
        </div>
    </div>
</main>

<!-- FOOTER -->
<footer>
    <div class="footer-logo">PIXEL<span>SMASHERS</span></div>
    <div class="footer-copy">© 2026 Pixel Smashers</div>
</footer>

</body>
</html>