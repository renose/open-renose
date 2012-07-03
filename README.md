![open reNose logo](http://img.ptz.so/renose.png)


###Full supported browsers:
![Chrome](https://github.com/renose/renose/raw/master/app/webroot/img/icons/chrome.png) Chrome

![Firefox](https://github.com/renose/renose/raw/master/app/webroot/img/icons/firefox.png) Firefox

![Safari](https://github.com/renose/renose/raw/master/app/webroot/img/icons/safari.png) Safari

###Maybe supported browsers (won't be tested yet):
![Internet Explorer](https://github.com/renose/renose/raw/master/app/webroot/img/icons/ie.png) Internet Explorer 9

![Opera](https://github.com/renose/renose/raw/master/app/webroot/img/icons/opera.png) Opera

###NOT supported browsers (yet):
![Internet Explorer](https://github.com/renose/renose/raw/master/app/webroot/img/icons/ie.png) Internet Explorer 6, 7, 8

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