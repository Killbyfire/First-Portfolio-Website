<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css/style.css" rel="stylesheet">
    <title>Melvin - Portfolio</title>
    <link rel="icon" type="image/x-icon" href="./images/favicon.ico">
</head>
<body>
    <?php
    require 'openDB.php';
    require 'display.php';
    ?>
    <header>
        <a href="#QuickIntroduction"><img class="logo" src="./images/Logo v2.svg" alt="logo"></a>
        <nav>
            <ul class="nav__links">
                <li><a href="#aboutMe">About</a></li>
                <li><a href="#mySkills">Skills</a></li>
                <li><a href="#myWork">Work</a></li>
            </ul>
        </nav>
        <a class="cta" href="contact.php"><button>Contact</button></a>
    </header>
    <div id="mainContent">
        <div id="Introduction">
            <p id="QuickIntroduction"></p>
            <img id="waving" src="./images/waving-hand.svg" alt="wave">
            <h1 id="MainLine">Hey i'm Melvin!</h1>
            <br>
            <br>
            <?php
            # Get the current intro Text out of the database and display it.
            $introText = getIntroText();
            echo "<p id='IntroLine'>$introText</p>";
            ?>
            <div id="cta">
                <a href="#myWork"><button id="workButton">My work</button></a>
                <a href="#mySkills"><button id="skillsButton">Skills</button></a>
            </div>
            <iframe id="spline" src='https://my.spline.design/codesymbol2-24227dd809fe9ecf6cf3fe05aab1b3c4/' frameborder='0'></iframe>
        </div>
    </div>
    <div id="SecondaryContent">
      <div id="AboutContainer">
        <p id="aboutMe"></p>
        <h2 id="aboutLine">About me</h2>
        <p id="aboutParagraph">Nice to meet you! My name is Melvin, I'm a software developer who has a passion for coding. I want to become a full stack developer/software engineer at a large company. You can see my skills under the tab "Skills", I want to learn more skills in the future.</p>
      </div>
      <div id="SkillsContainer">
        <p id="mySkills"></p>
        <h2 id="skills">Skills</h2>
        <ul id="allSkills">
            <li class="skill">Python</li>
            <li class="skill">Javascript</li>
            <li class="skill">Php</li>
            <li class="skill">Html</li>
            <li class="skill">Css</li>
            <li class="skill">Sql</li>
        </ul>
      </div>
    </div>
    <div id="TertiaryContent">
        <p id="myWork"></p>
        <h2 id="workTitle">Website Projects</h2>
        <div class="work_wrapper">
            <div class="cards_work_wrap">
              <div class='card_work_item js-scroll'>
                  <div class='card_work_inner'>
                    <div class='name'><img class="smallImage" src="./images/Dev.png">Ala projects</div>
                    <div class='comment'>All projects about ALA in school.</div>
                    <div class='cta'><a href="projects.php?category=ala"><button>View all</button></a></div>
                  </div>
              </div>
              <div class='card_work_item js-scroll'>
                  <div class='card_work_inner'>
                    <div class='name'><img class="smallImage" src="./images/Design.png">Graphic Design</div>
                    <div class='comment'>All projects which include some sort of graphic design.</div>
                    <div class='cta'><a href="projects.php?category=design"><button>View all</button></a></div>
                  </div>
              </div>
              <div class='card_work_item js-scroll'>
                  <div class='card_work_inner'>
                    <div class='name'><img class="smallImage" src="./images/Hobby.png">Other projects</div>
                    <div class='comment'>Projects just for fun or as an hobby :)</div>
                    <div class='cta'><a href="projects.php?category=hobby"><button>View all</button></a></div>
                  </div>
              </div>
            </div>
        </div>
    </div>
    <div id="commentContent">
        <div class="comment-box">
            <h2 id="commentText">Leave a comment!</h2>
            <form method="POST">
                <label id="requiredName"></label><br>
                <input type="text" placeholder="Name" name="name" id="nameInput"><br>
                <label id="requiredComment"></label><br>
                <textarea name="comment" cols="30" rows="10" placeholder="Type your comment..." id="comment"></textarea><br>
                <input type="submit" name="submit">
            </form>
        </div>
        <?php
        # check if the user submitted a comment.
        if(isset($_POST['submit'])){
          # check if its empty
            if(empty(htmlspecialchars($_POST['name']))){
                echo "<script>document.getElementById('requiredName').innerText = '*Name is required'</script>";
            } else {
              # check if comment is empty
                if(empty(htmlspecialchars($_POST['comment']))){
                    echo "<script>document.getElementById('requiredComment').innerText = '*Comment is required'</script>";
                } else {
                  # insert it into the database.
                    require 'openDB.php';
                    $name = htmlspecialchars($_POST['name']);
                    $comment = htmlspecialchars($_POST['comment']);
                    try {
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $sql = "INSERT INTO comments (Name,Comment) VALUES ('$name','$comment')";
                        $conn->exec($sql);
                        echo "<script>alert('Thanks for leaving a comment!')</script>";
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                }
            }
        }
        ?>
        <h2 id="latestComments">Latest comments</h2>
        <div class="wrapper">
            <div class="cards_wrap">
                <?php
                # display the top 4 recent comments to the user.
                displayComments();
                ?>
            </div>
        </div>
    </div>
<footer>
  <div class="footer-container">
    <div class="footer-section-wrapper">
      <div class="footer-section">
        <h2 class="footer-category">Links</h2>
        <nav class="footer-list">
          <li>
            <a href="contact.php" class="footer-link">Contact</a>
          </li>
          <li>
            <a href="projects.php?category=ala" class="footer-link">Ala projects</a>
          </li>
          <li>
            <a href="projects.php?category=design" class="footer-link">Design projects</a>
          </li>
          <li>
            <a href="projects.php?category=hobby" class="footer-link">Hobby projects</a>
          </li>
          <li>
            <a href="login.php" class="footer-link">Login</a>
          </li>
          <!-- <li>
            <a href="#" href="#" class="footer-link">Third Link</a>
          </li>
          <li>
            <a href="#" class="footer-link">Fourth Link</a>
          </li> -->
        </nav>
      </div>
      <div class="footer-section">
        <h2 class="footer-category">Sections</h2>
        <nav class="footer-list">
          <li>
            <a href="#QuickIntroduction" class="footer-link">Introduction</a>
          </li>
          <li>
            <a href="#aboutMe" class="footer-link">About</a>
          </li>
          <li>
            <a href="#mySkills"class="footer-link">Skills</a>
          </li>
          <li>
            <a href="#myWork" class="footer-link">Work</a>
          </li>
        </nav>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="footer-bottom-container">
      <p class="footer-copyright">© 2022 Melvin Kreft</p>
      <div class="footer-social">
        <a href="#" class="footer-social-icon">
          <svg fill="currentColor" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <title>Twitter</title>
            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
          </svg>
        </a>
        <a href="https://www.linkedin.com/in/melvin-kreft-2a95aa256/" class="footer-social-icon">
          <svg fill="currentColor" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <title>LinkedIn</title>
            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
          </svg>
        </a>
      </div>
    </div>
  </div>
</footer>
<script src="script.js"></script>
</body>
</html>