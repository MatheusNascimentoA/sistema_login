<?php 
//encerrando a seçãos
session_start();
session_unset();
session_destroy();
header('location: index.php');
        ?>      