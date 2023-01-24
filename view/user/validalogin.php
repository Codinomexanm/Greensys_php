<?php

/* PÁGINA DE VALIDAÇÃO DE LOGIN
  CASO HAJA SESSÃO INICIADA A PÁGINA É EXIBIDA, SENÃO REDIRECIONA O USR PARA A PÁGINA DE LOGIN 
 */
session_start();

if (!isset($_SESSION["Usuario"])) {
    echo "<script>";
    echo "   window.location='http://localhost/greensys/view/login.php'";
    echo "</script>";
}


