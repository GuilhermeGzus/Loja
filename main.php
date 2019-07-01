<?php
header("Content-type: text/html; charset=iso-8859-1");//exibir os caracteres especiais

require_once __DIR__ . '/vendor/autoload.php';//funcionar o composer permitindo usar use e namespace

use App\Controle;//semelhante ao import java

$controle = new Controle\Produto();//instanciando controle de produto

//adicionmando produtos ao banco de dados
$controle->criar([
    'nome' => 'Refri',
    'preco' => 5.50,
    'quantidade' => 10,
]);

$controle->criar([
    'nome' => 'Bolacha Bonno de Doce de Leite',
    'preco' => 2,
    'quantidade' => 20,
]);

$controle->criar([
    'nome' => 'Nissim Miojo de Carne',
    'preco' => 1.99,
    'quantidade' => 100,
]);

$produtos = $controle->buscar();//chama o metodo buscar
        
foreach ($produtos as $produto){//percorre cada produto dentro da lista
    //nl2br serve para converter \n em <br>
    echo nl2br("Nome: {$produto->getNome()} "//exibe nome
    . "\n Preço: {$produto->getPreco()} "//exibe preço
    . "\n Quantidade: {$produto->getQuantidade()}"."\n\n");//exibe quantidade
}

$produtos = $controle->filtrar([//chama o metodo filtrar
    'nome' => 'Doce'//filtra por nome "Doce"
]);
        
foreach ($produtos as $produto){//percorre cada produto dentro da lista
    echo "<pre>";//deixar o var dump organizado
    var_dump($produto);//mostra o objeto produto
    echo "<pre>";
}
/*altera o produto de id 4 e apos isso seta os novos dados
$controle->alterar(4,[
    'nome' => 'Nissim Miojo de Frango',
]);
*/
//$controle->excluir(3);//exclui produto de id 3 do banco de dados