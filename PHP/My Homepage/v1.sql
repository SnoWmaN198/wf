create database if not exists tagBeSill;

use tagBeSill;

create table if not exists `Status`(
	id int unsigned primary key auto_increment,
    label varchar(255) not null,
    description blob not null
)engine=InnoDB;

create table if not exists Project (
	id int unsigned primary key auto_increment,
    title varchar(255) not null,
    description blob not null,
    image varchar(255) default null, 
    publishingDate datetime default null,
    creationDate datetime not null default current_timestamp,
    updatedAt datetime not null default current_timestamp,
    statusId int unsigned not null,
    foreign key (statusId) references `Status` (id) 
)engine=InnoDB;

create table if not exists Category(
	id int unsigned primary key auto_increment,
    label varchar(255) not null,
    description blob not null
)engine=InnoDB;

create table if not exists ProjectCategory(
	projectId int unsigned,
    categoryId int unsigned,
    primary key (projectId, categoryId),
    foreign key (projectId) references Project(id),
    foreign key (categoryId) references Category(id)
)engine=InnoDB; 