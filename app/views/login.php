<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  type="text/css" href="/css/styles.css">
    <title>Document</title>
</head>
<body>

<div class="authContainer">
<h1>Sign in</h1>
<form method='post'  action="/login">
<input placeholder='Your Email' required name='email' type="email" id='email'>
<input placeholder='Your password' name='password' type="password" required id='password'>
<button type='submit'>
    login
</button>
</form>
<p>If you don't have an account <a href="/signup">Sign up</a></p>
</div>
</body>
</html>