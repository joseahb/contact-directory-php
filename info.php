<?php
/**
 * @author student <student@mymail.com>
 * @license MIT
 */
session_start();
require_once("includes/header.php");
?>

<link href="css/search.css" rel="stylesheet" />
    <div class="s003">
        <div class="p-t-10">
            <?php 
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            }else{
                echo "No info found go back home";
            }
            ?>
        </div>
    </div>

<?php
require_once("includes/footer.php");
?>