<?
$obj_mysqli = new mysqli("127.0.0.1", "root", "", "tutocrudphp");
 
if ($obj_mysqli->connect_errno)
{
	echo "Ocorreu um erro na conexão com o banco de dados.";
	exit;
}
 
mysqli_set_charset($obj_mysqli, 'utf8');
 
//Incluímos um código aqui...
$idproduto  = -1;]
$nome     	= -1;
$categoria  = "";
$quantidade = "";

 
//Validando a existência dos dados
if(isset($_POST["nome"]) && isset($_POST["categoria"]) && isset($_POST["quantidade"])))

	if(empty($_POST["nome"]))
		$erro = "Campo obrigatório";
	else
	if(empty($_POST["quantidade"]))
		$erro = "Campo obrigatório";
	else
	{
		//Alteramos aqui também.
		//Agora, o $id, pode vir com o valor -1, que nos indica novo registro, 
		//ou, vir com um valor diferente de -1, ou seja, 
                //o código do registro no banco, que nos indica alteração dos dados.
		$idproduto     = $_POST["idproduto"];		
		$nome   = $_POST["nome"];
		$categoria  = $_POST["categoria"];
		$quantidade = $_POST["quantidade"];
				
		//Se o id for -1, vamos realizar o cadastro ou alteração dos dados enviados.
		if($id == -1)
		{
			$stmt = $obj_mysqli->prepare("INSERT INTO `cliente` (`nome`,`categoria`,`quantidade`) VALUES (?,?,?)");
			$stmt->bind_param('ssss', $nome, $categoria, $quantidade);	
		
			if(!$stmt->execute())
			{
				$erro = $stmt->error;
			}
			else
			{
				//colocar o nome do arquivo
				header("Location:cadastro.php");
				exit;
			}
		}
		//se não, vamos realizar a alteraçao dos dados,
                //porém, vamos nos certificar que o valor passado no $id, seja válido para nosso caso.
		else
		if(is_numeric($id) && $id >= 1)
		{
			$stmt = $obj_mysqli->prepare("UPDATE `cliente` SET `nome`=?, `categoria`=?, `quantidade`=?");
			$stmt->bind_param('ssssi', $nome, $categoria, $quantidade, $idproduto);
		
			if(!$stmt->execute())
			{
				$erro = $stmt->error;
			}
			else
			{
				//colocar o nome do arquivo
				header("Location:cadastro.php");
				exit;
			}
		}
		//retorna um erro.
		else
		{
			$erro = "Número inválido";
		}
	}
}
else
//Incluimos este bloco, onde vamos verificar a existência do id passado...
if(isset($_GET["idproduto"]) && is_numeric($_GET["idproduto"]))
{
        //..,pegamos aqui o id passado...
	$id = (int)$_GET["idproduto"];
	
        //...montamos a consulta que será realizada....
	$stmt = $obj_mysqli->prepare("SELECT * FROM `cliente` WHERE id = ?"); //
        //passamos o id como parâmetro, do tipo i = int, inteiro...
	$stmt->bind_param('i', $id);
        //...mandamos executar a consulta...
	$stmt->execute();
	//...retornamos o resultado, e atribuímos à variável $result...
	$result = $stmt->get_result();
        //...atribuímos o retorno, como um array de valores,
        //por meio do método fetch_assoc, que realiza um associação dos valores em forma de array...
        $aux_query = $result->fetch_assoc();
	//...onde aqui, nós atribuímos às variáveis.
	$nome = $aux_query["Nome"];
	$categoria = $aux_query["categoria"];
	$quantidade = $aux_query["quantidade"];
 
	$stmt->close();
}
 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
	<title>CRUD com PHP, de forma simples e fácil</title>
  </head>
  <body>
    <?
	if(isset($erro))
		echo '<div style="color:#F00">'.$erro.'</div><br/><br/>';
	else
	if(isset($sucesso))
		echo '<div style="color:#00f">'.$sucesso.'</div><br/><br/>';
	
	?>
	<form action="<?=$_SERVER["PHP_SELF"]?>" method="POST">
	  Nome:<br/> 
	  <input type="text" name="nome" placeholder="Qual seu nome?" value="<?=$nome?>"><br/><br/>
	  Categoria:<br/> 
	  <input type="email" name="categoria" placeholder="Qual a categoria?" value="<?=$categoria?>"><br/><br/>
	  Estoque:<br/> 
	  <input type="text" name="quantidade" placeholder="Qual a quantidade?" value="<?=$quantidade?>"><br/><br/>
	  <input type="hidden" value="<?=$id?>" name="id" >
          <!--Alteramos aqui também, para poder mostrar o texto Cadastrar, ou Salvar, de acordo com o momento. :)-->
	  <button type="submit"><?=($idproduto==-1)?"Cadastrar":"Salvar"?></button>
	</form>
	<br>
	<br>
	<table width="400px" border="0" cellspacing="0">
	  <tr>
	    <td><strong>#</strong></td>
	    <td><strong>Nome</strong></td>
	    <td><strong>Categoria</strong></td>
	    <td><strong>Estoque</strong></td>
	    <td><strong>#</strong></td>
	  </tr>
	<?
	$result = $obj_mysqli->query("SELECT * FROM `categoria`");
	while ($aux_query = $result->fetch_assoc()) 
    {
	  echo '<tr>';
	  echo '  <td>'.$aux_query["Idproduto"].'</td>';
	  echo '  <td>'.$aux_query["Nome"].'</td>';
	  echo '  <td>'.$aux_query["categoria"].'</td>';
	  echo '  <td>'.$aux_query["quantidade"].'</td>';
	  echo '  <td><a href="'.$_SERVER["PHP_SELF"].'?idproduto='.$aux_query["Idproduto"].'">Editar</a></td>';
	  echo '</tr>';
	}
	?>
	</table>
  </body>
</html>