![open reNose logo](http://img.ptz.so/renose.png)


###Full supported browsers:
* Chrome
* Firefox
* Safari

###NOT supported browsers (yet):
* Internet Explorer 6, 7, 8, 9 (?)
* Opera

---
No download available yet, please checkout from master.

### Requirements
* Web server (Apache, nginx)
* MySQL database (others not tested)
* PHP cURL for PDF generator
* SMTP mail server
* mod_rewrite apache module

### Installation
* Clone repository
* Import renose_dev.sql into database
* rename app/Config/database.php.default to app/Config/database.php and insert your database connection data
* rename app/Config/email.php.default to app/Config/email.php and check data
* run application

Install tool will be finished in a few days.


**Important: open reNose is in a early state of development. Please note, that security issues might be in this script.**

For reports: Use the bugtracker or send a mail. Thanks!