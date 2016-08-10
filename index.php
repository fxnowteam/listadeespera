<?
/**
 * @name listadeespera
 * @author Original by Tiago Floriano <tiagofloriano@gmail.com> <http://paico.github.io/>
 * @author Modified by nome <email ou URI> aaaa-mm-dd hh:mm  //para os próximos que modificarem
 * @license GPL
 * @license https://www.gnu.org/licenses/gpl-3.0.html GNU Public License
 *
 * Script simples para gestão de fila de espera. 
 * Exemplo: uma instituição faz periodicamente um curso de capacitação. Esta instituição pode usar este script para cadastrar os interessados. Sempre que um curso for concluído e for aberto um novo, pode-se cadastrar este curso no script e incluir as pessoas que estão aguardando dentro deste novo curso.
 */
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
	<body onload="$('#lista').load('scripts/listapcts.php'); $('#listagrupos').load('scripts/listagrupos.php'); $('#nome').focus();">
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
                                                            <li id="linkgrupos">
                                                                    <a href="#" onclick="pagina('grupos')">Grupos</a>
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
                                                    <form class="navbar-form navbar-left" role="search" onsubmit="return false;">
                                                            <div class="form-group">
                                                                <input class="form-control" type="search" placeholder="Nome do paciente" id="termonomepct" onsearch="buscar()" />
                                                            </div> 
                                                            <button type="submit" class="btn btn-default" onclick="buscar()">
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
                            <div class="col-md-12" id="divlista">
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
                                                    $selPessoa = mysql_query("SELECT * FROM pessoas WHERE chave = '".$r["pessoa"]."'") or die(mysql_error());
                                                    $y = mysql_fetch_array($selPessoa);
                                                    if($r["grupo"] == ""){
                                                        $contador = $contador+1;
                                                        $style = "";
                                                        $labelcontador = $contador;
                                                    }else{
                                                        $style = " style=\"display: none\"";
                                                        $labelcontador = "j&aacute; chamado";
                                                    }
                                                ?>
                                                    <tr class="linhapct"<?= $style ?>>
                                                            <td>
                                                                   [<?= $labelcontador ?>]
                                                            </td>
                                                            <td>
                                                                    <?
                                                                    echo date("d/m/Y, H:i:s",strtotime($r["datacadastro"]));
                                                                    ?>
                                                            </td>
                                                            <td id="<?= $y["id"] ?>_nomepct" class="nomedopaciente">
                                                                    <a href="javascript:;" onclick="edita('nome', <?= $y["id"] ?>)"><?= strtoupper($y["nome"]) ?></a>
                                                            </td>
                                                            <td id="<?= $y["id"] ?>_fonepct">
                                                                    <a href="javascript:;" onclick="edita('fone', <?= $y["id"] ?>)"><?= $y["fone"] ?></a>
                                                            </td>
                                                            <td id="<?= $y["id"] ?>_anotacoespct">
                                                                    <?
                                                                    if($r["anotacoes"] == ""){
                                                                        $anotacao = "Nenhuma anota&ccedil;&atilde;o.";
                                                                    }else{
                                                                        $anotacao = $r["anotacoes"];
                                                                    }
                                                                    ?>
                                                                    <a href="javascript:;" onclick="edita('anotacoes', <?= $y["id"] ?>)"><?= $anotacao ?></a>
                                                            </td>
                                                            <td>
                                                                    <?
                                                                    if($r["grupo"] == ""){
                                                                        ?><a class="btn btn-success" id="modal-249910" href="#modal-container-249910" role="button" data-toggle="modal" onclick="chamargrupo('<?= $r["id"] ?>')">Incluir em grupo</a><?
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
                                                                    <input type="text" class="form-control fone" id="fone" class="telefone" placeholder="telefones para contato" required>
                                                            </div>

                                                            <div class="form-group">
                                                                    <label for="reg_fullname" class="sr-only">bairro</label>
                                                                    <input type="text" class="form-control" id="bairro" placeholder="bairro" required>
                                                            </div>

                                                            <div class="form-group login-group-checkbox">
                                                                    <input type="radio" class="" id="naourgente" value="0" name="urgente" checked>
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
                <div id="grupos" class="pagina" style="display: none">
                    <div class="text-center">
                            <div class="logo">grupos</div>
                            <div class="login-form-1">
                                    <form id="register-form" class="text-left">
                                            <div class="login-form-main-message"></div>
                                            <div class="main-login-form">
                                                    <div class="login-group">
                                                            <div class="form-group">
                                                                    <label for="descricaogrupo" class="sr-only">descri&ccedil;&atilde;o</label>
                                                                    <input type="text" class="form-control" id="descricaogrupo" placeholder="descri&ccedil;&atilde;o" required>
                                                            </div>

                                                            <div class="form-group">
                                                                    <label for="datagrupo" class="sr-only">data</label>
                                                                    <input type="text" class="form-control" id="datagrupo" placeholder="data">
                                                            </div>
                                                    </div>
                                                <a id="modal-249909" href="#modal-container-249909" role="button" class="login-button" data-toggle="modal" onclick="cadastroGrupo()"><i class="fa fa-chevron-right" style="padding-left: 15px;"></i></a>
                                            </div>
                                    </form>
                            </div>
                    </div>
                    <div id='listagrupos'>

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
                       $("#datagrupo").mask("99/99/9999");
                });
            </script>
			<div class="modal fade" id="modal-container-249908" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							 
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="$('#nome').focus()">
                                                            &Cross;
							</button>
							<h4 class="modal-title" id="myModalLabel">
								Lista de espera
							</h4>
						</div>
						<div class="modal-body" id="mensagem">
                                                    
						</div>
						<div class="modal-footer">
							 
							<button type="button" class="btn btn-default" data-dismiss="modal" onclick="$('#nome').focus()">
								Fechar
							</button> 
						</div>
					</div>
					
				</div>
				
			</div>
			<div class="modal fade" id="modal-container-249909" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							 
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                                                            &Cross;
							</button>
							<h4 class="modal-title" id="myModalLabel">
								Cadastro de grupo
							</h4>
						</div>
						<div class="modal-body" id="mensagem">
                                                    Grupo cadastrado!
						</div>
						<div class="modal-footer">
							 
							<button type="button" class="btn btn-default" data-dismiss="modal">
								Fechar
							</button> 
						</div>
					</div>
					
				</div>
				
			</div>
			<div class="modal fade" id="modal-container-249910" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				
			</div>
	</body>
</html>
