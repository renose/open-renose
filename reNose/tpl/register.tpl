<div class="sidebox">
    <h2>Dies stellt <br />eine Infobox dar.</h2>
</div>

    <h1>Registrieren</h1>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
	<table>
	    <tr>
		<td>Username:</td>
		<td><input type="text" name="username" value="<?php $_POST['username'] ?>" /></td>
	    </tr>
	    <tr>
		<td>E-Mail:</td>
		<td><input type="text" name="mail" value="<?php $_POST['mail'] ?>" /></td>
	    </tr>
	    <tr>
		<td>Passwort:</td>
		<td><input type="password" name="password" value="<?php $_POST['password'] ?>" /></td>
	    </tr>
	    <tr>
		<td colspan="2"><input type="submit" name="newRegistration" /></td>
	    </tr>
	</table>
    </form>
    <p>Ihre IP Adresse (<?php echo $_SERVER['REMOTE_ADDR'] ?>) wird aus Sicherheitsgründen 14 Tage lang gespeichert.</p>