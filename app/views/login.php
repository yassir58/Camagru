<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>Sign in</h1>
<form method='post'  action="/login">
<label for="email">Email</label>
<input name='email' type="text" id='email'>
<label for="password">Password</label>
<input name='password' type="text" id='password'>
<button type='submit'>
    login
</button>
</form>
<p>If you don't have an account <a href="/signup">Sign up</a></p>
</body>
</html>