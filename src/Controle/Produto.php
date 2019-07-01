<?php

namespace App\Controle;//identificar em qual pacote esta a classe

use App\Modelo;//semelhante ao import java

use App\Dao;//semelhante ao import java

class Produto {

    private $dao;//variavel usada apenas para armazenar um objeto da classe dao
    
    function __construct() {//construtor
        $this->dao = new Dao\Produto();//construindo objeto para classe dao de produto
    }
    
    //metodo de criar produtos no banco de dados
    public function criar($dados) {
        $produto = new Modelo\Produto();//instancia o produto
        $produto->setNome($dados['nome'])//atribui um nome para o produto
                ->setPreco($dados['preco'])//atribui um preco para o produto
                ->setQuantidade($dados['quantidade']);//atribui uma quantidade para o produto
        $this->dao->cadastrar($produto);//chama o metodo que cadastra no banco
    }
    //metodo para buscar produtos no banco
    public function buscar(){
        return $this->dao->listar();//chama o metodo que busca no banco
    }
    //metodo para filtrar produtos no banco
    public function filtrar($filtros){
        return $this->dao->listar($filtros);//chama o metodo que filtra no banco
    }
    //metodo para alterar produtos no banco
    public function alterar($id,$dados){
        $produto = $this->dao->buscarPorId($id);//busca o produto no banco para em seguida ser alterado
        if(!empty($dados['nome'])){//caso nome nao estiver vazia
            $produto->setNome($dados['nome']);//altera o nome no banco de dados
        }
        if(!empty($dados['preco'])){//caso preço nao estiver vazia
            $produto->setPreco($dados['preco']);//altera o preço no banco de dados
        }
        if(!empty($dados['quantidade'])){//caso quantidade nao estiver vazia
            $produto->setQuantidade($dados['quantidade']);//altera a quantidade no banco de dados
        }        
        return $this->dao->alterar($produto);//chama o metodo que altera produto no banco
    }
    //metodo para excluir produtos do banco de dados
    public function excluir($id){
        return $this->dao->deletar($id);//chama o metodo que exclui produtos do banco
    }
}
