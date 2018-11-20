drop database microforce;
create database microforce;

use microforce;

create table students(
	id int not null auto_increment primary key,
    `firstname` varchar(255) not null,
    `lastname` varchar(255) not null
)engine InnoDB;

create table rooms(
	id int not null auto_increment primary key,
    name varchar(255) not null,
    capacity int not null
)engine InnoDB;

create table studentRoom(
	studentId INTEGER not null,
    roomId INTEGER not null,
    PRIMARY KEY (studentId, roomId),
    FOREIGN KEY (studentId) REFERENCES students(id),
    FOREIGN KEY (roomId) REFERENCES rooms(id)
)engine InnoDB;

insert into students(firstname, lastname) values 
	('Darryl', 'Bellard'), 
    ('Lizette', 'Homer'), 
    ('Dorothy', 'Medison'),
    ('Virginia', 'Albright'),
    ('Stephanie', 'Chadwick'),
    ('Cythia', 'Foley');
    
insert into students(firstname, lastname) value 
	('Margie','<script>alert("hello world");</script>');

insert into rooms (name, capacity) value
	('Belval', 25);
    
insert into rooms (name, capacity) value
	('esch', 25);
    
insert into students(firstname, lastname) values 
	('Joanna', 'Catty'), 
    ('Jessica', 'Simpson'), 
    ('Sophia', 'Sousa');