<?php
    require_once 'Savant3.php';
    include('./system/core/cms/settings.php');
    
    $tpl = new Savant3(); // templating engine

    $version = getSetting("cms", "version"); // get version from db
    $name = "open reNose " . $version . ""; // <title>

    // Content
    $helloworld = "hello world!";
    $dbtest = getSetting("cms", "site_title");

    // register to tpl engine
    $tpl->title = $name;
    $tpl->helloworld = $helloworld;
    $tpl->dbtest = $dbtest;
    $tpl->version = $version;

    $tpl->display('tpl/header.tpl.php'); // load tpl file
    $tpl->display('tpl/index.tpl.php'); // load tpl file
    $tpl->display('tpl/footer.tpl.php'); // load tpl file

    ?>
