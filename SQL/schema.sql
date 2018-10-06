CREATE TABLE users (
	userid VARCHAR(30) PRIMARY KEY,
	password VARCHAR(20) NOT NULL,
	isAdmin BOOLEAN NOT NULL
);

CREATE TABLE projects (
	advertiser VARCHAR(30) REFERENCES users(userid),
	projectid CHAR(23) PRIMARY KEY,
	title VARCHAR(50) NOT NULL,
	description TEXT NOT NULL,
	start_date DATE NOT NULL,
	duration INT NOT NULL CHECK (duration > 0),
	keywords VARCHAR(100),
	funding_sought INT NOT NULL CHECK (funding_sought > 0),
	amount_funded INT NOT NULL CHECK (amount_funded >= 0)
);

CREATE TABLE invest (
    investor VARCHAR(30) REFERENCES users(userid),
	projectid VARCHAR(23) REFERENCES projects(projectid) ON DELETE CASCADE,
	PRIMARY KEY(investor, projectid),
    amount INT NOT NULL
);

ALTER DATABASE project1 SET datestyle TO "ISO, DMY";
