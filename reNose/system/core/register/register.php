<?PHP
require_once(BASE_PATH . "/system/core/mailer/phpmailer.inc.php");

//open reNose Main-Class
class register extends plugin
{
	public $name = "Register Module";
	public $description = "Registrations Module";
	public $version = "0.1.0.0";
	
	public function getTitle()
	{
		return "Registrierung";
	}

	public function show()
	{
	    $this->tpl->display(database::getModuleTpl('register', 'register.tpl')); // load tpl file
	    
		if(!empty($_POST) && $_POST['newRegistration'])
		{
		    //$this->registerNewUser($rNUusername, $rNUmail, $rNUpassword);
		    $this->registerNewUser();
		}
	}

	//public function registerNewUser($rNUusername, $rNUmail, $rNUpassword)
	public function registerNewUser()
	{
	    $rNUusername = $_POST['username'];
	    $rNUusername = stripslashes($rNUusername);

	    $rNUmail = $_POST['mail'];
	    $rNUmail = stripslashes($rNUmail);

	    $rNUpassword = $_POST['password'];
	    $rNUpassword = stripslashes($rNUpassword);
	    $rNUpassword = sha1($rNUpassword);
	    
	    if ($rNUusername && $rNUmail && $rNUpassword != "")
	    {
			$res = mysql_query("INSERT INTO " . database::praefix . "users (id, username, mail, password)
		    	VALUES ('NULL', '". $rNUusername ."', '". $rNUmail ."', '". $rNUpassword ."');");
	    }
	    else
	    {
			echo "<script type='text/javascript'>alert('Bitte alle Felder ausfüllen');</script>";
	    }
		
	    if ($res)
	    {
			echo "Success";
			// start mailing with PHPMAILER:
			$mail = new phpmailer();
			$mail->IsSendmail(); // set mailer to use sendmail
			$mail->From = "noreply@renose.de";
			$mail->FromName = "open reNose";
			$mail->AddAddress($rNUmail);
			$mail->Subject = "Deine Anmeldung bei reNose.de";
			$mail->Body = "Hallo <strong>$rNUusername</strong>,\nDanke f&uuml;r die Registrierung auf reNose.de";
			$mail->WordWrap = 50;
			$mail->Send(); // send message
	    }
	    else
	    {
			echo "Fail";
	    }
	}
}

?>