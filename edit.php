<?php
/**
 * @author student <student@mymail.com>
 * @license MIT
 */
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
session_start();
$contact = (array)json_decode($_SESSION['single']);
include_once("includes/header.php");
?>
<link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
<link href="css/create.css" rel="stylesheet" media="all">
    <div class="page-wrapper bg-blue p-t-10 p-b-100 font-robo">
        <div class="wrapper wrapper--w680">
            <div class="card card-1">
                <div class="card-body">
                    <h2 class="title">Update contact</h2>
                    <form method="POST" action="includes/process.php">
                        <input type="hidden" name="oldfname" value="<?=$contact['fname']?>">
                        <input type="hidden" name="oldlname" value="<?=$contact['lname']?>">

                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" placeholder="first name" name="firstname" value="<?=$contact['fname']?>">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" placeholder="last name" name="lastname" value="<?=$contact['lname']?>">
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" placeholder="Phone Number" name="phone" value="<?=$contact['phone']?>">
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="email" placeholder="email" name="email" value="<?=$contact['email']?>">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" placeholder="Street address" name="street" value="<?=$contact['street']?>">
                                </div>
                            </div>
                        </div>
                        <div class="input-group">
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select name="state">
                                    <?php echo "<option  selected='selected'>".$contact['state']."</option>";?>
                                    <option>California</option>
                                    <option>Texas</option>
                                    <option>Washington</option>
                                    <option>Florida</option>
                                    <option>Virginia</option>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div>
                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="City" name="city" value="<?=$contact['city']?>">
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" placeholder="Zip Code" name="zip" value="<?=$contact['zip']?>">
                                </div>
                            </div>
                        </div>
                        <div class="p-t-20">
                            <input class="btn btn--radius btn--green" type="submit" name="update_contact" value="Submit" />
                        </div>
                    </form>
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
