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
    	$ins = mysql_query("INSERT INTO listadeespera (pessoa, datacadastro, urgencia, anotacoes) VALUES ('".$l["pessoa"]."', '".date("Y-m-d H:i:s")."', '".$l["urgencia"]."', '".$l["anotacoes"]." - reincluido na lista de espera.')") or die(mysql_error());
    }
    ?>

			<div class="alert alert-success alert-dismissable">
                            <center>Situa&ccedil;&atilde;o atualizada!</center>
			</div>
		</div>
    <?
}
?>
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
                                                    if($r["grupo"] == "" or $r["grupo"] == 0){
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
                                                                    <?
                                                                    if($r["grupo"] == ""){
                                                                        ?><a class="btn btn-success" id="modal-249910" href="#modal-container-249910" role="button" data-toggle="modal" onclick="chamargrupo('<?= $r["id"] ?>')">Incluir em grupo</a><?
                                                                    }else{
                                                                        ?><a class="btn btn-success" id="modal-249910" href="#modal-container-249910" role="button" data-toggle="modal" onclick="chamargrupo('<?= $r["id"] ?>')">Refazer grupo</a><?
                                                                    }
                                                                    ?>
                                                            </td>
                                                    </tr>
                                                    <?
                                                }
                                                    ?>
                                            </tbody>
                                    </table>
