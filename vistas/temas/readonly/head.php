<?php
require_once 'classes/config.php';
$conf = new Config();
$titulo = $conf->getCfg("titulo");
$nombre = $conf->getCfg("nombre");
?>
<title><?php echo $nombre." - ".$titulo; ?></title>
<base href="<?php echo $conf->getCfg("url"); ?>vistas/temas/readonly/"></base>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="description" content="" />
<meta name="keywords" content="" />
<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
<script src="js/jquery.min.js"></script>
<script src="js/jquery.scrollzer.min.js"></script>
<script src="js/jquery.scrolly.min.js"></script>
<script src="js/skel.min.js"></script>
<script src="js/skel-layers.min.js"></script>
<script src="js/init.js"></script>
<noscript>
	<link rel="stylesheet" href="css/skel.css" />
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/style-xlarge.css" />
</noscript>
<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
<script>
var img ="#imgcont";
$( window ).resize(function() {
	$(img).width("100%");
	$(img).height($(img).width());

});
$(document).ready(function(){
	$(img).width("100%");
	$(img).height($(img).width());
});
</script>
<style>
#imgcont {
	border-radius: 100%;
	display: block;
	background-size: cover;
	background-position: center center;
	width:100%;
}
</style>