<?
include("../inc/core.php");
conecta();
if($_POST["nome"] != ""){
    $nome = mysql_real_escape_string($_POST["nome"]);
    $chave = hash('sha512',date("Y-m-d H:i:s").$nome);
    $sexo = mysql_real_escape_string($_POST["sexo"]);
    $fone = mysql_real_escape_string($_POST["fone"]);
    $bairro = mysql_real_escape_string($_POST["bairro"]);
    $urgente = mysql_real_escape_string($_POST["urgente"]);
    $obs = mysql_real_escape_string($_POST["obs"]);
    $ins = mysql_query("INSERT INTO pessoas (chave, nome, sexo, bairro, fone) VALUES ('$chave', '$nome', '$sexo', '$bairro', '$fone')") or die(mysql_error());
    $ins = mysql_query("INSERT INTO listadeespera (pessoa, datacadastro, urgencia, anotacoes) VALUES ('$chave', '".date("Y-m-d H:i:s")."', '$urgente', '$obs')") or die(mysql_error());
    echo "Paciente cadastrado com sucesso!"; 
}