CREATE TABLE StudentRoom(
	studentId INT(10) UNSIGNED NOT NULL,
    roomId INT(10) UNSIGNED NOT NULL,
    FOREIGN KEY (studentId) REFERENCES students(id),
    FOREIGN KEY (roomId) REFERENCES rooms(id)
)engine InnoDB;

INSERT INTO StudentRoom VALUE(8, 3);