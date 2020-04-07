CREATE TABLE users (
	id SERIAL,
	name VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL,
	password VARCHAR(255),
	social_id VARCHAR(255),
	remember_token VARCHAR(100),
	phone INTEGER,
	birthday DATE,
	created_at TIMESTAMP,
	updated_at TIMESTAMP,

	PRIMARY KEY (id)
);