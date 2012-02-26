<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php echo $this->eprint($this->title); ?></title>
    </head>
    <body>
        <div class="center">
            <p><?php echo $this->eprint($this->helloworld); // we are alive ?></p>
            <p>
              DB-Test: <br />
              <?php echo $this->eprint($this->dbtest); ?><br />
              Version: <?php echo $this->eprint($this->version); ?>
            </p>
       