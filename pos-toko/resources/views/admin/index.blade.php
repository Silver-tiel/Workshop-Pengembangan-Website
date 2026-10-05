<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin – Acara 21 Middleware</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
            min-height: 100vh;
            color: #fff;
        }

        /* ── Navbar ── */
        nav {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255,255,255,0.1);
            padding: 1rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        nav .brand {
            font-size: 1.4rem;
            font-weight: 700;
            background: linear-gradient(90deg, #a78bfa, #60a5fa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: 0.5px;
        }
        nav .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        nav .badge-role {
            background: linear-gradient(135deg, #7c3aed, #4f46e5);
            padding: 4px 14px;
            border-radius: 999px;
            font-size: 0.78rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        nav .btn-logout {
            background: rgba(239,68,68,0.15);
            border: 1px solid rgba(239,68,68,0.4);
            color: #fca5a5;
            padding: 6px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.85rem;
            transition: all 0.2s;
        }
        nav .btn-logout:hover {
            background: rgba(239,68,68,0.3);
            border-color: rgba(239,68,68,0.7);
        }

        /* ── Main ── */
        .container {
            max-width: 1100px;
            margin: 3rem auto;
            padding: 0 1.5rem;
        }

        /* Hero card */
        .hero-card {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 20px;
            padding: 3rem;
            text-align: center;
            backdrop-filter: blur(16px);
            position: relative;
            overflow: hidden;
            margin-bottom: 2rem;
        }
        .hero-card::before {
            content: '';
            position: absolute;
            top: -60px; left: -60px;
            width: 220px; height: 220px;
            background: radial-gradient(circle, rgba(124,58,237,0.35), transparent 70%);
            pointer-events: none;
        }
        .hero-card::after {
            content: '';
            position: absolute;
            bottom: -60px; right: -60px;
            width: 220px; height: 220px;
            background: radial-gradient(circle, rgba(79,70,229,0.35), transparent 70%);
            pointer-events: none;
        }
        .hero-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            filter: drop-shadow(0 0 20px rgba(124,58,237,0.6));
        }
        .hero-card h1 {
            font-size: 2.2rem;
            font-weight: 800;
            background: linear-gradient(90deg, #a78bfa, #60a5fa, #34d399);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 0.5rem;
        }
        .hero-card p {
            color: rgba(255,255,255,0.6);
            font-size: 1rem;
            margin-bottom: 1.5rem;
        }
        .success-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(52,211,153,0.15);
            border: 1px solid rgba(52,211,153,0.4);
            color: #6ee7b7;
            padding: 8px 20px;
            border-radius: 999px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        /* Stats grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.2rem;
            margin-bottom: 2rem;
        }
        .stat-card {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 14px;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            transition: transform 0.2s, border-color 0.2s;
        }
        .stat-card:hover {
            transform: translateY(-3px);
            border-color: rgba(167,139,250,0.4);
        }
        .stat-icon {
            width: 48px; height: 48px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem;
            flex-shrink: 0;
        }
        .stat-icon.purple { background: rgba(124,58,237,0.2); }
        .stat-icon.blue   { background: rgba(59,130,246,0.2); }
        .stat-icon.green  { background: rgba(52,211,153,0.2); }
        .stat-icon.orange { background: rgba(249,115,22,0.2); }
        .stat-info .label { color: rgba(255,255,255,0.5); font-size: 0.8rem; margin-bottom: 4px; }
        .stat-info .value { font-size: 1.5rem; font-weight: 700; }

        /* Middleware info table */
        .info-section {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
        }
        .info-section h2 {
            font-size: 1.1rem;
            font-weight: 700;
            color: #a78bfa;
            margin-bottom: 1.2rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }
        th {
            background: rgba(124,58,237,0.2);
            color: #c4b5fd;
            padding: 10px 14px;
            text-align: left;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        th:first-child { border-radius: 8px 0 0 8px; }
        th:last-child  { border-radius: 0 8px 8px 0; }
        td {
            padding: 10px 14px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            color: rgba(255,255,255,0.8);
        }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: rgba(255,255,255,0.03); }
        .tag {
            background: rgba(124,58,237,0.2);
            color: #c4b5fd;
            padding: 3px 10px;
            border-radius: 6px;
            font-size: 0.78rem;
            font-family: monospace;
        }
        .tag.green { background: rgba(52,211,153,0.15); color: #6ee7b7; }
        .tag.blue  { background: rgba(59,130,246,0.15); color: #93c5fd; }

        /* Link cards */
        .links-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }
        .link-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 12px;
            padding: 1.2rem 1.5rem;
            text-decoration: none;
            color: #fff;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .link-card:hover {
            background: rgba(124,58,237,0.12);
            border-color: rgba(124,58,237,0.4);
            transform: translateY(-2px);
        }
        .link-card .lc-icon { font-size: 1.4rem; }
        .link-card .lc-label { font-size: 0.9rem; font-weight: 600; }
        .link-card .lc-desc  { font-size: 0.78rem; color: rgba(255,255,255,0.45); margin-top: 2px; }

        /* Log preview */
        .log-box {
            background: #0d1117;
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 12px;
            padding: 1.5rem;
            font-family: 'Consolas', 'Courier New', monospace;
            font-size: 0.8rem;
            color: #7ee787;
            line-height: 1.7;
            overflow-x: auto;
        }
        .log-box .log-info { color: #79c0ff; }
        .log-box .log-date { color: #d2a8ff; }
        .log-box .log-key  { color: #ffa657; }

        footer {
            text-align: center;
            padding: 2rem;
            color: rgba(255,255,255,0.3);
            font-size: 0.85rem;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav>
    <span class="brand">🛡️ POS Admin Panel</span>
    <div class="user-info">
        <span>{{ Auth::user()->name }}</span>
        <span class="badge-role">{{ Auth::user()->role }}</span>
        <form method="POST" action="{{ route('logout') }}" style="display:inline">
            @csrf
            <button type="submit" class="btn-logout">Logout</button>
        </form>
    </div>
</nav>

<div class="container">

    <!-- Hero -->
    <div class="hero-card">
        <div class="hero-icon">🔐</div>
        <h1>Selamat Datang, Admin!</h1>
        <p>Anda berhasil melewati middleware <code style="color:#a78bfa">Admin</code> dan <code style="color:#60a5fa">CekRole</code>.</p>
        <span class="success-badge">✅ Skenario 3: Login Admin – BERHASIL</span>
    </div>

    <!-- Stats -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon purple">👤</div>
            <div class="stat-info">
                <div class="label">USER LOGIN</div>
                <div class="value">{{ Auth::user()->email }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green">🏷️</div>
            <div class="stat-info">
                <div class="label">ROLE</div>
                <div class="value">{{ strtoupper(Auth::user()->role) }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon blue">⚡</div>
            <div class="stat-info">
                <div class="label">STATUS</div>
                <div class="value">{{ strtoupper(Auth::user()->status ?? 'active') }}</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon orange">🕐</div>
            <div class="stat-info">
                <div class="label">WAKTU LOGIN</div>
                <div class="value" style="font-size:1rem">{{ now()->format('H:i:s') }}</div>
            </div>
        </div>
    </div>

    <!-- Middleware Info Table -->
    <div class="info-section">
        <h2>📋 Daftar Middleware Acara 21</h2>
        <table>
            <thead>
                <tr>
                    <th>Alias</th>
                    <th>Class</th>
                    <th>Fungsi</th>
                    <th>Metode</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><span class="tag">admin</span></td>
                    <td><code>App\Http\Middleware\Admin</code></td>
                    <td>Cek login + role admin</td>
                    <td><span class="tag blue">handle()</span> + <span class="tag green">terminate()</span></td>
                    <td>✅ Aktif</td>
                </tr>
                <tr>
                    <td><span class="tag">petugas</span></td>
                    <td><code>App\Http\Middleware\Petugas</code></td>
                    <td>Cek login + role petugas</td>
                    <td><span class="tag blue">handle()</span> + <span class="tag green">terminate()</span></td>
                    <td>✅ Aktif</td>
                </tr>
                <tr>
                    <td><span class="tag">siswa</span></td>
                    <td><code>App\Http\Middleware\Siswa</code></td>
                    <td>Cek login + role siswa</td>
                    <td><span class="tag blue">handle()</span> + <span class="tag green">terminate()</span></td>
                    <td>✅ Aktif</td>
                </tr>
                <tr>
                    <td><span class="tag">cek.role</span></td>
                    <td><code>App\Http\Middleware\CekRole</code></td>
                    <td>Cek login + role dinamis via parameter</td>
                    <td><span class="tag blue">handle($role)</span> + <span class="tag green">terminate()</span></td>
                    <td>✅ Aktif</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Test Routes -->
    <div class="info-section">
        <h2>🧪 Uji Tiga Skenario Middleware</h2>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Skenario</th>
                    <th>Route</th>
                    <th>Hasil yang Diharapkan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Belum Login</td>
                    <td><a href="/admin" style="color:#93c5fd">/admin</a></td>
                    <td>🔀 Redirect ke <code>/login</code></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Login sebagai Siswa/Petugas</td>
                    <td><a href="/admin" style="color:#93c5fd">/admin</a></td>
                    <td>🚫 HTTP 403 Forbidden</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Login sebagai Admin</td>
                    <td><a href="/admin" style="color:#93c5fd">/admin</a></td>
                    <td>✅ Halaman ini tampil</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Quick Links -->
    <div class="links-grid">
        <a href="/admin" class="link-card">
            <span class="lc-icon">🔐</span>
            <div>
                <div class="lc-label">/admin</div>
                <div class="lc-desc">Middleware alias: admin</div>
            </div>
        </a>
        <a href="/admin-role" class="link-card">
            <span class="lc-icon">🎯</span>
            <div>
                <div class="lc-label">/admin-role</div>
                <div class="lc-desc">Middleware: cek.role:admin</div>
            </div>
        </a>
        <a href="/petugas" class="link-card">
            <span class="lc-icon">👷</span>
            <div>
                <div class="lc-label">/petugas</div>
                <div class="lc-desc">Middleware alias: petugas</div>
            </div>
        </a>
        <a href="/siswa" class="link-card">
            <span class="lc-icon">🎓</span>
            <div>
                <div class="lc-label">/siswa</div>
                <div class="lc-desc">Middleware alias: siswa</div>
            </div>
        </a>
        <a href="/dashboard" class="link-card">
            <span class="lc-icon">🏠</span>
            <div>
                <div class="lc-label">/dashboard</div>
                <div class="lc-desc">Dashboard utama</div>
            </div>
        </a>
    </div>

    <!-- Log Preview -->
    <div class="info-section">
        <h2>📝 Contoh Output terminate() di Laravel Log</h2>
        <div class="log-box">
<span class="log-date">[{{ now()->format('Y-m-d H:i:s') }}]</span> <span class="log-info">local.INFO:</span> Middleware Admin executed {<span class="log-key">"user"</span>:"{{ Auth::user()->email }}",<span class="log-key">"path"</span>:"admin",<span class="log-key">"status"</span>:200}
<span class="log-date">[{{ now()->format('Y-m-d H:i:s') }}]</span> <span class="log-info">local.INFO:</span> Middleware CekRole executed {<span class="log-key">"user"</span>:"{{ Auth::user()->email }}",<span class="log-key">"path"</span>:"admin-role",<span class="log-key">"status"</span>:200}
        </div>
        <p style="color:rgba(255,255,255,0.4);font-size:0.8rem;margin-top:0.8rem;">
            📂 Cek log nyata: <code>storage/logs/laravel.log</code>
        </p>
    </div>

</div>

<footer>
    Acara 21 – Middleware Laravel | POS Toko &copy; {{ date('Y') }}
</footer>

</body>
</html>
