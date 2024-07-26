<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="{{ route('login.submit') }}" method="POST">
        @csrf
        <div>
            <label for="email" class="form-label">Email</label>
            <input type="text" placeholder="Email" id="email" class="form-control" name="email" required autofocus>
            @if ($errors->has('email'))
                <span class="text-danger">{{ $errors->first('email') }}</span>
            @endif
        </div>
        <div>
            <label for="password" class="form-label">Password</label>
            <input type="password" placeholder="Password" id="password" class="form-control" name="password" required>
            
            @if ($errors->has('password'))
                <span class="text-danger">{{ $errors->first('password') }}</span>
            @endif
        </div>
        <button id="loginBtn" type="submit">Login</button>
    </form>
</body>
</html>