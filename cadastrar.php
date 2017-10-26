<html>
	<body>
		<a href="/pi/menu">Voltar</a> 
		<a href ="/pi/user">Usuario</a>
		<a href ="/pi/cat">Categoria</a>
		Produto 
		<a href="/?logout=1">Sair</a>
		<br><br>
		
		

		<br>
		<?php
include('../db/bancodedados.php');
include('../auth/controle.php');

//Funcionalidade Gravar Cadastro
if(isset($_POST['btnGravar'])){
	unset($_GET['cadastrar']);
	if(	!empty($_POST['loginUsuario']) &&
		!empty($_POST['nomeUsuario']) &&
		!empty($_POST['senhaUsuario'])){
		
		$_POST['usuarioAtivo'] = 
			isset($_POST['usuarioAtivo']) ? true : false;
		
		$stmt = odbc_prepare($db, "	INSERT INTO Usuario
									(loginUsuario,
									nomeUsuario,
									senhaUsuario,
									tipoPerfil,
									usuarioAtivo)
									VALUES
									(?,?,?,?,?)");
		if(odbc_execute($stmt, array(	$_POST['loginUsuario'],
										$_POST['nomeUsuario'],
										$_POST['senhaUsuario'],
										$_POST['perfilUsuario'],
										$_POST['usuarioAtivo']))){
			$msg = 'Usuário gravado com sucesso!';			
		}else{
			$erro = 'Erro ao gravar o usuário';
		}								
							
	}else{
		
		$erro = 'Os campos: Login, Nome e Senha 
					são obrigatórios';
		
	}
}
//FIM Funcionalidade Gravar Cadastro
?>		
		<form method="post">
		
			Nome: <input type="text" name="nomeCategoria"><br><br>
			Descrição: <input type="text" name="descCategoria"><br><br>
			Quantidade: <input type="text" name="QtdProdutoDisponivel"><br><br>
			
					</select><br><br>
			
			<input type="submit" value="Gravar" name="btnGravar">
		
		</form>
		
	</body>
</html>