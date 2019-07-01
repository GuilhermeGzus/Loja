<?php
namespace App\Dao;//identificar em qual pacote esta a classe
use App\Modelo;//semelhante ao import java
use App\Persistencia\ConexaoBanco;//semelhante ao import java

class Produto {
    private $conexao = null;//variavel usada para usar apenas uma conexao do banco em todos metodos
    function __construct() {//construtor da classe
        $this->conexao = ConexaoBanco::getInstancia();//busca instancia de conexao banco
    }

    //metodo para cadastrar produto no banco
    public function cadastrar($produto){//passando parametro para cadastro
        try{
            $statement = $this->conexao->prepare("insert into produtos (id,nome,preco,quantidade) values (null,?,?,?);");//insersao no banco
            $statement->bindValue(1, $produto->getNome());//insere nome no banco
            $statement->bindValue(2, $produto->getPreco());//insere preço no banco
            $statement->bindValue(3, $produto->getQuantidade());//insere quantidade no banco
            $statement->execute();//finaliza o comando
        } catch (Exception $ex) {
            echo "Erro".$ex;//echo do erro
        }
    }
    //metodo para filtrar e listar os produtos do banco
    public function listar($filtros=[]){
        try {
            $where = '';//iniciando string para concatenar conforme filtro
            if(!empty($filtros['nome'])){//caso nao estiver vazia
                $where .= "nome like '%{$filtros['nome']}%' ";//aplica o filtro usando like
            }
            
            $query = "select * from produtos";//monta a query p ser executada
            if(!empty($where)){//caso tenha filtro
                $query .= " where {$where}";//concatena na query
            }
            
            $statement = $this->conexao->query($query);//executa a query
            return $statement->fetchAll(\PDO::FETCH_CLASS, Modelo\Produto::class);//pega o retorno da query formatando em cada classe do produto
        } catch (PDOException $ex) {
            echo 'Erro ao filtrar! '.$ex;//echo do erro
        }
    }
    //metodo para buscar produto por id
    public function buscarPorId($id){
        try {          
            $statement = $this->conexao->prepare("select * from produtos where id = ?");//monta a query para fazer a busca dentro do banco
            $statement->bindValue(1, $id);//seleciona a id para ser buscada
            $statement->execute();//finaliza o comando
            $statement->setFetchMode(\PDO::FETCH_CLASS, Modelo\Produto::class);//seta o modo que o retorno do banco sera tratado
            return $statement->fetch(\PDO::FETCH_CLASS);//pega o retorno da query formatando em cada classe do produto
        } catch (PDOException $ex) {
            echo 'Erro ao filtrar! '.$ex;//echo do erro
        }
    }

    //metodo para alterar algum produto no banco de dados
    public function alterar($produto){
         try {
            $statement = $this->conexao->prepare("update produtos set nome = ?,preco = ?, quantidade = ? where id = ?");//monta a query para fazer update dentro do banco
            $statement->bindValue(1, $produto->getNome());//seta o novo nome
            $statement->bindValue(2, $produto->getPreco());//seta o novo preço
            $statement->bindValue(3, $produto->getQuantidade());//seta nova quantidade
            $statement->bindValue(4, $produto->getId());//seta o id do where
            $statement->execute();//finaliza o comando
        } catch (PDOException $exc) {
            echo 'Erro ao alterar!' . $exc;//echo do erro
        }
    }
    
    //metodo para deletar algum produto no banco de dados
    public function deletar($id){
        try {
            $statement = $this->conexao->prepare("delete from produtos where id = ?");//monta a query para fazer a remoçao de um produto no banco de dados
            $statement->bindValue(1, $id);//seta o id para ser removido
            $statement->execute();//finaliza o comando
            
        } catch (PDOException $ex) {
            echo 'Erro ao deletar! '.$ex;//echo erro
        }
    }   

}
