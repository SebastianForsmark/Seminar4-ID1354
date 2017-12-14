<?php
session_start();
include("simplexml.php");
$_SESSION['currentRecipe'] = "recipeMeatballs";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Tasty Recipes</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="css/reset.css">
        <link rel="stylesheet" type="text/css" href="css/skeleton.css">
        <link rel="stylesheet" type="text/css" href="css/comments.css">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type="text/javascript" src="resources/javascript/javascript.js"></script>
    </head>

    <body>
        <div class="row">
            <div class="four columns">
                <a href="index.php"><img id="logo" src="resources/logo.png" alt="The logo of the website 2 chefs hats and the word Cooking"></a>
            </div>
        </div>
        <div class="section group">
            <div class="menu">
                <form action="index.php">
                    <input type="submit" value="Home" />
                </form>
                <?php if (!isset($_SESSION['login_user'])) { ?>

                    <button onclick="document.getElementById('id01').style.display = 'block'" <p>Log in</p></button>
                <?php } ?>

                <?php if (isset($_SESSION['login_user'])) { ?>

                    <form action="logout.php">
                        <input type="submit" value="Log out" />
                    </form>
                <?php } ?>
                <form action="calendar.php">
                    <input type="submit" value="Calendar" />
                </form>

                <form action="index.php#featuredrecipes">
                    <input type="submit" value="Other recipes:" />
                </form>
                <form action="recipe-pancakes.php">
                    <input type="submit" value="Pancakes" />
                </form>

            </div>
        </div>
        <div>
            <h1 id="startOfRecipe">
                <?php echo $recipes->recipe[0]->title; ?>
            </h1>
            <div class="row">
                <div class="six columns">

                    <img id="recipePage" src="<?php echo $recipes->recipe[0]->imagepath; ?>" alt="A picture of meatballs served with delicious mashed potatoes">
                </div>

                <div class="six columns">
                    <h3>Ingredients:</h3>
                    <ul>
                        <?php
                        foreach ($recipes->recipe[0]->ingredient->children() as $a => $b) {
                            ?>
                        <li><?php echo "$b" ?></li>
                       <?php }?>
                    </ul>
                </div>
            </div>
            <div class="row">
                <h3>Instructions:</h3>
                <ol>
                        <?php
                        foreach ($recipes->recipe[0]->recipetext->children() as $a => $b) {
                            ?>
                        <li><?php echo "$b" ?></li>
                       <?php }?>
                </ol>
            </div>

            <div>
                <div>

                    <!-- Comment Submission -->
                    <?php if (isset($_SESSION['login_user'])) { ?>
                        <h3>Submit comment</h3>
                            <div>
                                <textarea name="comment" id="commentText"></textarea>
                            </div>
                            <input type="submit" value="Submit" id="comment">
                    <?php } ?>
                    <!-- Comment Display -->

                    <h4>Comments:</h4>
                    <div class="comments">
                    </div>
                </div>
            </div>
        </div>
        <div class="socialMediaLinks">
            <h5>Find us on social media</h5>
            <a href="" target="_blank" id="facebook">Facebook</a>
            <a href="" target="_blank" id="twitter">Twitter</a>
            <a href="" target="_blank" id="youtube">Youtube</a>
            <a href="" target="_blank" id="flickr">Flickr</a>
            <a href="" target="_blank" id="googleplus">Google&#43;</a>
        </div>
        <div class="footer">
            <p>
                &copy; <em>Copyright 2019. No rights reserved</em>
            </p>
        </div>
        <?php include("login.php"); ?>
    </body>

</html>
