<?php

# Get the current intro text in database
function getIntroText() {
    try {
        require 'openDB.php';
        $stmt = $conn->prepare("SELECT * FROM introtext");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach ($stmt->fetchAll() as $k => $v) {
            $text = $v['TextBlock1'];
            return $text;
        }
        // Back to home buttton
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

# Get latest 4 comments and return them
function displayComments() {
    try {
        require 'openDB.php';
        $stmt = $conn->prepare("SELECT * FROM comments ORDER BY Date DESC LIMIT 4");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach ($stmt->fetchAll() as $k => $v) {
            $id = $v['Id'];
            $commentname = $v['Name'];
            $comment = $v['Comment'];
            $commentdate = $v['Date'];
            echo "<div class='card_item js-scroll'>
            <div class='card_inner'>
            <div class='name'>$commentname</div>
            <div class='date'>$commentdate</div>
            <div class='comment'>$comment</div>
            </div>
        </div>";
        }
        // Back to home buttton
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

# Display all projects for the projects.php page
function displayAllProjects($category) {
    try {
        require 'openDB.php';
        # Change to DESC if you want latest.
        $stmt = $conn->prepare("SELECT * FROM projects WHERE category = '$category'ORDER BY id ASC");
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            foreach ($stmt->fetchAll() as $k => $v) {
                $id = $v['id'];
                $title = $v['title'];
                $desc = $v['description'];
                $picture = $v['picture'];
                echo "<div class='card_work_item'>
                <div class='card_work_inner'>
                <div class='name'>$title</div>
                <div class='image'><img width='512px' height='256px' src='./projects/$picture'></div>
                <div class='comment'>$desc</div><br>
                </div>
                </div>";
            }
        } else {
            echo "<h1 id='noProjects'>It seems a bit empty here...<br>Come back later!</h1>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>