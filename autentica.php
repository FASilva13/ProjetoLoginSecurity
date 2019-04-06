<?php
	if(isset($_POST['usuario']) && isset($_POST['senha'])){
		
		$conn= new PDO("mysql:host=localhost;dbname=controle_financas", "root", "");
		$stmt = $conn->prepare("select * from autenticacao where usuario=:u and senha=:s");

		$stmt->bindValue(":u", $_POST['usuario']);
		$stmt->bindValue(":s", sha1(md5($_POST['senha'])));
		$stmt->execute();
		if($stmt->rowCount()==1){
			session_start();
			$_SESSION['usuario']=$_POST['usuario'];
			header("Location:index.php");
		}else{
			echo "<p>Usuário ou senha inválido!</p>";
			echo "<p><a href='login.php'>Tentar novamente</a></p>";
		}
		
	}else{
		echo "<p>Usuário ou senha não preenchido!</p>";
		echo "<p><a href='login.php'>Tentar novamente</a></p>";
	}
	
?>