<?php
/**
 * @author student <student@mymail.com>
 * @license MIT
 * @copyright 2021 assignment 3
 */

include("lock_file.php");
class DirEditor {
   const FILENAME = 'directory.txt';
   private $file;

   /**
    * Initialize directory file
    */
   function __construct() {
      session_start();
      $this->check_dir_file();
      $this->file = new Exclusive_Lock(self::FILENAME, 2);
   }

   /**
    * Inserts new record to directory file
    *
    * @param Array $contact
    * @return boolean
    */
   function insert_contact($contact) {
      $newContact = json_encode($contact);
      $data = $this->get_contacts_dir();
      array_push($data, $newContact);
      if ($this->file->acquireLock()) {
         file_put_contents(self::FILENAME, json_encode($data));
         $this->file->releaseLock();
         $_SESSION['message'] = "Contact inserted successfully";
         return true;
      }
      else {
         $_SESSION['message'] = "Failed to acquire lock";
         return false;
      }

   }

   /**
    * Searches records in directory for single contact
    *
    * @param string $fname
    * @param string $lname
    * @return contact|false
    */
   public function find_contact($fname, $lname)
   {
      $data = $this->get_contacts_dir();
      $found = null;
      foreach ($data as $entry) {
         $tmp = (array) json_decode($entry);
         if($tmp['fname'] == $fname && $tmp['lname'] == $lname) {
            $found = $entry;
            break;
         }
      }
      return $found != null ? $found : false;
   }

   /**
    * Updates single record's values
    *
    * @param Array $contact
    * @return boolean
    */
   public function update_contact($contact, $oldfname, $oldlname)
   {
      $data = $this->get_contacts_dir();
      $updated = [];
      // Find single contact and replace record
      foreach ($data as $record) {
         $tmp = (array) json_decode($record);
         if($tmp['fname'] == $oldfname && $tmp['lname'] == $oldlname ) {
            array_push($updated, json_encode($contact));
            continue;
         }
         else{
            array_push($updated, $record);
         }
      }
      // write updated records to file
      if ($this->file->acquireLock()) {
         file_put_contents(self::FILENAME, json_encode($updated));
         $this->file->releaseLock();
         $_SESSION['message'] = "Contact updated successfully";
         return true;
      }
      else {
         $_SESSION['message'] = "Failed to acquire lock";
         return false;
      }
   }

   /**
    * Gets all records as an associative array
    *
    * @return Array
    */
   public function get_contacts_dir()
   {
      $recoveredData = file_get_contents(self::FILENAME);
      $recoveredArray = json_decode($recoveredData, true);
      $recoveredArray === null ? $recoveredArray = []: true;
      return $recoveredArray;
   }

   /**
    * check if directory text file exists or editable
    *
    * @return boolean
    */
   function check_dir_file() {
      if (file_exists(self::FILENAME) && is_writable(self::FILENAME) && is_readable(self::FILENAME)) {
         return true;
      } else {
         $message = "The directory does not exists or permission properly set";
         $_SESSION['message'] = $message;
         header('Location: ../info.php');
         exit;
      }
   }
}
?>