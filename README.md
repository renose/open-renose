![open reNose logo](http://img.ptz.so/renose.png)


###Full supported browsers:
![Chrome](http://img.ptz.so/chrome.png) Chrome

![Firefox](http://img.ptz.so/firefox.png) Firefox

![Safari](http://img.ptz.so/safari.png) Safari

###Maybe supported browsers (won't be tested yet):
![Internet Explorer](http://img.ptz.so/ie.png) Internet Explorer 9

![Opera](http://img.ptz.so/opera.png) Opera

###NOT supported browsers (yet):
![Internet Explorer](http://img.ptz.so/ie.png) Internet Explorer 6, 7, 8

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
* rename app/Config/core.php.default to app/Config/core.php and add your own Security.salt and Security.cipherSeed
* rename app/Config/database.php.default to app/Config/database.php and insert your database connection settings
* rename app/Config/email.php.default to app/Config/email.php and add your email settings
* run application
