<!DOCTYPE html>
<html>
<head>
    <title>Daftar User</title>
</head>
<body>
    <h2>Daftar User</h2>

    @foreach ($users as $user)
        <p>{{ strtoupper($user->name) }}</p>
    @endforeach
</body>
</html>