<?php
//SE A SESSÃO FOR DIFERENTE DE ADM
if($_SESSION['perfil']!=0){
    //REDIMENSIONA PARA LOGIN
    echo "<script>";
    echo "   window.location='http://localhost/greensys/view/login.php'";
    echo "</script>";
}
