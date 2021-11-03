<?php

use function PHPSTORM_META\map;

/**
 * @author student <student@mymail.com>
 * @license MIT
 * Directory file editor
 * 
 */

 class DirEditor {
      
   private $filename = 'directory.txt';

   function __construct() {
      session_start();
   }

   function insert_contact($contact) {
      $newContact = json_encode($contact);
      $data = $this->get_contacts_dir();
      array_push($data, $newContact);
      file_put_contents($this->filename, json_encode($data));
      $_SESSION['message'] = "Contact inserted successfully";
      return true;
   }

   public function find_contact($fname, $lname)
   {
      $data = $this->get_contacts_dir();
      $found = null;
      foreach ($data as $entry) {
         $tmp = (array) json_decode($entry);
         if(array_search($fname, $tmp) && array_search($lname, $tmp)) {
            $found = $entry;
            break;
         }
      }
      return $found != null ? $found : false;
   }

   public function update_contact($contact)
   {
      $data = $this->get_contacts_dir();
      $updated = [];
      foreach ($data as $entry) {
         $tmp = (array) json_decode($entry);
         if(array_search($contact['fname'], $tmp) && array_search($contact['lname'], $tmp)) {
            array_push($updated, json_encode($contact));
            break;
         }
         else{
            array_push($updated, $entry);
         }
      }
      file_put_contents($this->filename, json_encode($updated));
      $_SESSION['message'] = "Contact updated successfully";
      return true;
   }

   public function get_contacts_dir()
   {
      $recoveredData = file_get_contents($this->filename);
      $recoveredArray = json_decode($recoveredData, true);
      $recoveredArray === null ? $recoveredArray = []: true;
      return $recoveredArray;
   }
   function check_dir_file() {
      if (file_exists($this->filename) && is_writable($this->filename) && is_readable($this->filename)) {
         return true;
      } else {
         $message = "The directory does not exists or permission properly set";
         $_SESSION['message'] = $message;
         return false;
      }
   }
 }
?>