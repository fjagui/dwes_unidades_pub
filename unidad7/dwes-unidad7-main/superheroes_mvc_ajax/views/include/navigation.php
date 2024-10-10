<?php
    echo "<ul class=\"navigation\">";
    echo "<li><a href=\"".DIRBASEURL."/\">Home</a></li>";
    echo "<li><a href=\"#\">About</a></li>";
    echo "<li><a href=\"#\">Contact</a></li>";
    if ($_SESSION['perfil'] == 'admin') {
        echo "<li><a href=\"#\">Dashboard</a></li>";
    }

    echo "</ul>";
