<?php
    // Start the session
    session_start();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>FloorIsLava</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Custom styles for this template -->
    <link href="css/index.css" rel="stylesheet">
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Unica+One" rel="stylesheet">
</head>

<body class="text-center">

<div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
    <main role="main" class="inner cover mt-auto">
        <section class="cover-message">
            <h1 class="cover-heading"><span class="text-danger">Floor</span> is <span class="text-warning">Lava</span>
            </h1>
        </section>
        <section class="cover-message highscore-message">
            <pre><code class="highscore-heading text-success lead">High Score:</code></pre>

            <!--  Print the highest score stored -->
            <?php
                $userInfo = getUserInfo();
                printHighestScore($userInfo);
                
                function getUserInfo()
                {
                    $filename          = 'db/scores.txt';
                    $fHandle           = fopen($filename, 'r'); // attempt to open the file
                    $highestScoreFound = false;
                    $userInfo          = null;
                    
                    // successfully opened file
                    if ($fHandle)
                    {
                        // loop through file until end
                        while (!feof($fHandle) && !$highestScoreFound)
                        {
                            $buffer = fgets($fHandle); // get the next line
                            
                            // contains an entry
                            if ($buffer)
                            {
                                $userInfo          = explode(",", $buffer); // split string on ','
                                $highestScoreFound = true;
                            }
                        }
                        fclose($fHandle); // close the file
                    }
                    return $userInfo;
                }
                
                function printHighestScore($userInfo)
                {
                    // a score has been successfully retrieved
                    if ($userInfo)
                    {
                        $userName  = $userInfo[0]; // username
                        $userScore = $userInfo[1]; // score
                        
                        echo "<code class='lead highscore-description'><kbd class='text-warning'>$userName</kbd>
                                <span class='text-white'>$userScore seconds</span></code>";
                        $_SESSION['highscoreUsername'] = $userName;
                        $_SESSION['highscore']         = $userScore;
                    }
                    
                    // no score retrieved
                    else
                    {
                        echo "<kbd class='lead description text-white highscore-description'>None</kbd>";
                    }
                }
            
            ?>
        </section>
        <!-- send username input to gamescreen page -->
        <form class="form-signin" action="html/gamescreen.php" method="post">
            <label for="username" class="sr-only">username</label>
            <input type="text" name="username" class="form-control" placeholder="username" required autofocus>
            <button class="btn btn-lg btn-danger btn-block" type="submit">Play</button>
        </form>
    </main>

    <footer class="mastfoot mt-auto">
        <div class="inner">
            <p>&copy; CST Web and Mobile 2018</p>
        </div>
    </footer>
</div>

<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>
</html>