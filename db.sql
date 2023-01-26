drop database if exists lessonPhp;
create database lessonPHP;

use lessonPhp;

create table login_mypage(
    id int(11) auto_increment primary key,
    name varchar(255),
    mail varchar(255),
    password varchar(255),
    picture varchar(255),
    comments varchar(255)
);

