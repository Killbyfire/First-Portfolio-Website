<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css/contact.css" rel="stylesheet">
    <title>Contact me</title>
</head>
<body>
    <div class="Container">
        <div class="ContactContainer">
            <h1>Contact me</h1>
            <form method="post">
                <label>Name: </label><br>
                <label id="requiredName" class="required" style="color: red; font-size: 24px;"></label><br>
                <input type="text" name="name" placeholder="Enter your name"><br>
                <label>Email: </label><br>
                <label id="requiredEmail" class="required" style="color: red; font-size: 24px;"></label><br>
                <input type="email" name="email" placeholder="Enter your email"><br>
                <label>Message: </label><br>
                <label id="requiredMessage" class="required" style="color: red; font-size: 24px;"></label><br>
                <textarea name="message" cols="30" rows="10" placeholder="Type your message..." id="message"></textarea><br>
                <input type="submit" name="submit">
            </form>
        </div>
        <div class="CVContainer">
            <img src="./images/CV.png" alt="Filler Image" id="CVPng">
            <a download href="./images/CV.pdf" class="download-btn">Download CV</a>
        </div>
    </div>
    <?php
    if(isset($_POST['submit'])){
        if(empty(htmlspecialchars($_POST['name']))){
            echo "<script>document.getElementById('requiredName').innerText = '*Name is required'</script>";
        } else {
            if(empty(htmlspecialchars($_POST['email']))){
                echo "<script>document.getElementById('requiredEmail').innerText = '*Email is required'</script>";
            } else {
                if(empty(htmlspecialchars($_POST['message']))){
                    echo "<script>document.getElementById('requiredMessage').innerText = '*Message is required'</script>";
                } else {
                    // $receiver = "";
                    // $subject = "Contact Information";
                    // $message = htmlspecialchars($_POST['message']);
                    // $email = htmlspecialchars($_POST['email']);
                    // $headers = "From: $email" . "\r\n";
                    // mail($receiver, $subject, $message, $headers);
                    // echo "<script>alert('Thanks for leaving a message! I will try to get back to you as soon as I can.')</script>";
                    require 'openDB.php';
                    $name = htmlspecialchars($_POST['name']);
                    $email = htmlspecialchars($_POST['email']);
                    $msg = htmlspecialchars($_POST['message']);
                    try {
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $sql = "INSERT INTO contact (name,email,message) VALUES ('$name','$email', '$msg')";
                        $conn->exec($sql);
                        echo "<script>alert('Thanks for leaving a message! I will try to get back to you as soon as I can.')</script>";
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                }
            }
        }
    }
    ?>
</body>
</html>