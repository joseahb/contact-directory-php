<?php

/**
 * @author student <student@mymail.com>
 * @license MIT
 * Directory file editor
 * 
 */
include("lock_file.php");
 class DirEditor {
      
   private $filename = 'directory.txt';
   private $file;

   function __construct() {
      session_start();
      $this->check_dir_file();
      $this->file = new Exclusive_Lock($this->filename, 2);
   }

   function insert_contact($contact) {
      $newContact = json_encode($contact);
      $data = $this->get_contacts_dir();
      array_push($data, $newContact);
      if ($this->file->acquireLock()) {
         file_put_contents($this->filename, json_encode($data));
         $this->file->releaseLock();
         chmod($this->filename, 0755);
      }

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
         if(array_search($contact['fname'], $tmp) != 'fname' && array_search($contact['lname'], $tmp) != 'lname') {
            array_push($updated, json_encode($contact));
            continue;
         }
         else{
            array_push($updated, $entry);
         }
      }
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