<?php

namespace App\Persistencia;


class ConexaoBanco extends \PDO {

    private static $instancia = null;

    public function ConexaoBanco($dsn, $usuario, $senha) {
        //Construtor da classe pai PDO
        parent::__construct($dsn, $usuario, $senha);
    }
    //é um singleton ou seja, so permite uma instancia da classe conexao banco
    public static function getInstancia() {
        if (!isset(self::$instancia)) {
            try {
                /* Cria e retorna uma nova conexão */
                self::$instancia = new ConexaoBanco("mysql:dbname=loja;host=localhost", "root", "");
            } catch (Exception $e) {
                echo 'Erro ao conectar! ' . $e;
                exit();
            }
        }
        return self::$instancia;
    }

}
