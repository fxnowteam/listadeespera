<?
include("../inc/core.php");
conecta();
if($_POST["incluir"] == "1"){
    $id = mysql_real_escape_string($_POST["id"]);
    $grupo = mysql_real_escape_string($_POST["grupo"]);
    $confirmado = mysql_real_escape_string($_POST["confirmado"]);
    $anotacoes = mysql_real_escape_string($_POST["anotacoes"]);
    $reincluir = mysql_real_escape_string($_POST["reincluir"]);
    $upd = mysql_query("UPDATE listadeespera SET anotacoes = '$anotacoes', grupo = '$grupo', datachamada = '".date("Y-m-d H:i:s")."', confirmado = '$confirmado' WHERE id = '$id'") or die(mysql_error());
    if($reincluir == 1){
    	$sel = mysql_query("SELECT * FROM listadeespera WHERE id = '$id'") or die(mysql_error());
    	$l = mysql_fetch_array($sel);
    	$ins = mysql_query("INSERT INTO listadeespera (pessoa, datacadastro, urgencia, anotacoes, status) VALUES ('".$l["pessoa"]."', '".date("Y-m-d H:i:s")."', '".$l["urgencia"]."', '".$l["anotacoes"]." - reincluido na lista de espera.', '1')") or die(mysql_error());
    }
    ?>

			<div class="alert alert-success alert-dismissable">
                            <center>Situa&ccedil;&atilde;o atualizada!</center>
			</div>
		</div>
    <?
}

$grupo = mysql_real_escape_string($_POST["grupo"]);

if($_POST["excluir"] != ""){
    $id = mysql_real_escape_string($_POST["excluir"]);
    if($_POST["desfaz"] == 1){
    	$status = 1;
    	$msg = "Exclus&atilde;o desfeita!";
    }else{
    	$status = 0;
    	$msg = "Cadastro apagado! <br><a href=\"javascript:desfazExcluirCadastro('$id', '$grupo');\">Desfazer?</a>";
    }
    $upd = mysql_query("UPDATE listadeespera SET status = '$status' WHERE id = '$id'") or die(mysql_error());
    ?>

			<div class="alert alert-success alert-dismissable">
                            <center><?= $msg ?></center>
			</div>
		</div>
    <?
}
?>
                                    <table class="table table-hover table-striped">
                                            <thead>
                                                    <tr>
                                                            <th class="col-md-1">
                                                                    Ficha
                                                            </th>
                                                            <th class="col-md-2">
                                                                    Data de inscri&ccedil;&atilde;o
                                                            </th>
                                                            <th class="col-md-3">
                                                                    Nome
                                                            </th>
                                                            <th class="col-md-1">
                                                                    Telefone
                                                            </th>
                                                            <th class="col-md-4">
                                                                    Observa&ccedil;&otilde;es
                                                            </thgrupo>
                                                            <th class="col-md-1">
                                                                    Grupo
                                                            </th>
                                                    </tr>
                                            </thead>
                                            <tbody>
                                                <?
                                                $contador = 0;
                                                if($grupo != ""){
                                                	$where = " and grupo = '$grupo' and confirmado = '1'";
                                                }
                                                $sel = mysql_query("SELECT * FROM listadeespera WHERE status = '1' $where ORDER BY urgencia DESC, id ASC") or die(mysql_error());
                                                while($r = mysql_fetch_array($sel)){
                                                    $selPessoa = mysql_query("SELECT * FROM pessoas WHERE chave = '".$r["pessoa"]."'") or die(mysql_error());
                                                    $y = mysql_fetch_array($selPessoa);
                                                    if($r["grupo"] == "" or $r["grupo"] == 0){
                                                        $contador = $contador+1;
                                                        $style = "";
                                                        $labelcontador = $contador;
                                                    }else{
                                                    	if($grupo == ""){
        	                                                $style = " style=\"display: none\"";
	                                                }
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
                                                            <td id="<?= $y["id"] ?>_nomepct">
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
								<div class="btn-group">
									 
									<button class="btn btn-default">
										Op&ccedil;&otilde;es
									</button> 
									<button data-toggle="dropdown" class="btn btn-default dropdown-toggle">
										<span class="caret"></span>
									</button>
									<ul class="dropdown-menu">
										<li>
					                                            <?
					                                            if($r["grupo"] == ""){
					                                                ?><a id="modal-249910" href="#modal-container-249910" role="button" data-toggle="modal" onclick="chamargrupo('<?= $r["id"] ?>')">Incluir em grupo</a><?
					                                            }else{
					                                                ?><a id="modal-249910" href="#modal-container-249910" role="button" data-toggle="modal" onclick="chamargrupo('<?= $r["id"] ?>')">Refazer grupo</a><?
					                                            }
					                                            ?>
										</li>
										<li>
											<a href="javascript:excluirCadastro('<?= $r["id"] ?>', '<?= $r["grupo"] ?>');">Excluir cadastro</a>
										</li>
									</ul>
								</div>

                                                                    
                                                            </td>
                                                    </tr>
                                                    <?
                                                }
                                                    ?>
                                            </tbody>
                                    </table>
