<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Petugas – Acara 21 Middleware</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background: linear-gradient(135deg, #064e3b, #065f46, #047857);
            min-height: 100vh;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            background: rgba(255,255,255,0.07);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 20px;
            padding: 3rem;
            text-align: center;
            backdrop-filter: blur(16px);
            max-width: 500px;
            width: 90%;
        }
        .icon { font-size: 4rem; margin-bottom: 1rem; }
        h1 {
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(90deg, #6ee7b7, #34d399);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
        }
        p { color: rgba(255,255,255,0.6); margin-bottom: 1.5rem; }
        .badge {
            display: inline-block;
            background: rgba(52,211,153,0.2);
            border: 1px solid rgba(52,211,153,0.4);
            color: #6ee7b7;
            padding: 6px 18px;
            border-radius: 999px;
            font-weight: 600;
            font-size: 0.85rem;
            margin-bottom: 1.5rem;
        }
        a {
            display: inline-block;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            color: #fff;
            padding: 8px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.85rem;
            transition: all 0.2s;
        }
        a:hover { background: rgba(255,255,255,0.2); }
        .info { margin-top: 1.5rem; font-size: 0.8rem; color: rgba(255,255,255,0.4); }
    </style>
</head>
<body>
<div class="card">
    <div class="icon">👷</div>
    <h1>Halaman Petugas</h1>
    <p>Anda berhasil masuk sebagai <strong>{{ Auth::user()->name }}</strong>.</p>
    <div class="badge">Role: {{ strtoupper(Auth::user()->role) }}</div>
    <br>
    <a href="/dashboard">← Kembali ke Dashboard</a>
    <div class="info">Middleware: <code>petugas</code> (Acara 21)</div>
</div>
</body>
</html>
