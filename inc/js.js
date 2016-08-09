function cadastro(){
    var nome = $("#nome").val();
    var sexo = $("input[name='sexo']:checked").val();
    var fone = $("#fone").val();
    var bairro = $("#bairro").val();
    var urgente = $("input[name='urgente']:checked").val();
    var obs = $("#obs").val();
    $("#mensagem").html("Cadastrando...");
    $("#mensagem").load('scripts/cadastrar.php', {nome: nome, sexo: sexo, fone: fone, bairro: bairro, urgente: urgente, obs: obs});
    $("#nome").val('');
    $("input[name='sexo']").attr('checked',false);
    $("#fone").val('');
    $("#bairro").val('');
    $("input[name='urgente']").attr('checked',false);
    $("#obs").val('');
}

function pagina(div){
    $(".pagina").hide();
    $("#"+div).show();
    $("#linkcadastro").removeClass("active");
    $("#linklista").removeClass("active");
    $("#linkgrupos").removeClass("active");
    $("#link"+div).addClass("active");
    if(div == 'lista'){
    	$(".logo").html("lista de cadastrados");
        $("#divlista").load("scripts/listapcts.php");
    }
    if(div == 'cadastro'){
    	$(".logo").html("novo cadastro");
    }
    if(div == 'grupos'){
    	$(".logo").html("grupos");
    }
}

function edita(campo,id){
    $("#"+id+"_"+campo+"pct").load("scripts/editar.php", {campo:campo, id:id});
}

function salvar(){
    var id = $("#id").val();
    var campo = $("#campo").val();
    var editarcampo = $("#editarcampo").val();
    $("#"+id+"_"+campo+"pct").load("scripts/editar.php", {campo:campo, id:id, editarcampo: editarcampo});
}

function buscar(){
    var termonomepct = $('#termonomepct').val();
    var termo = termonomepct.toUpperCase();
    var div = "lista";
    $(".logo").html("Pesquisa por: "+termo+" <a href='javascript:desfazBusca();'><i class=\"fa fa-close\"></i></a>");
    $(".pagina").hide();
    $("#"+div).show();
    $("#linkcadastro").removeClass("active");
    $("#linklista").removeClass("active");
    $("#link"+div).addClass("active");
    if(termo != ""){
        $( ".linhapct" ).hide();
        $( ".linhapct:contains("+termo+")" ).show();
    }
}

function desfazBusca(){
    $( "#divlista" ).load("scripts/listapcts.php");
    $(".logo").html("lista de cadastrados");
    $('#termonomepct').val('');
}

function cadastroGrupo(){
    var descricao = $("#descricaogrupo").val();
    var data = $("#datagrupo").val();
    $("#listagrupos").html("Salvando...");
    $("#listagrupos").load("scripts/listagrupos.php", {descricao:descricao, data:data});
    $("#descricaogrupo").val('');
    $("#datagrupo").val('');
}

function excluirGrupo(id){
    $("#listagrupos").html("Excluindo...");
    $("#listagrupos").load("scripts/listagrupos.php", {excluir:id});
}

function chamargrupo(id){
    $("#modal-container-249910").html("Carregando...");
    $("#modal-container-249910").load("scripts/chamargrupo.php", {id:id});
}

function incluirEmGrupo(id){
    var div = "lista";
    $(".pagina").hide();
    $("#"+div).show();
    $("#linkcadastro").removeClass("active");
    $("#linklista").removeClass("active");
    $("#link"+div).addClass("active");
    $("#divlista").html("Carregando...");
    var grupo = $("#grupo").val();
    var confirmado = $("#confirmado").val();
    var anotacoes = $("#anotacoes").val();
    var reincluir = $("#reincluir").val();
    $("#divlista").load("scripts/listapcts.php", {id:id, incluir:1, grupo:grupo, confirmado:confirmado, anotacoes:anotacoes, reincluir:reincluir});
}
