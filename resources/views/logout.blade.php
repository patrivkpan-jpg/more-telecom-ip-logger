<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
</head>
<body>
    <form action="{{ route('logout.submit') }}" method="POST">
        @csrf
        <button id="logoutBtn" type="submit">Logout</button>
    </form>
</body>
</html>