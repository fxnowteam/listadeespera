<?
include("../inc/core.php");
conecta();
if($_POST["id"] != ""){
    if($_POST["editarcampo"] == ""){
        $id = mysql_real_escape_string($_POST["id"]);
        $campo = mysql_real_escape_string($_POST["campo"]);
        if($campo == "anotacoes"){
            $tabela = "listadeespera";
        }else{
            $tabela = "pessoas";
        }
        if($campo == "fone"){
            $class = " class=\"fone\"";
        }
        $sel = mysql_query("SELECT * FROM $tabela WHERE id = '$id'") or die(mysql_error());
        $r = mysql_fetch_array($sel);
        echo "<input type=\"text\" id=\"editarcampo\" value=\"{$r[$campo]}\"$class> <a href=\"javascript:;\" onclick=\"salvar()\" class=\"btn btn-info\"><i class=\"fa fa-floppy-o\"></i> Salvar</a>";
        echo "<input type=\"hidden\" id=\"id\" value=\"$id\">";
        echo "<input type=\"hidden\" id=\"campo\" value=\"$campo\">";
    }else{
        $id = mysql_real_escape_string($_POST["id"]);
        $campo = mysql_real_escape_string($_POST["campo"]);
        $editarcampo = mysql_real_escape_string($_POST["editarcampo"]);
        if($campo == "anotacoes"){
            $tabela = "listadeespera";
        }else{
            $tabela = "pessoas";
        }
        $upd = mysql_query("UPDATE $tabela SET $campo = '$editarcampo' WHERE id = '$id'") or die(mysql_error());
        echo "<a href=\"javascript:;\" onclick=\"edita('$campo', $id)\" class=\"linklistapcts\">$editarcampo</a>";
    }
}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> 
<script src="inc/mask.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
           $(".fone").mask("(99) 9999-9999");
    });
</script>