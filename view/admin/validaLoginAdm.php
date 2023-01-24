<?php

/* PÁGINA DE VALIDAÇÃO DE LOGIN DO ADMIN
 * SE NÃO HÁ SESSÃO INICIADA OU O PERFIL DO USUÁRIO DA SESSÃO FOR DIFERENTE DE 0(ADMN)
 * USUÁRIO REDIMENSIONADO PARAPÁGINA DE LOGIN
 */
session_start();

if (!isset($_SESSION["Usuario"])or $_SESSION['prefil']!=0) {
    echo "<script>";
    echo "   window.location='http://localhost/greensys/view/login.php'";
    echo "</script>";
}
