<?php
/*
 * default.ctp
 *
 * Copyright (c) 2011 open reNose team <info at renose.de>.
 * Simon Wörner and Patrick Hafner.
 *
 * This file is part of open reNose.
 *
 * open reNose is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * open reNose is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with open reNose.  If not, see <http ://www.gnu.org/licenses/>.
 */
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $this->Html->charset(); ?>
        <title>
            <?php echo $title_for_layout; ?>
            <?php __(' - open reNose'); ?>
        </title>
        <?php
            echo $this->Html->meta('icon');

            echo $this->Html->css('style');
            echo $this->Html->css('cake.generic');

            echo $html->script('prototype');
            echo $html->script('scriptaculous');
            echo $html->script('ckeditor/ckeditor');

            echo $scripts_for_layout;
        ?>
        </head>
        <body>
            <div id="container">
                <div id="wrapper">
                    <div id="header">
                        <a href="<?php echo $this->Html->url('/', true); ?>">
                            <h1 id="logo">
                                <span>open</span>reNose
                            </h1>
                        </a>
                        <div id="headerinfo">
                        <?php echo $this->element('userinfo'); ?>
                    </div>
                </div>
                <div id="navigation">
                    <ul>
                        <?php echo $this->element('navigation', array('menu' => 'main', 'cache' => '+3 hour')); ?>
                    </ul>
                </div>
                <div id="content">
                    <p class="breadcrumb">
                        <?php echo $this->Html->getCrumbs(' > ','Home'); ?>
                    </p>
                    <?php
                        echo $this->Session->flash();
                        echo $this->Session->flash('auth');
                        echo $this->Session->flash('email');
                    ?>

                    <?php echo $content_for_layout; ?>

                    <div style="background: aliceblue">
                        <?php echo $this->element('sql_dump'); ?>
                    </div>
                </div>
            </div>
            <div id="trenner"></div>
            <div id="footer">
                <div id="footerwrapper">
                    <div class="footerbox">
                        <ul>
                            <li class="headline">Navigation</li>
                            <?php echo $this->element('navigation', array('menu' => 'footer', 'cache' => '+3 hour')); ?>
                        </ul>
                    </div>

                    <div class="footerbox">
                        <ul>
                            <li class="headline">Dev Links</li>
                            <?php echo $this->element('navigation', array('menu' => 'dev', 'cache' => '+3 hour')); ?>
                        </ul><br/>

                        <?php
                            echo $this->Html->link(
                                    $this->Html->image('cake.power.gif', array('alt' => __('CakePHP: the rapid development php framework', true), 'border' => '0')),
                                    'http://www.cakephp.org/',
                                    array('target' => '_blank', 'escape' => false)
                            );
                        ?>
                    </div>

                    <div class="footerbox lastbox">
                        <p class="floatright">
                            Page rendered in <?php echo round((getMicroTime() - $_SERVER['REQUEST_TIME']) * 1000) ?>ms</p>
                        <p class="floatright">2011 by
                            <a href="mailto:simon@renose.de">Simon Wörner</a> und
                            <a href="mailto:patrick@renose.de">Patrick Hafner</a> |
                            <a href="http://www.renose.de">renose.de</a></p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>