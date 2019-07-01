<?php

namespace App\Modelo; //identificar em qual pacote esta a classe

class Produto {

//atributos
    private $id;
    private $nome;
    private $preco;
    private $quantidade;

//getter e setter obs: depois de gerar colocar public na frente de tudo
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getPreco() {
        return $this->preco;
    }

    function getQuantidade() {
        return $this->quantidade;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    function setPreco($preco) {
        $this->preco = $preco;
        return $this;
    }

    function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
        return $this;
    }

}
