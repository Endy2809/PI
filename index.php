<?php
include('../db/bancodedados.php');
include('../auth/controle.php');

//Funcionalidade Listar
$q = odbc_exec($db, 'SELECT idCategoria, nomeCategoria, descCategoria FROM Categoria');

while($r = odbc_fetch_array($q)){
	
	$categoria[$r['idCategoria']] = $r;
	
}
//FIM Funcionalidade Listar

?>
<html>
<head>
<meta charset="UTF-8">
</head>
	<body>
	
		<a href="/pi/menu">Voltar</a> 
		<a href = "/pi/user">Usuario</a>

		<a href = "/pi/cat">Categoria</a>
		Produto 
		<a href="/?logout=1">Sair</a>
		<br><br>
		<a href="?cadastrar=1">+ Categoria</a>
		<br>
		<br>
		<table>
			<tr>
				<th>ID</th>
				<th>Nome</th>
				<th>Descrição</th>
				<th>Editar</th>
				<th>Excluir</th>
			</tr>
			<?php
			if(is_array($categoria)){
				foreach($categoria as $idCategoria => $dadosCategoria){
					
					echo "	<tr>
								<td>{$dadosCategoria['idCategoria']}</td>
								<td>{$dadosCategoria['nomeCategoria']}</td>
								<td>{$dadosCategoria['descCategoria']}</td>
								<td><a href='?editar=$idCategoria'>e</a></td>
								<td><a href='?excluir=$idCategoria'>x</a></td>
							</tr>";
					
				}
			}else{
				echo "	<tr>
								<td colspan='6'>N&atilde;o h&aacute; registros</td>
							</tr>";
			}
			?>
		</table>
	</body>
</html>