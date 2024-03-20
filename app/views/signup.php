<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <h1>Sign up</h1>
    <form action="/signup" method="post">
    <label for="email">Username</label>
    <input name='username' type="text" id='username'>
    <label for="email">Email</label>
    <input name='email' type="text" id='email'>
    <label for="password">Password</label>
    <input name='password' type="text" id='password'>
    <button type="submit">
        Sign up
    </button>
    </form>
<p>If you already have an account <a href="/login">Login</a></p>

</body>
</html>