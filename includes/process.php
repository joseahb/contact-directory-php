<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    require_once('DirEditor.php');
    $direditor = new DirEditor();
    
    if (isset($_POST['create'])) {
        // Validate
        if (empty($_POST['firstname'])) {
            $_SESSION['message'] = "Contact first name is required";
            header("Location: ../info.php");
            exit;
        }
        if (empty($_POST['lastname'])) {
            $_SESSION['message'] = "Contact last name is required";
            header("Location: ../info.php");
            exit;
        }
        if (empty($_POST['email'])) {
            $_SESSION['message'] = "Contact email is required";
            header("Location: ../info.php");
            exit;
        }
        if (empty($_POST['phone'])) {
            $_SESSION['message'] = "Contact phone number is required";
            header("Location: ../info.php");
            exit;
        }
        if (empty($_POST['street'])) {
            $_SESSION['message'] = "Contact Street address is required";
            header("Location: ../info.php");
            exit;
        }
        if (empty($_POST['state'])) {
            $_SESSION['message'] = "Contact state is required";
            header("Location: ../info.php");
            exit;
        }
        if (empty($_POST['city'])) {
            $_SESSION['message'] = "Contact city is required";
            header("Location: ../info.php");
            exit;
        }
        if (empty($_POST['zip'])) {
            $_SESSION['message'] = "Contact zip is required";
            header("Location: ../info.php");
            exit;
        }
        // New Contact array
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
        header("Location: ../info.php");
    }
    if (isset($_GET['q'])) {
        // Validate
        // Validate
        if (empty($_GET['fname'])) {
            $_SESSION['message'] = "Contact first name is required for search";
            header("Location: ../info.php");
            exit;
        }
        if (empty($_GET['lname'])) {
            $_SESSION['message'] = "Contact last name is required for search";
            header("Location: ../info.php");
            exit;
        }
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
    if (isset($_POST['update_contact'])) {
        // Validate
        if (empty($_POST['firstname'])) {
            $_SESSION['message'] = "Contact first name is required";
            header("Location: ../info.php");
            exit;
        }
        if (empty($_POST['lastname'])) {
            $_SESSION['message'] = "Contact last name is required";
            header("Location: ../info.php");
            exit;
        }
        if (empty($_POST['email'])) {
            $_SESSION['message'] = "Contact email is required";
            header("Location: ../info.php");
            exit;
        }
        if (empty($_POST['phone'])) {
            $_SESSION['message'] = "Contact phone number is required";
            header("Location: ../info.php");
            exit;
        }
        if (empty($_POST['street'])) {
            $_SESSION['message'] = "Contact Street address is required";
            header("Location: ../info.php");
            exit;
        }
        if (empty($_POST['state'])) {
            $_SESSION['message'] = "Contact state is required";
            header("Location: ../info.php");
            exit;
        }
        if (empty($_POST['city'])) {
            $_SESSION['message'] = "Contact city is required";
            header("Location: ../info.php");
            exit;
        }
        if (empty($_POST['zip'])) {
            $_SESSION['message'] = "Contact zip is required";
            header("Location: ../info.php");
            exit;
        }
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
        $direditor->update_contact($contact,$_POST['oldfname'],$_POST['oldlname'] );
        header("Location: ../info.php");
    }

?>
