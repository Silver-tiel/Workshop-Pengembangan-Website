<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Siswa – Acara 21 Middleware</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background: linear-gradient(135deg, #1e3a5f, #1e40af, #1d4ed8);
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
            background: linear-gradient(90deg, #93c5fd, #60a5fa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
        }
        p { color: rgba(255,255,255,0.6); margin-bottom: 1.5rem; }
        .badge {
            display: inline-block;
            background: rgba(96,165,250,0.2);
            border: 1px solid rgba(96,165,250,0.4);
            color: #93c5fd;
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
    <div class="icon">🎓</div>
    <h1>Halaman Siswa</h1>
    <p>Anda berhasil masuk sebagai <strong>{{ Auth::user()->name }}</strong>.</p>
    <div class="badge">Role: {{ strtoupper(Auth::user()->role) }}</div>
    <br>
    <a href="/dashboard">← Kembali ke Dashboard</a>
    <div class="info">Middleware: <code>siswa</code> (Acara 21)</div>
</div>
</body>
</html>
