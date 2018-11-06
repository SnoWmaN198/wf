create database if not exists BoardgamesLibrary;

use BoardgamesLibrary;

create table if not exists Designer(
	id integer unsigned auto_increment primary key,
    `name` varchar(255) not null
) engine InnoDB;

create table if not exists Boardgames(
	id integer unsigned auto_increment primary key,
    title varchar(255) not null,
    publishingDate datetime not null,
    image varchar(255) default null,
    playingTime integer not null,
    numberOfPlayers varchar(255) not null,
    age integer not null,
    rating integer null,
    designerId integer unsigned not null,
    foreign key (designerId) references Designer(id)
) engine InnoDB;

create table if not exists Category(
	id integer unsigned auto_increment primary key,
    label varchar(255) not null,
    description blob not null
) engine InnoDB;

create table if not exists Publisher(
	id integer unsigned auto_increment primary key,
    `name` varchar(255) not null
) engine InnoDB;

create table if not exists Mechanismus(
	id integer unsigned auto_increment primary key,
    label varchar(255) not null,
    description blob not null
) engine InnoDB;

create table if not exists GameCategory(
	gameId integer unsigned,
    categoryId integer unsigned,
    primary key (gameId, categoryId),
    foreign key (gameId) references Boardgames(id),
    foreign key (categoryId) references Category(id)
) engine InnoDB;

create table if not exists GamePublisher(
	gameId integer unsigned,
    publisherId integer unsigned,
    primary key (gameId, publisherId),
    foreign key (gameId) references Boardgames(id),
    foreign key (publisherId) references Publisher(id)
) engine InnoDB;

create table if not exists GameMechanismus(
	gameId integer unsigned,
    mechanismusId integer unsigned,
    primary key (gameId, mechanismusId),
    foreign key (gameId) references Boardgames(id),
    foreign key (mechanismusId) references Mechanismus(id)
) engine InnoDB;

INSERT INTO Category(label, description) VALUES
	('Management', 'Lorem ipsum dolor sit amet'),
	('ERP', 'Lorem ipsum dolor sit amet'),
	('DMZ', 'Lorem ipsum dolor sit amet');
    
INSERT INTO Mechanismus(label, description) VALUES
	('Multiplayer', 'Lorem ipsum dolor sit amet'),
	('Solo', 'Lorem ipsum dolor sit amet'),
	('Duo', 'Lorem ipsum dolor sit amet');
    
/*ALTER TABLE boardgames AUTO_INCREMENT = 0;
select * from Boardgames;
select * from designer;
select * from publisher;
drop database BoardgamesLibrary*/