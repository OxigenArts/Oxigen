<?php
require_once('classes/config.php');
require_once('classes/temas.php');
require_once('classes/posts.php');
require_once('classes/media.php');
$conf = new Config();
$tema = new Tema();
$tema->setId($conf->getCfg("tema"));
?>
<section id="four">
	<div class="container">
		<h3><?php echo $tema->getCfg("contact_title"); ?></h3>
		<p><?php echo $tema->getCfg("contact_content"); ?></p>
		<form method="post" action="#">
			<div class="row uniform collapse-at-2">
				<div class="6u"><input type="text" name="name" id="name" placeholder="Nombre" /></div>
				<div class="6u"><input type="email" name="email" id="email" placeholder="Email" /></div>
			</div>
			<div class="row uniform">
				<div class="12u"><input type="text" name="subject" id="subject" placeholder="Asunto" /></div>
			</div>
			<div class="row uniform">
				<div class="12u"><textarea name="message" id="message" placeholder="Mensaje" rows="6"></textarea></div>
			</div>
			<div class="row uniform">
				<div class="12u">
					<ul class="actions">
						<li><input type="submit" class="special" value="Enviar Mensaje" /></li>
						<li><input type="reset" value="Limpiar Formulario" /></li>
					</ul>
				</div>
			</div>
		</form>
	</div>
</section>