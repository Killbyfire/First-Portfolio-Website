<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css/login.css" rel="stylesheet">
    <title>Login</title>
</head>
<body>
    <div id="loginScreen">
        <form method="POST">
            <label class="label" id="userLabel">Username: </label><br>
            <label id="requiredUser" style="color: red; font-size: 24px;"></label><br>
            <input type="text" name="username"><br>
            <label class="label">Password: </label><br>
            <label id="requiredPass" style="color: red; font-size: 24px;"></label><br>
            <input type="password" name="password"><br>
            <input type="submit" name="submit">
        </form>
    </div>
    <?php
    if(isset($_POST['username'])) {
        if(empty(htmlspecialchars($_POST['username']))) {
            echo "<script>document.getElementById('requiredUser').innerText = '*Username is required'</script>";
        } else {
            if(empty(htmlspecialchars($_POST['password']))) {
                echo "<script>document.getElementById('requiredPass').innerText = '*Password is required'</script>";
            } else {
                if (htmlspecialchars($_POST['username']) == "admin") {
                    if (htmlspecialchars($_POST['password']) == "verysecurelol12") {
                        session_start();
                        if(!isset($_SESSION['user'])) {
                            $_SESSION['user'] = "1";
                        }
                        header('Location: admin.php');
                    }
                }   
            }
        }
    }
    ?>
</body>
</html>