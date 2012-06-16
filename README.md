![open reNose logo](http://img.ptz.so/renose.png)


###Full supported browsers:
* Chrome
* Firefox
* Safari

###Maybe supported browsers (won't be tested yet):
* Internet Explorer 9
* Opera

###NOT supported browsers (yet):
* Internet Explorer 6, 7, 8

---
No download available yet, please checkout from master.

### Requirements
* Web server (Apache, nginx)
* Database supported by CakePHP, MySQL is recommended and tested
* Mail server supported by CakePHP, Linux mail command or SMTP Server recommended
* mod_rewrite (for nice url's) and cURL (for PDF generator) Apache/PHP Module

### Installation
* Clone repository
* Import renose_dev.sql into database
* rename app/Config/database.php.default to app/Config/database.php and insert your database connection data
* rename app/Config/email.php.default to app/Config/email.php and check data
* run application

Install tool will be finished in a few days.


**Important: open reNose is in a early state of development. Please note, that security issues might be in this script.**

For reports: Use the bugtracker or send a mail. Thanks!