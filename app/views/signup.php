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
    <h1>Sign up</h1>
    <form action="/signup" method="post">
    <input placeholder='Your Username' required name='username' type="text" id='username'>
    <input placeholder='Your Email' required name='email' type="email" id='email'>
    <input placeholder='Your Password' required name='password' type="password" id='password'>
    <button type="submit">
        Sign up
    </button>
    </form>
<p>If you already have an account <a href="/login">Login</a></p>
    </div>

</body>
</html>