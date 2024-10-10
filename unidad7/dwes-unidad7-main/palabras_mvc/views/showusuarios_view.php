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
            <link href="/dwes/mvc_bookmark/public/css/screen.css" type="text/css" rel="stylesheet" />
            <link href="/dwes/mvc_bookmark/public/css/screen.css" type="text/css" rel="stylesheet" />
            <link href="/css/sidebar.css" type="text/css" rel="stylesheet" />
   
 
        <link rel="shortcut icon" href="img/favicon.ico" />
    </head>
    <body>
      <section id="wrapper">
        <header id="header">
          <div class="top">
     
            <nav>
              <ul class="navigation">
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
              </ul>
            </nav>
 
         </div>
         <hgroup>
         <h2><a href="#">bookMarks</a></h2>
         <h3><a href="">Link Manager</a></h3>
        </hgroup>
        </header>
            
            <section class="main-col">
            <h4>Mostrando un usuario</h4>
            <?php
                foreach ($data as $clave=>$valor) {
                  echo $valor['nombre']."<br/>";
                  echo $valor['user']."<br/>";
                  echo $valor['email']."<br/>";

                }
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
