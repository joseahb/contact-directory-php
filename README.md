# Simple Contact directory php
System uses flat-file system to store data

# Setup

- Copy to server(e.g htdocs for xampp)

- create directory file named  `directory.php` in `includes` folder

- Verify permissions for file

# Structure

- views - index,create,edit,search,info
- `includes/process.php` : Receive and manipulate requests and responses
- `includes/DirEditor.php` : Directory file editor class
- `includes/lock_file.php` : Create exclusive locks for updating directory file
- SSIs - `includes/header.php`, `includes/footer.php`