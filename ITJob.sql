CREATE DATABASE ITJOB

GO
USE ITJOB
GO

CREATE TABLE role
(
	id INT IDENTITY NOT NULL PRIMARY KEY,
	name VARCHAR(100) NOT NULL UNIQUE,
	created_at DATETIME NOT NULL,
	updated_at DATETIME NOT NULL,
	deleted_at DATETIME NOT NULL,
)

CREATE TABLE skill
(
	id INT IDENTITY NOT NULL PRIMARY KEY,
	name VARCHAR(100) NOT NULL UNIQUE,
	created_at DATETIME NOT NULL,
	updated_at DATETIME NOT NULL,
	deleted_at DATETIME NOT NULL,
)

CREATE TABLE company_information
(
	id INT IDENTITY NOT NULL PRIMARY KEY,
	type VARCHAR(20) NOT NULL,
	staff INT NOT NULL,
	headquarters NVARCHAR(200) NOT NULL,
    taxcode VARCHAR(50) NOT NULL,
	description NVARCHAR(100) NOT NULL,
	token VARCHAR(100) NOT NULL,
	created_at DATETIME NOT NULL,
	updated_at DATETIME NOT NULL,
	deleted_at DATETIME NOT NULL,

	FOREIGN KEY(role_id) REFERENCES dbo.role(id),
)

CREATE TABLE [user]
(
	id INT IDENTITY NOT NULL PRIMARY KEY,
	name NVARCHAR(100) NOT NULL,
	username NVARCHAR(100) NOT NULL UNIQUE,
	email NVARCHAR(100) UNIQUE NOT NULL,
	phone VARCHAR(10) UNIQUE NOT NULL,
	address NVARCHAR(100) NOT NULL,
	img_avatar VARCHAR(100) NOT NULL,
	position NVARCHAR(100) NOT NULL,
	description NVARCHAR(100) NOT NULL,
	password VARCHAR(100) NOT NULL,
	provider VARCHAR(30) NOT NULL,
	token VARCHAR(100) NOT NULL,
    start FLOAT NOT NULL,
	role_id INT NOT NULL,
	skill_id INT NOT NULL,
    company_id INT NOT NULL,
	created_at DATETIME NOT NULL,
	updated_at DATETIME NOT NULL,
	deleted_at DATETIME NOT NULL,

	FOREIGN KEY(role_id) REFERENCES dbo.role(id),
    FOREIGN KEY(company_id) REFERENCES dbo.company(id)
)

CREATE TABLE post
(
	id INT IDENTITY NOT NULL PRIMARY KEY,
	title NVARCHAR(200) NOT NULL,
    [view] INT NOT NULL,
    status INT NOT NULL,
    approved_user_id INT NOT NULL,
    photo VARCHAR(100) NOT NULL,
	skill_id INT NOT NULL,
    user_id INT NOT NULL,
	created_at DATETIME NOT NULL,
	updated_at DATETIME NOT NULL,
	deleted_at DATETIME NOT NULL,

	FOREIGN KEY(skill_id) REFERENCES dbo.skill,
	FOREIGN KEY(company_id) REFERENCES dbo.company(id),
    FOREIGN KEY(user_id) REFERENCES dbo.[user](id)
)

CREATE TABLE information_type
(
    id INT IDENTITY NOT NULL,
    name NVARCHAR(100),

    created_at DATETIME NOT NULL,
	updated_at DATETIME NOT NULL,
	deleted_at DATETIME NOT NULL,
)

CREATE TABLE information
(
	id INT IDENTITY NOT NULL PRIMARY KEY,
	content NVARCHAR(MAX) NOT NULL,
    ticket_reply VARCHAR(50) NOT NULL,
    user_id INT NOT NULL,
    type_id VARCHAR(50),
	created_at DATETIME NOT NULL,
	updated_at DATETIME NOT NULL,
	deleted_at DATETIME NOT NULL,

    FOREIGN KEY(user_id) REFERENCES dbo.[user](id),
    FOREIGN KEY(type_id) REFERENCES dbo.type(id)
)

CREATE TABLE ticket_type
(
    id INT IDENTITY NOT NULL,
    content NVARCHAR(MAX) NOT NULL,
    image VARCHAR(max) NOT NULL,
    created_at DATETIME NOT NULL,
	updated_at DATETIME NOT NULL,
	deleted_at DATETIME NOT NULL
)

CREATE TABLE ticket
(
    id INT IDENTITY NOT NULL,
    content NVARCHAR(MAX) NOT NULL,
    image VARCHAR(max) NOT NULL,
    ticket_id INT NOT NULL,
    user_id INT NOT NULL,
    created_at DATETIME NOT NULL,
	updated_at DATETIME NOT NULL,
	deleted_at DATETIME NOT NULL,

    FOREIGN KEY(id) REFERENCES dbo.ticket_type(id),
    FOREIGN KEY(user_id) REFERENCES dbo.ticket_type(id)
)


CREATE TABLE review
(
    id INT IDENTITY NOT NULL PRIMARY KEY,
    content NVARCHAR(100) NOT NULL,
    form_user_id INT NOT NULL,
    to_user_id INT NOT NULL,
    created_at DATETIME NOT NULL,
	updated_at DATETIME NOT NULL,
	deleted_at DATETIME NOT NULL,

    FOREIGN KEY(user_id) REFERENCES dbo.[user](id)
)
