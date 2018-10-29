use tagBeSill;

create table if not exists Role(
	id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	label VARCHAR(255) NOT NULL,
    description BLOB NOT NULL
)engine InnoDB;

create table if not exists User(
	id INTEGER UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nickname varchar(255) not null,
    `password` varchar(255) not null,
    roleId integer unsigned not null,
    foreign key (roleId) references Role(id)
)engine InnoDB;

create table if not exists ProjectUser(
	projectId integer unsigned,
    userId integer unsigned,
    PRIMARY KEY (projectId, userId),
    FOREIGN KEY (projectId) REFERENCES Project(id),
    FOREIGN KEY (userId) REFERENCES `User`(id)
)engine InnoDB;


select * from User; 
delete from User;
ALTER TABLE User AUTO_INCREMENT = 0;    /* reset the ID to 0