<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    @include('layout.flashMessages')
    
    <form action="{{ route('login.auth') }}" method="POST" class="form-design">
        @csrf
        <h2>Account Login</h2>
        <div class="mb-3"> 
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
            <x-error name='email' />
        </div>
        
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
            <x-error name='password' />
        </div>

        <input type="submit" value="Log In" name="login" class="btn btn-primary" style="width: 100%">
    </form>
</body>
</html>