<?php
    session_start();
    session_destroy();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="index.css">
    <script src="../../Php1/link/jquery.min.js"></script>
</head>

<body>
    <div class="wrappage-login">
        <form class="login">
            <label for="">
                <span>Email</span>
                <input type="email" name="email" id="email">
            </label>
            <br>
            <label for="">
                <span>Password</span>
                <input type="password" name="password" id="password">
            </label>
            <br>
            <div class="option-login">
                <div class="resetpassword">
                    <span>Don't have password</span>
                </div>
                <div class="btn-login">
                    <span>LOGIN</span>
                </div>
            </div>
        </form>
    </div>
</body>

</html>

<script src="../Admin/js/index.js"></script>