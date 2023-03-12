<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css/style.css" rel="stylesheet">
    <title>All projects</title>
</head>
<body>
    <div class="backToHome">
        <a href="index.php">
            <button id="backButton">Back to home</button>
        </a>
    </div>

    <div class="work_wrapper">
        <div class="cards_work_wrap">
            <?php
                if($_GET['category']){
                    require 'display.php';
                    displayAllProjects($_GET['category']);
                }
            ?>
        </div>
    <div>
    <!-- add a back to home button? -->
</body>
</html>