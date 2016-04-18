<!DOCTYPE html>
<html>
  <head>
    <?php
    require_once 'classes/config.php';
    require_once 'classes/sesiones.php';
    require_once 'classes/usuarios.php';
    $conf = new Config();
    $sesion = new Sesion();
    include('head.php');
    ?>
  </head>
  <body>
    <header>
      <div id="menu" >
        <h1><i class="fa fa-bars"></i>DEUAN</h1>
      </div>
      <div id="logo">
      <a href="<?php echo $conf->getCfg("url"); ?>"><img src="images/logo.png" alt="" /></a>
        <?php
        if($sesion->Verificar() == true){
          $user = new Usuario();
          $user->setId($_SESSION['id']);

          echo '<h1>'.$user->getUser().' <a href="'.$conf->getCfg("url").'logout"><i class="fa fa-times"></i></a></h1>';
        }
        else{
          echo '<h1 class="iniciar"><a href="'.$conf->getCfg("url").'login">Iniciar</br>Sesión</a></h1>';
        }
        ?>
         
      </div>
    </header>
    <section class="menuoff" id="pages">

    </section>
    <div id="divmenu" class ="menuoff">
    <div id="menuexit"><i class="fa fa-times"></i></div>
      <ul>
        <a href="<?php echo $conf->getCfg("url"); ?>"><li>Inicio</li></a>
        <?php
          if($sesion->Verificar() != true){
            echo '<a href="'.$conf->getCfg("url").'login"><li>Ingresar</li></a>
        <a href="'.$conf->getCfg("url").'reg"><li>Registrarse</li></a>';
          }
          else{
            if($user->getPrivilegio() == "1"){
            echo '<a href="'.$conf->getCfg("url").'admin"><li>Administración</li></a>';
            }
            echo '<a href="'.$conf->getCfg("url").'logout"><li>Cerrar Sesión</li></a>';
          }
        ?>
    </ul>
    </div>
    <div id="back"></div>
    <?php include('content.php'); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>

    <script type="text/javascript">
    $(document).ready(function(){
      $('.carousel').owlCarousel({
      margin:10,
      loop:true,
      autoWidth:true,
      items:4
    });
var coso = false;
    $("body").click(function(){
      if(coso == true){
        if($("div.flotante").hasClass("menuon")){
          $("div.flotante").addClass("menuoff").removeClass("menuon");
          coso = false;
      }
      }
    });
    $(".share").click(function(){
      $(".flotante").addClass("menuon").removeClass("menuoff");
      setTimeout(function(){ 
        coso = true;
      }, 500);
    });
    var menuon = false;
    $('.inpage').click(function(){
      $.ajax({
        type: "POST",
        url: $(this).attr("href"),
        cache: true,
        success: function(data)
        {
               $("#pages").html(data);
                $('#pages').addClass("menuon").removeClass("menuoff");
         }
      });
      return false;
    });
    $('.inback').click(function(){
      $.ajax({
        type: "POST",
        url: $(this).attr("href"),
        cache: true,
        success: function(data)
        {
               $("#back").html(data);
        }
      });
      return false;
    });
    $("#menu").click(function() {
      menuon = true;
      $("#divmenu").addClass("menuon").removeClass("menuoff");
    });
    $("#menuexit").click(function() {
      $("#divmenu").addClass("menuoff").removeClass("menuon");
      return false;
    });
    $("#logo").click(function() {
      if(menuon == true){
        $("#divmenu").addClass("menuoff").removeClass("menuon");
      }
      $("#pages").addClass("menuoff").removeClass("menuon");
    });
    
    });
    </script>
  </body>
</html>
