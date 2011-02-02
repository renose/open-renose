<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>open reNose - Hello World</title>
    </head>
    <body>
        <?php
        	include('.\system\core\cms\settings.php');
        	
        	// put your code here
        	echo("hello world!");
        	echo("<br><br>");
        	
        	echo("Simple DB-Test:<br>");
        	echo("site_title = ".getSetting("cms", "site_title")."<br>");
  			echo("version = ".getSetting("cms", "version")."<br>");
        ?>
    </body>
</html>
