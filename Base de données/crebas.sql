/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de création :  22/02/2016 17:29:45                      */
/*==============================================================*/


drop table if exists ASSOCIATION_10;

drop table if exists ASSOCIATION_26;

drop table if exists ASSOCIATION_30;

drop table if exists COMPTE;

drop table if exists ELEMENTSACHOISIREVENEMENT;

drop table if exists EVENEMENT;

drop table if exists IMAGESEVENEMENT;

drop table if exists INSCRIPTION;

drop table if exists PLACE;

drop table if exists STATUT;

drop table if exists TEXTESINFORMATIONEVENEMENT;

/*==============================================================*/
/* Table : ASSOCIATION_10                                       */
/*==============================================================*/
create table ASSOCIATION_10
(
   IDINSCRIPTION        varchar(30) not null,
   IDELEMENTACHOISIR    varchar(30) not null,
   VALEUR_CHOISIE       varchar(30),
   primary key (IDINSCRIPTION, IDELEMENTACHOISIR)
);

/*==============================================================*/
/* Table : ASSOCIATION_26                                       */
/*==============================================================*/
create table ASSOCIATION_26
(
   IDIMAGE              varchar(30) not null,
   IDEVENEMENT          varchar(30) not null,
   primary key (IDIMAGE, IDEVENEMENT)
);

/*==============================================================*/
/* Table : ASSOCIATION_30                                       */
/*==============================================================*/
create table ASSOCIATION_30
(
   IDCOMPTE             varchar(30) not null,
   IDEVENEMENT          varchar(30) not null,
   primary key (IDCOMPTE, IDEVENEMENT)
);

/*==============================================================*/
/* Table : COMPTE                                               */
/*==============================================================*/
create table COMPTE
(
   ADRESSECODECOMPTE    int,
   ADRESSEPAYSCOMPTE    varchar(32),
   ADRESSERUECOMPTE     varchar(64),
   ADRESSEVILLECOMPTE   varchar(256),
   DATENAISSANCECOMPTE  date,
   NOMCOMPTE            varchar(32),
   PRENOMCOMPTE         varchar(32),
   SEXECOMPTE           blob,
   IDCOMPTE             varchar(30) not null,
   STATUTCOMPTE         varchar(30) not null,
   primary key (IDCOMPTE)
);

/*==============================================================*/
/* Table : ELEMENTSACHOISIREVENEMENT                            */
/*==============================================================*/
create table ELEMENTSACHOISIREVENEMENT
(
   IDELEMENTACHOISIR    varchar(30) not null,
   IDEVENEMENT          varchar(30) not null,
   LIBELLEELEMENTACHOISIR varchar(30),
   TYPEELEMENTACHOISIR  varchar(30),
   primary key (IDELEMENTACHOISIR)
);

/*==============================================================*/
/* Table : EVENEMENT                                            */
/*==============================================================*/
create table EVENEMENT
(
   DATE_FERMETURE_EVENEMENT3 date,
   DATEOUVERTUREEVENEMENT date,
   LIENEVENEMENT        text,
   TITRECOURTEVENEMENT  varchar(16),
   TITRELONGEVENEMENT   varchar(64),
   NOMBREPLACESEVENEMENT int,
   STATUTPRIVE          bool,
   IDEVENEMENT          varchar(30) not null,
   primary key (IDEVENEMENT)
);

/*==============================================================*/
/* Table : IMAGESEVENEMENT                                      */
/*==============================================================*/
create table IMAGESEVENEMENT
(
   IDIMAGE              varchar(30) not null,
   primary key (IDIMAGE)
);

/*==============================================================*/
/* Table : INSCRIPTION                                          */
/*==============================================================*/
create table INSCRIPTION
(
   IDINSCRIPTION        varchar(30) not null,
   IDCOMPTE             varchar(30) not null,
   IDPLACE              varchar(30),
   MODEDEPAIEMENT       varchar(30),
   NOMBREDEPERSONNES    varchar(30),
   primary key (IDINSCRIPTION)
);

/*==============================================================*/
/* Table : PLACE                                                */
/*==============================================================*/
create table PLACE
(
   IDPLACE              varchar(30) not null,
   IDEVENEMENT          varchar(30) not null,
   TYPEPLACE            varchar(30),
   PRIXPLACE            varchar(30),
   primary key (IDPLACE)
);

/*==============================================================*/
/* Table : STATUT                                               */
/*==============================================================*/
create table STATUT
(
   STATUTCOMPTE         varchar(30) not null,
   primary key (STATUTCOMPTE)
);

/*==============================================================*/
/* Table : TEXTESINFORMATIONEVENEMENT                           */
/*==============================================================*/
create table TEXTESINFORMATIONEVENEMENT
(
   IDTEXTE              varchar(30) not null,
   IDEVENEMENT          varchar(30) not null,
   primary key (IDTEXTE)
);

alter table ASSOCIATION_10 add constraint FK_ASSOCIATION_10 foreign key (IDINSCRIPTION)
      references INSCRIPTION (IDINSCRIPTION) on delete restrict on update restrict;

alter table ASSOCIATION_10 add constraint FK_ASSOCIATION_12 foreign key (IDELEMENTACHOISIR)
      references ELEMENTSACHOISIREVENEMENT (IDELEMENTACHOISIR) on delete restrict on update restrict;

alter table ASSOCIATION_26 add constraint FK_ASSOCIATION_26 foreign key (IDIMAGE)
      references IMAGESEVENEMENT (IDIMAGE) on delete restrict on update restrict;

alter table ASSOCIATION_26 add constraint FK_ASSOCIATION_28 foreign key (IDEVENEMENT)
      references EVENEMENT (IDEVENEMENT) on delete restrict on update restrict;

alter table ASSOCIATION_30 add constraint FK_ASSOCIATION_30 foreign key (IDCOMPTE)
      references COMPTE (IDCOMPTE) on delete restrict on update restrict;

alter table ASSOCIATION_30 add constraint FK_ASSOCIATION_31 foreign key (IDEVENEMENT)
      references EVENEMENT (IDEVENEMENT) on delete restrict on update restrict;

alter table COMPTE add constraint FK_ASSOCIATION_17 foreign key (STATUTCOMPTE)
      references STATUT (STATUTCOMPTE) on delete restrict on update restrict;

alter table ELEMENTSACHOISIREVENEMENT add constraint FK_ASSOCIATION_11 foreign key (IDEVENEMENT)
      references EVENEMENT (IDEVENEMENT) on delete restrict on update restrict;

alter table INSCRIPTION add constraint FK_EFFECTUE foreign key (IDCOMPTE)
      references COMPTE (IDCOMPTE) on delete restrict on update restrict;

alter table INSCRIPTION add constraint FK_RESERVE foreign key (IDPLACE)
      references PLACE (IDPLACE) on delete restrict on update restrict;

alter table PLACE add constraint FK_ASSOCIATION_33 foreign key (IDEVENEMENT)
      references EVENEMENT (IDEVENEMENT) on delete restrict on update restrict;

alter table TEXTESINFORMATIONEVENEMENT add constraint FK_ASSOCIATION_27 foreign key (IDEVENEMENT)
      references EVENEMENT (IDEVENEMENT) on delete restrict on update restrict;

