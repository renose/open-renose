<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
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
        <div id="headerinfo">*Info*</div>
      </div>
      <div id="navigation">
      	<ul>
            <?php echo $this->element('navigation', array('menu' => 'main', 'cache' => '+3 hour')); ?>
      	</ul>
	  </div>
      <div id="content">
          <p class="breadcrumb">
              *breadcrumb*
          </p>		
		<?php
                    echo $this->Session->flash();
                    echo $this->Session->flash('auth');
                ?>

		<?php echo $content_for_layout; ?>
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

              <?php echo $this->Html->link(
                                $this->Html->image('cake.power.gif', array('alt'=> __('CakePHP: the rapid development php framework', true), 'border' => '0')),
                                'http://www.cakephp.org/',
                                array('target' => '_blank', 'escape' => false)
                        );
                ?>
        </div>
          
        <div class="footerbox lastbox">
          <p class="floatright">2011 by 
          <a href="mailto:simon@renose.de">Simon W&#246;rner</a> und
          <a href="mailto:patrick@renose.de">Patrick Hafner</a> | 
          <a href="http://www.renose.de">renose.de</a></p>
        </div>
      </div>
    </div>
  </div>
</body>
</html>