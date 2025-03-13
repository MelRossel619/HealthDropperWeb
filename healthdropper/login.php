<?php
	
	require('config.php');

    session_start();
    
    $user = stripslashes(trim($_POST['usuario']));
    $pass = stripslashes(trim($_POST['clave']));
    
    $stmt = $link->prepare('SELECT * FROM usuarios WHERE usuario= ?');
    $stmt->bind_param('s', $user);
    $stmt->execute();
    $sql = $stmt->get_result();

		if ($sql->num_rows > 0) {
		    $data = $sql->fetch_array();
		 //if (password_verify($pass, trim($data['contrasena']))) {
		  if(trim($pass)==trim($data['contrasena'])){
		        $_SESSION['cargo'] = $data['cargo'];
		        $_SESSION['nombre'] = $data['nombre'];
		        $_SESSION['usuario'] = $data['usuario'];
				header('Location: Central.html');
            } 
		 else{
			
		
			header("location: LogHD.html");}
		 
        }
        else{
			
			header("location: LogHD.html");}
if(!isset($_SESSION['cargo'])){
		
header("location: LogHD.html");

}    
?>
