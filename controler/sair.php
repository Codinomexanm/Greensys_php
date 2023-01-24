<?php
//SCRIPT PARA SAIR DO SISTEMA
session_start();
//DESTROI A SESSÃO
session_destroy();
//REDIMENSIONA PARA A PÁGINA DE LOGIN
echo "<script>
        window.location='http://localhost/greensys/view/login.php';
        </script>";
?>

