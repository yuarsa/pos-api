<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome Bro!</title>
</head>
<body>
    <p>Hi, <strong><?php echo $company->comp_name;?></strong> Welcome to Korina. Thank you for sign-up with us..</p>
    <p>Please active your account by click below:</p>
    <p>http://api.pos.test/auth/activate/<?php echo $user->activation_token;?></p>
</body>
</html>
