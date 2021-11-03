<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    require_once('DirEditor.php');
    $direditor = new DirEditor();
    
    if (isset($_POST['create'])) {
        if ($direditor->check_dir_file()) {
            $contact = array(
                'fname' => $_POST['firstname'], 
                'lname' => $_POST['lastname'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'street' => $_POST['street'],
                'city' => $_POST['city'],
                'state' => $_POST['state'],
                'zip' => $_POST['zip'],
            );
            $direditor->insert_contact($contact);
        }
        header("Location: ../info.php");
    }
    if (isset($_GET['q'])) {
        if (!$direditor->check_dir_file()) {
            header("Location: ../info.php");
        }
        else {
           $found = $direditor->find_contact($_GET['fname'], $_GET['lname']);
           if ($found == false) {
                $_SESSION['message'] = "Contact name ".$_GET['fname'] ." ". $_GET['lname']." not found";
                header("Location: ../info.php");
           }
           else {
                $_SESSION['single'] = $found;
                header("Location: ../result.php");
           }
        }
    }
    if (isset($_POST['update_contact'])) {
        $contact = array(
            'fname' => $_POST['firstname'],
            'lname' => $_POST['lastname'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone'],
            'street' => $_POST['street'],
            'city' => $_POST['city'],
            'state' => $_POST['state'],
            'zip' => $_POST['zip']
        );
        $direditor->update_contact($contact);
        header("Location: ../info.php");
    }

?>
