create table tblPerfil
(
    id_perfil INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    usuario varchar(100),
    bio varchar(255),
    senha varchar(50)
);

create table tblComunidade
(
    id_comunidade INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome varchar(100),
    tema varchar(50),
    descricao varchar(255)
);

create table tblPerfisDaComunidade
(
    perfil INTEGER NOT NULL,
    comunidade INTEGER NOT NULL,
    primary key(perfil, comunidade)
);

create table tblPost
(
    id_post INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    texto varchar(500),
    perfil integer NOT NULL,
    comunidade integer NOT NULL
);

alter table tblPerfisDaComunidade
add foreign key (perfil) references tblPerfil(id);

alter table tblPerfisDaComunidade
add foreign key (comunidade) references tblComunidade(id_comunidade);

alter table tblPost
add foreign key (perfil) references tblPerfil(id_perfil);

alter table tblPost
add foreign key (comunidade) references tblComunidade(id_comunidade);

--selects

select * from tblPerfil where id_perfil = ?

select * from tblPerfil where nome LIKE ?

select * from tblComunidade where id_comunidade = ?

select * from tblComunidade where nome LIKE ?

select * from tblComunidade where tema LIKE ?

select * from tblPerfisDaComunidade Inner JOIN tblPerfil on tblPerfisDaComunidade.perfil = tblPerfil.id_perfil
LEFT JOIN tblComunidade on tblPerfisDaComunidade.comunidade = tblComunidade.id_comunidade
where tblPerfisDaComunidade.perfil = ?

select * from tblPost INNER JOIN tblPerfil on tblPost.perfil = tblPerfil.id_perfil 
INNER JOIN tblComunidade on tblPost.comunidade = tblComunidade.id_comunidade 
where tblPost.perfil = ?

select * from produto RIGHT JOIN marca on produto.id_produto = marca.id_marca

