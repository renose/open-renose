<h1>Einloggen</h1>
<br />
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
    <table>
	<tr>
	    <td>Username:</td>
	    <td><input type="text" name="username" value="" /></td>
	</tr>
	<tr>
	    <td>Passwort:</td>
	    <td><input type="password" name="password" value="" /></td>
	</tr>
	<tr>
	    <td><input type="submit" name="loginUser" value="Einloggen" /></td>
	    <td><p><a href="#" class="floatright">Passwort vergessen?</a></p></td>

	      BenutzerId: <?php echo $_SESSION["userid"]; ?><br>
  Nickname: <?php echo $_SESSION["username"]; ?><br>

	</tr>
    </table>
</form>