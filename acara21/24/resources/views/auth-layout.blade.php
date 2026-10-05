<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Autentikasi') | {{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { color-scheme: light; font-family: 'DM Sans', sans-serif; color: #192a35; background: #edf3f2; }
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; display: grid; place-items: center; padding: 28px 16px; background: radial-gradient(circle at 12% 14%, #d4e8df 0, transparent 30%), linear-gradient(135deg, #f6f5ed, #e9f1f0); }
        main { width: min(100%, 440px); padding: 38px; border: 1px solid #d5dfdb; border-radius: 8px; background: #fff; box-shadow: 0 18px 50px #243f3914; }
        .eyebrow { margin: 0 0 9px; color: #347b69; font-size: 12px; font-weight: 700; text-transform: uppercase; }
        h1 { margin: 0 0 8px; font: 800 28px/1.2 'Manrope', sans-serif; }
        .intro { margin: 0 0 26px; color: #64757a; line-height: 1.55; }
        label { display: block; margin: 16px 0 7px; font-size: 14px; font-weight: 600; }
        input { width: 100%; min-height: 44px; padding: 10px 12px; border: 1px solid #bdcbc8; border-radius: 5px; color: inherit; font: inherit; }
        input:focus { outline: 3px solid #83bca744; border-color: #347b69; }
        button { min-height: 44px; border: 0; border-radius: 5px; padding: 0 16px; background: #176a57; color: white; font: 700 14px 'DM Sans', sans-serif; cursor: pointer; }
        button:hover { background: #115342; }
        .submit { width: 100%; margin-top: 22px; }
        .links { display: flex; flex-wrap: wrap; justify-content: space-between; gap: 12px; margin-top: 20px; font-size: 14px; }
        a { color: #176a57; font-weight: 600; }
        .notice, .error { margin: 0 0 16px; padding: 11px 12px; border-radius: 5px; font-size: 14px; }
        .notice { background: #e6f4eb; color: #215a3d; }
        .error { background: #fff0ec; color: #923a2c; }
        .error ul { margin: 0; padding-left: 18px; }
        .inline-form { display: inline; }
        @media (max-width: 480px) { main { padding: 28px 22px; } }
    </style>
</head>
<body>
<main>
    @yield('content')
</main>
</body>
</html>