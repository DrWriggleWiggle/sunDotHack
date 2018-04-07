CREATE TABLE members (
	memberId INTEGER NOT NULL AUTO_INCREMENT,
	firstName VARCHAR(255),
	lastName VARCHAR(255),
	email VARCHAR(255),
	password VARCHAR(255),
	PRIMARY KEY (memberId)
);

CREATE TABLE events (
	eventId INTEGER NOT NULL AUTO_INCREMENT,
	owner INTEGER NOT NULL,
	name VARCHAR(255),
	eventDate DATETIME,
	elapsedTime INTEGER,
	PRIMARY KEY (eventId),
	FOREIGN KEY (owner) REFERENCES members(memberId)
);

CREATE TABLE actions (
	member INTEGER NOT NULL,
	event INTEGER NOT NULL,
	accepted INTEGER,
	FOREIGN KEY (member) REFERENCES members(memberId),
	FOREIGN KEY (event) REFERENCES events(eventId)
);

CREATE TABLE friends (
	friend1 INTEGER NOT NULL,
	friend2 INTEGER NOT NULL,
	accepted INTEGER,
	FOREIGN KEY (friend1) REFERENCES members(memberId),
	FOREIGN KEY (friend2) REFERENCES members(memberId)
);