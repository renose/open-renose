<?PHP
require_once(BASE_PATH . "/system/core/mailer/phpmailer.inc.php");

class register extends plugin {

    public $name = "Register Module";
    public $description = "Registrations Module";
    public $version = "0.1.0.0";

    public function getTitle() {
	return "Registrierung";
    }

    public function show() {
	$this->tpl->display(database::getModuleTpl('register', 'register.tpl')); // load tpl file

	if (!empty($_POST) && $_POST['newRegistration']) {
	    $this->registerNewUser();
	}
    }

    public function registerNewUser() {
	$rNUusername = $_POST['username'];

	$rNUmail = $_POST['mail'];

	$rNUpassword = $_POST['password'];
	$rNUpassword = sha1($rNUpassword);

	if ($rNUusername && $rNUmail && $rNUpassword != "") {
	    try {
		$database = database::get();
		$sql = "INSERT INTO " . dbconfig::praefix . "users
			(id, username, mail, password)
			VALUES
                        ('NULL', :username, :mail, :password)
		";

		$stmn = $database->prepare($sql);
		$stmn->bindValue(':username', $rNUusername, PDO::PARAM_STR);
		$stmn->bindValue(':mail', $rNUmail, PDO::PARAM_STR);
		$stmn->bindValue(':password', $rNUpassword, PDO::PARAM_STR);

		$stmn->execute();
		$stmn->closeCursor();

		echo "<b>Success</b>";

		// start mailing with PHPMAILER:
		// not working yet
		/* $mail = new phpmailer();
		  $mail->IsSendmail(); // set mailer to use sendmail
		  $mail->From = "noreply@renose.de";
		  $mail->FromName = "open reNose";
		  $mail->AddAddress($rNUmail);
		  $mail->Subject = "Deine Anmeldung bei reNose.de";
		  $mail->Body = "Hallo <strong>$rNUusername</strong>,\nDanke f&uuml;r die Registrierung auf reNose.de";
		  $mail->WordWrap = 50;
		  $mail->Send(); // send message */
	    } catch (PDOException $e) {
		echo "<b>Fail</b><br>";
		echo $e->getMessage();
	    }
	} else {
	    echo "<script type='text/javascript'>alert('Bitte alle Felder ausfüllen');</script>";
	}
    }
}

?>