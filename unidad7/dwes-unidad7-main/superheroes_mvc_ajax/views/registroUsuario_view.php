            
   <!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html"; charset="utf-8" />
        <title>TITULO</title>
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
     
            <link href='http://fonts.googleapis.com/css?family=Irish+Grover' rel='stylesheet' type='text/css'>
            <link href='http://fonts.googleapis.com/css?family=La+Belle+Aurore' rel='stylesheet' type='text/css'>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css"> 
            <link href="<?php echo DIRPUBLIC."/css/blog.css" ?>" type="text/css" rel="stylesheet" />
            <link href="<?php echo DIRPUBLIC."/css/screen.css" ?>" type="text/css" rel="stylesheet" />
            <link href="<?php echo DIRPUBLIC."/css/sidebar.css" ?>" rel="stylesheet" />
            <link rel="shortcut icon" href="img/favicon.ico" />
    </head>
    <body>
      <section id="wrapper">
        <header id="header">
          <div class="top">
          <nav>
              <?php include('include\navigation.php');?>
          </nav>
          </div>
          <div>
              <?php include('include\header.php');?>
          </div>
         <hgroup>
         <h2><a href="#">Symblog</a></h2>
         <h3><a href="">Creando un blog MVC</a></h3>
        </hgroup>
        </header>
         
            
            <section class="main-col">
            <h2>Registro Usuarios</a></h2>
            <?php
        
            echo '<form name="formUserRegister" method="post" action="http://development.local/dwes/mvc_bookmark/public/index.php/users/register">';
            echo '<div id="enquiry">';
           
            echo '<div>';
            echo '<label for="enquiry_nombre" class="required">Nombre</label>';
            echo '<input type="text" id="enquiry_nombre" name="nombre" value="'.$data['nombre'].'" required="required" />'.$data['msgErrorNombre'];
            echo '</div>';
           
            echo '<div>';
            echo '<label for="enquiry_usuario" class="required">Usuario</label>';
            echo '<input type="text" id="enquiry_usuario" name="usuario" value="'.$data['usuario'].'" required="required" />'.$data['msgErrorUsuario'];
            echo '</div>';
           
            echo '<div>';
            echo '<label for="enquiry_email" class="required">Email</label>';
            echo '<input type="text" id="enquiry_email" name="email" value="'.$data['email'].'" required="required" />'.$data['msgErrorEmail'];
            echo '</div>';
           
            echo '<div>';
            echo '<label for="enquiry_pass1" class="required">Contraseña</label>';
            echo '<input type="text" id="enquiry_pass1" name="pass1" required="required" />';
            echo '</div>';

            echo '<div>';
            echo '<label for="enquiry_nombre" class="required">Repite contaseña</label>';
            echo '<input type="text" id="enquiry_pass2" name="pass2" required="required" />'.$data['msgErrorPass'];
            echo '</div>';

            echo '<input type="submit" id="enquiry_save" name="enquiry[save]">';
            echo '</div>';
            echo '</div>';
            echo '</form>';
            
            
            
            
            ?> 
                
            </section>
            <aside class="sidebar">
        
            </aside>

            <div id="footer">
                Link Manager
            </div>
        </section>

        
    </body>
</html>
