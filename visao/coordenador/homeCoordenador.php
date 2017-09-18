<?php
session_start();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<style>
    #container {
        margin-top: 100px;
    }
    
    .custom-file-control:before {
        content: "Procurar";
    }
</style>

<body>
    <div class="container-fluid" id="container">
        <div class="row justify-content-center">
            <div class="col-5">
                <form method="post" action="/controle/logout.php">
                    <div class="form-group row">
                        <h1 class="col-sm-12 col-form-label">Home do Coordenador</h1>
							<br>
							<?php	echo $_SESSION['nomeUsuario'] ?>

                    </div>
                    <input type="submit" class="btn btn-primary btn-lg btn-block" name="botao" value="LogOut">
                </form>
            </div>
        </div>
    </div>

<<<<<<< HEAD
	
=======
    <?php 
        if(!empty($_SESSION)){
            echo $_SESSION['nomeUsuario']+"teste "+$_SESSION['tipoUsuario']+$_SESSION['email']+$_SESSION['matricula']+" fim";
            
            foreach ($_SESSION as $key => $value) {
            print($key.' - '.$value.'<br>');
            };
        }

		foreach ($_COOKIE as $key => $value) {
		print($key.' - '.$value.'<br>');
		};
	
	?>
    Teste atualização
>>>>>>> 3453b1f629d071eae91ac3e68f6f65a2056c173d
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>

</html>