<?php
session_start();
if(isset($_SESSION['user'])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/admin.css">
    <title>Admin</title>
</head>
<body>
    <?php
    # Check if the intro text textarea has been submitted
    require "openDB.php";
    if(isset($_POST['submit'])){
        try {
            # get text and update the database to the new text
            $newtext = $_POST['intro'];
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE introtext SET TextBlock1 = \"$newtext\"";
            $conn->exec($sql);
            echo "<script>alert('Succesfully updated the intro text.')</script>";
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }
    ?>
    <header>
        <a href="#Section1"><img class="logo" src="./images/Logo v2.svg" alt="logo"></a>
        <nav>
            <ul class="nav__links">
                <li><a href="index.php#mySkills">Skills</a></li>
                <li><a href="index.php#myWork">Work</a></li>
                <li><a href="index.php#aboutMe">About</a></li>
            </ul>
        </nav>
        <a class="cta" href="contact.php"><button>Contact</button></a>
    </header>
    <div id="introChange">
        <h1 id="Change">Change intro text</h1>
        <form method="POST">
            <?php
            # display current Intro text as a placeholder
            require 'openDB.php';
            require 'display.php';
            $currentText = getIntroText();
            echo "<textarea id='intro' name='intro' cols='30' rows'10' placeholder='Enter new intro text...'>";
            echo $currentText;
            echo "</textarea><br>"
            ?>
            <input type="submit" name="submit">
        </form>
    </div>
    <div>
        <h1 id="contact">Contact me messages</h1>
        <div class="wrapper">
            <div class="cards_wrap">
            <?php
            try {
                # display all current contact messages.
                require 'openDB.php';
                $stmt = $conn->prepare("SELECT * FROM contact ORDER BY id DESC");
                $stmt->execute();
                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                foreach ($stmt->fetchAll() as $k => $v) {
                    $id = $v['id'];
                    $name = $v['name'];
                    $email = $v['email'];
                    $message = $v['message'];
                    echo "<div class='card_item'>
                    <div class='card_inner'>
                        <div class='name'>ID: $id | $name</div>
                        <div class='email'>$email</div>
                        <div class='comment'>$message</div>
                    </div>
                    </div>";
                }
                // Back to home buttton
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            ?>
            </div>
        </div>
    </div>
    <h1 id="comments">Comments</h1>
    <div class="wrapper">
      <div class="cards_wrap">
      <?php
      try {
          #display all comments
          require 'openDB.php';
          $stmt = $conn->prepare("SELECT * FROM comments ORDER BY Date DESC");
          $stmt->execute();
          $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
          foreach ($stmt->fetchAll() as $k => $v) {
              $id = $v['Id'];
              $commentname = $v['Name'];
              $comment = $v['Comment'];
              $commentdate = $v['Date'];
              echo "<div class='card_item'>
              <div class='card_inner'>
                <div class='name'>$commentname</div>
                <div class='date'>$commentdate</div>
                <div class='comment'>$comment</div>
                <br>
                <div class='delete'><a href='delete.php?id=$id'>Delete</a></div>
              </div>
            </div>";
          }
          // Back to home buttton
      } catch (PDOException $e) {
          echo "Error: " . $e->getMessage();
      }
      ?>
      </div>
    </div>
</body>
</html>
<?php
} else {
    header('Location: ' . 'login.php');
}
?>