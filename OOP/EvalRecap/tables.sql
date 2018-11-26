create table appartment(
	id int unsigned not null primary key auto_increment,
    size float unsigned not null,
    rooms int unsigned not null,
    location varchar(255)
) engine InnoDB;

create table house(
	id int unsigned not null primary key auto_increment,
    size float unsigned not null,
    rooms int unsigned not null,
    location varchar(255),
    gardenSize float unsigned
) engine InnoDB;