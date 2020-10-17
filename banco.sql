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

