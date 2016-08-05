<?
include("inc/core.php");
conecta();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<link rel="shortcut icon" type="image/png" href="img/icone.ico" />
		<title>Lista de espera</title>
		
		<script src="inc/jquery.js"></script>
		<script src="inc/bootstrap.js"></script>
		<script src="inc/js.js"></script>
		<link rel="stylesheet" type="text/css" href="inc/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="inc/font-awesome.css">
		<link rel="stylesheet" type="text/css" href="inc/css.css">
	</head>
	<body>
            <div class="container-fluid"><br>
                    <div class="row">
                            <div class="col-md-12">
                                    <nav class="navbar navbar-default" role="navigation">
                                            <div class="navbar-header">

                                                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                                             <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
                                                    </button> <a class="navbar-brand" href="#">Lista de espera</a>
                                            </div>

                                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                                    <ul class="nav navbar-nav">
                                                            <li id="linkcadastro" class="active">
                                                                    <a href="#" onclick="pagina('cadastro')">Cadastro</a>
                                                            </li>
                                                            <li id="linklista">
                                                                    <a href="#" onclick="pagina('lista')">Ver lista</a>
                                                            </li>
                                                            <li class="dropdown">
                                                                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">Relat&oacute;rios<strong class="caret"></strong></a>
                                                                    <ul class="dropdown-menu">
                                                                            <li>
                                                                                    <a href="#">Por grupo</a>
                                                                            </li>
                                                                            <li>
                                                                                    <a href="#">Por pessoas contactadas</a>
                                                                            </li>
                                                                            <li>
                                                                                    <a href="#">Por bairro</a>
                                                                            </li>
                                                                            <li>
                                                                                    <a href="#">Por g&ecirc;nero</a>
                                                                            </li>
                                                                    </ul>
                                                            </li>
                                                    </ul>
                                                    <form class="navbar-form navbar-left" role="search">
                                                            <div class="form-group">
                                                                <input class="form-control" type="text" placeholder="Nome do paciente" />
                                                            </div> 
                                                            <button type="submit" class="btn btn-default">
                                                                    Procurar
                                                            </button>
                                                    </form>
                                            </div>

                                    </nav>
                            </div>
                    </div>
                
                <div id="lista" class="pagina" style="display: none">
                    <div class="text-center">
                            <div class="logo">lista de cadastrados</div>
                    </div>
                    
                    <div class="row">
                            <div class="col-md-12">
                                    <table class="table table-hover table-striped">
                                            <thead>
                                                    <tr>
                                                            <th>
                                                                    Ficha
                                                            </th>
                                                            <th>
                                                                    Data de inscri&ccedil;&atilde;o
                                                            </th>
                                                            <th>
                                                                    Nome
                                                            </th>
                                                            <th>
                                                                    Telefone
                                                            </th>
                                                            <th>
                                                                    Observa&ccedil;&otilde;es
                                                            </th>
                                                            <th>
                                                                    Grupo
                                                            </th>
                                                    </tr>
                                            </thead>
                                            <tbody>
                                                <?
                                                $contador = 0;
                                                $sel = mysql_query("SELECT * FROM listadeespera ORDER BY urgencia DESC, id ASC") or die(mysql_error());
                                                while($r = mysql_fetch_array($sel)){
                                                    $contador = $contador+1;
                                                    $selPessoa = mysql_query("SELECT * FROM pessoas WHERE chave = '".$r["pessoa"]."'") or die(mysql_error());
                                                    $y = mysql_fetch_array($selPessoa);
                                                ?>
                                                    <tr>
                                                            <td>
                                                                   [ <?= $contador ?> ]
                                                            </td>
                                                            <td>
                                                                    <?
                                                                    echo date("d/m/Y, H:i:s",strtotime($r["datacadastro"]));
                                                                    ?>
                                                            </td>
                                                            <td>
                                                                    <?= $y["nome"] ?>
                                                            </td>
                                                            <td>
                                                                    <?= $y["fone"] ?>
                                                            </td>
                                                            <td>
                                                                    <?= $r["anotacoes"] ?>
                                                            </td>
                                                            <td>
                                                                    <?
                                                                    if($r["grupo"] == ""){
                                                                        ?><a href="javascript:;" onclick="incluirGrupo('<?= $r["id"] ?>')" class="btn btn-success">Incluir em grupo</a><?
                                                                    }
                                                                    ?>
                                                            </td>
                                                    </tr>
                                                    <?
                                                }
                                                    ?>
                                            </tbody>
                                    </table>
                            </div>
                    </div>
                </div>
                
                <div id="cadastro" class="pagina">
                    <div class="text-center">
                            <div class="logo">novo cadastro</div>
                            <!-- Main Form -->
                            <div class="login-form-1">
                                    <form id="register-form" class="text-left">
                                            <div class="login-form-main-message"></div>
                                            <div class="main-login-form">
                                                    <div class="login-group">
                                                            <div class="form-group">
                                                                    <label for="reg_username" class="sr-only">nome</label>
                                                                    <input type="text" class="form-control" id="nome" placeholder="nome" required>
                                                            </div>

                                                            <div class="form-group login-group-checkbox">
                                                                    <input type="radio" class="" name="sexo" id="female" value="0">
                                                                    <label for="female">feminino</label>

                                                                    <input type="radio" class="" name="sexo" id="male" value="1">
                                                                    <label for="male">masculino</label>
                                                            </div>

                                                            <div class="form-group">
                                                                    <label for="reg_fullname" class="sr-only">telefones para contato</label>
                                                                    <input type="text" class="form-control" id="fone" placeholder="telefones para contato" required>
                                                            </div>

                                                            <div class="form-group">
                                                                    <label for="reg_fullname" class="sr-only">bairro</label>
                                                                    <input type="text" class="form-control" id="bairro" placeholder="bairro" required>
                                                            </div>

                                                            <div class="form-group login-group-checkbox">
                                                                    <input type="radio" class="" id="naourgente" value="0" name="urgente">
                                                                    <label for="naourgente">n&atilde;o urgente</label>

                                                                    <input type="radio" class="" id="urgente" value="1" name="urgente">
                                                                    <label for="urgente">urgente</label>
                                                            </div>

                                                            <div class="form-group">
                                                                    <label for="reg_fullname" class="sr-only">observa&ccedil;&otilde;es</label>
                                                                    <input type="text" class="form-control" id="obs" placeholder="observa&ccedil;&otilde;es">
                                                            </div>
                                                    </div>
                                                <a id="modal-249908" href="#modal-container-249908" role="button" class="login-button" data-toggle="modal" onclick="cadastro()"><i class="fa fa-chevron-right" style="padding-left: 15px;"></i></a>
                                            </div>
                                    </form>
                            </div>
                            <!-- end:Main Form -->
                    </div>

                    
                </div>
            </div>
            <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
            <link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> 
            <script src="inc/mask.js"></script>
            <script type="text/javascript">
                $(document).ready(function(){
                       $("#fone").mask("(99) 9999-9999");
                });
            </script>
            
			<div class="modal fade" id="modal-container-249908" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							 
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                            &Cross;
							</button>
							<h4 class="modal-title" id="myModalLabel">
								Lista de espera
							</h4>
						</div>
						<div class="modal-body" id="mensagem">
                                                    
						</div>
						<div class="modal-footer">
							 
							<button type="button" class="btn btn-default" data-dismiss="modal">
								Fechar
							</button> 
						</div>
					</div>
					
				</div>
				
			</div>
	</body>
</html>