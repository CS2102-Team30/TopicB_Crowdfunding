CREATE TABLE users (
	userid VARCHAR(30) PRIMARY KEY,
	password VARCHAR(32) NOT NULL,
	isAdmin BOOLEAN NOT NULL
);

CREATE TABLE categories (
	category VARCHAR(30) PRIMARY KEY
);

CREATE TABLE projects (
	advertiser VARCHAR(30) REFERENCES users(userid) ON DELETE CASCADE,
	projectid CHAR(23) PRIMARY KEY,
	title VARCHAR(60) NOT NULL,
	description TEXT NOT NULL,
	start_date DATE NOT NULL,
	duration INT NOT NULL CHECK (duration > 0),
	funding_sought INT NOT NULL CHECK (funding_sought > 0 AND funding_sought >= amount_funded),
	amount_funded INT NOT NULL CHECK (amount_funded >= 0 AND amount_funded <= funding_sought)
);

CREATE TABLE invest (
    investor VARCHAR(30) REFERENCES users(userid),
	projectid VARCHAR(23) REFERENCES projects(projectid) ON DELETE CASCADE,
	PRIMARY KEY(investor, projectid),
    amount INT NOT NULL
);

CREATE TABLE belongsTo (
	projectid VARCHAR(23) REFERENCES projects(projectid) ON DELETE CASCADE,
	category VARCHAR(30) REFERENCES categories(category),
	PRIMARY KEY(projectid, category)
);


ALTER DATABASE project1 SET datestyle TO "ISO, DMY";
