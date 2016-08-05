create table pessoas (
    id int(11) auto_increment,
    nome varchar(30),
    sexo int(1),
    bairro int(11),
    fone varchar(50),
    anotacoes text,
    primary key(id)
);

create table bairros (
    id int(11) auto_increment,
    nome varchar(30),
    primary key(id)
);

create table grupos (
    id int(11) auto_increment,
    descricao varchar(30),
    data date,
    primary key(id)
);

create table listadeespera (
    id int(11) auto_increment,
    idpessoa int(11),
    datacadastro datetime,
    urgencia int(1),
    anotacoes text,
    grupo int(11),
    datachamada datetime,
    confirmado int(1),
    naoveio int(1),
    naoconcluiu int(1),
    datadesistencia int(1),
    primary key(id)
);

