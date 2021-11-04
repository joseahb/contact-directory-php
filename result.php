<?php
/**
 * @author student <student@mymail.com>
 * @license MIT
 */

session_start();
include_once("includes/header.php");
if (isset($_SESSION['single'])) {
    $contact = (array)json_decode($_SESSION['single']);
}
?>
<link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
<link href="css/create.css" rel="stylesheet" media="all">
    <div class="page-wrapper bg-blue p-t-10 p-b-100 font-robo">
        <div class="wrapper wrapper--w680">
            <div class="card card-1">
                <div class="card-body">
                    <div class="row row-space">
                        <div class="col-2">
                            <h1>Contact</h1>
                        </div>
                        <div class="col-2">
                            <a href="edit.php?fname=<?=$contact['fname']."&&lname=".$contact['lname']?>" class="btn btn--radius btn--green">Edit</a>
                        </div>
                    </div>
                    <div class="row row-space">
                        <div class="col-2">
                           <h5>Name:</h5> 
                        </div>
                        <div class="col-2">
                            <?=$contact['fname']?>
                            <?=$contact['lname']?>                             
                        </div>
                    </div>
                    <div class="row row-space">
                        <div class="col-2">
                           <h5>Phone Number:</h5> 
                        </div>
                        <div class="col-2">
                            <?=$contact['email']?>
                        </div>
                    </div>
                    <div class="row row-space">
                        <div class="col-2">
                           <h5>Email:</h5> 
                        </div>
                        <div class="col-2">
                            <?=$contact['email']?>
                        </div>
                    </div>
                    <div class="row row-space">
                        <div class="col-2">
                           <h5>Street Address:</h5> 
                        </div>
                        <div class="col-2">
                            <?=$contact['street']?>
                        </div>
                    </div>
                    <div class="row row-space">
                        <div class="col-2">
                           <h5>State:</h5> 
                        </div>
                        <div class="col-2">
                            <?=$contact['state']?>
                        </div>
                    </div>
                    <div class="row row-space">
                        <div class="col-2">
                           <h5>City:</h5> 
                        </div>
                        <div class="col-2">
                            <?=$contact['city']?>
                        </div>
                    </div>
                    <div class="row row-space">
                        <div class="col-2">
                           <h5>zip code:</h5> 
                        </div>
                        <div class="col-2">
                            <?=$contact['zip']?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->
