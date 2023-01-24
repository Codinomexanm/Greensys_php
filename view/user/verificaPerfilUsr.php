<?php
//SE O PERFIL DO USUÁRIO FOR DIFERENTE DE USR
if($_SESSION['perfil']!=1){
    //REDIMENSIONA PARA LOGIN
    echo "<script>";
    echo "   window.location='http://localhost/greensys/view/login.php'";
    echo "</script>";
}
