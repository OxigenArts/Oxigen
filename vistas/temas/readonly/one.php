<?php
require_once('classes/config.php');
require_once('classes/temas.php');
$conf = new Config();
$tema = new Tema();
$tema->setId($conf->getCfg("tema"));
?>

<section id="one">
	<div class="container">
		<header class="major">
			<h2><?php echo $tema->getCfg("about_title"); ?></h2>
			<p><?php echo $tema->getCfg("about_subtitle"); ?></p>
		</header>
		<p><?php echo $tema->getCfg("about_content"); ?></p>
	</div>
</section>