<?
include("../inc/core.php");
conecta();
if($_POST["descricao"] != ""){
    $descricao = mysql_real_escape_string($_POST["descricao"]);
    $data = data(mysql_real_escape_string($_POST["data"]),2);
    $ins = mysql_query("INSERT INTO grupos (descricao, data) VALUES ('$descricao', '$data')") or die(mysql_error());
}
if($_POST["excluir"] != ""){
    $id = mysql_real_escape_string($_POST["excluir"]);
    $ins = mysql_query("DELETE FROM grupos WHERE id = '$id'") or die(mysql_error());
}
$sel = mysql_query("SELECT * FROM grupos ORDER BY id DESC") or die(mysql_error());
?>

                                    <table class="table table-hover table-striped">
                                            <thead>
                                                    <tr>
                                                            <th>
                                                                    Grupo
                                                            </th>
                                                            <th>
                                                                    Data
                                                            </th>
                                                            <th>
                                                                    A&ccedil;&atilde;o
                                                            </th>
                                                    </tr>
                                            </thead>
                                            <tbody>
                                            <?
                                            while($r = mysql_fetch_array($sel)){
                                                ?>
                                                <tr>
                                                    <td><?= $r["descricao"] ?></td>
                                                    <td><?= data($r["data"]) ?></td>
                                                    <td><a href="javascript:;" onclick="excluirGrupo('<?= $r["id"] ?>')" class="btn btn-danger"><i class="fa fa-close"></i> excluir</a></td>
                                                </tr>
                                                <?
                                            }
                                            ?>
                                            </tbody>
                                    </table>