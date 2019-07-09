create database fixit;

use fixit;


create table cliente(
    login varchar(50) primary key,
    senha varchar(20),
    nome varchar(250) not null,
    sobrenome varchar(250) not null,
    email varchar(50) not null,
    endereco varchar(255) not null,
    bairro varchar(200) not null,
    estado varchar(20) not null,
    cidade varchar(255) not null,
    cep varchar(8) not null,
    telefone varchar(11),
    celular varchar(11) not null,
    caminho_foto varchar(100) not null
);
