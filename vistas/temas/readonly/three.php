<?php
require_once('classes/config.php');
require_once('classes/temas.php');
require_once('classes/posts.php');
require_once('classes/imagenes.php');
$conf = new Config();
$tema = new Tema();
$post = new Post();
$img = new Imagen();
$tema->setId($conf->getCfg("tema"));

?>

<section id="three">
	<div class="container">
		<h3><?php echo $tema->getCfg("news_title"); ?></h3>
		<p><?php echo $tema->getCfg("news_content"); ?></p>
		<div class="features">
			<?php 
			$maxposts = $tema->getCfg("news_maxposts");
			$allposts = array_reverse($post->getAll());
			$array_posts = array_slice($allposts, 0,$maxposts);
			foreach ($array_posts as $value){
				$img->setId($value["img"]);
				echo'<article>
				<a href="" class="image"><img src="'.$img->getUrl().'" alt="" /></a>
				<div class="inner">
					<h4>'.$value['titulo'].'</h4>
					<p>'.substr($value['contenido'], 0,120).'...</p>
					<a href="#" class="button alt">Ver mas</a>
				</div>
			</article>';
			}
			?>
		</div>
	</div>
</section>