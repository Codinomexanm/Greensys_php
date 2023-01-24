<?php

/**
 * Description of conexao
 *essa classe realiza a conexão com o banco de dados
 * @author diogenes
 */
//classe abstrata não pode ser instanciada
abstract class Conexao {
    private static $conexao;
    //aqui aplica-se o padrão singleton
    static function obterConexao(){
        try {
            //se não existe nada na variável $conexao
            if(!isset(self::$conexao)){
                //abre conexão
            //self::$conexao=new PDO("mysql:host=localhost;dbname=grensys", "root", "");
            self::$conexao=new PDO("mysql:host=localhost;dbname=grensys", "greensys","green123");
            self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            }
            //senão, apenas retorna a variável com o valor(conexão)
            return self::$conexao;
        } catch (PDOException $exc) {
            echo $exc->getMessage();
        }
        }
}

