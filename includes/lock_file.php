<?php
  /*
  Reference Material
  http://en.wikipedia.org/wiki/ACID
  */
  class Exclusive_Lock {
    /* Private variables */
    public $filename; // The file to be locked
    public $timeout = 30; // The timeout value of the lock
    public $permission = 0755; // The permission value of the locked file
    /* Constructor */
    public function __construct($filename, $timeout = 1, $permission = null, $override = false) {
      // Append '.lck' extension to filename for the locking mechanism
      $this->filename = $filename . '.lck';
      // Timeout should be some factor greater than the maximum script execution time
      $temp = @get_cfg_var('max_execution_time');
      if ($temp === false || $override === true) {
        if ($timeout >= 1) $this->timeout = $timeout;
        set_time_limit($this->timeout);
      } else {
        if ($timeout < 1) $this->timeout = $temp;
        else $this->timeout = $timeout * $temp;
      }
      // Should some other permission value be necessary
      if (isset($permission)) $this->permission = $permission;
    }
    /* Methods */
    public function acquireLock() {
      // Create the locked file, the 'x' parameter is used to detect a preexisting lock
      $fp = @fopen($this->filename, 'x');
      // If an error occurs fail lock
      if ($fp === false) return false;
      // If the permission set is unsuccessful fail lock
      if (!@chmod($this->filename, $this->permission)) return false;
      // If unable to write the timeout value fail lock
      if (false === @fwrite($fp, time() + intval($this->timeout))) return false;
      // If lock is successfully closed validate lock
      return fclose($fp);
    }
    public function releaseLock() {
      // Delete the file with the extension '.lck'
      return @unlink($this->filename);
    }
    public function timeLock() {
      // Retrieve the contents of the lock file
      $timeout = @file_get_contents($this->filename);
      // If no contents retrieved return error
      if ($timeout === false) return false;
      // Return the timeout value
      return intval($timeout);
    }
  }
?>