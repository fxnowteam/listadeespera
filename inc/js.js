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
    $("#link"+div).addClass("active");
}