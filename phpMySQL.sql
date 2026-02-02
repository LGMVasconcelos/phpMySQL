create database senai;
use senai;

create table alunos (
	id int auto_increment primary key,
    nome varchar(100) not null,
    email varchar(100) not null
);
delete from alunos where id = 2;
select * from alunos;

create table notas (
	id int auto_increment primary key,
    aluno_id int,
    materia varchar(100),
    nota float(2,1),
    data_avaliacao date,
    foreign key (aluno_id) references alunos(id)
);

ALTER TABLE notas MODIFY COLUMN nota DECIMAL(2,1) not null;
ALTER TABLE notas MODIFY COLUMN materia varchar(100) not null;
ALTER TABLE notas MODIFY COLUMN aluno_id int not null;

create table usuario (
	id int auto_increment primary key,
    nome varchar(100) not null,
    email varchar(100) not null,
    senha varchar(100),
    senha_criptografada varbinary(255) not null
);

ALTER TABLE usuario MODIFY COLUMN senha VARCHAR(100) NULL;

set @chave_secreta = 'SenhaUltraForte!123@;.,';

create table remember_tokens (
    id int auto_increment primary key,
    user_id int not null,
    token varchar(255) not null,
    expires datetime not null,
    foreign key (user_id) references usuario(id) on delete cascade
);