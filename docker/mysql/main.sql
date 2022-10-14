use todolists;

CREATE TABLE todos (
   id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   title VARCHAR(50) NOT NULL, 
   content VARCHAR(255) NOT NULL,
   is_done BOOL DEFAULT false,
   created_at DATETIME,
   updated_at DATETIME
);

INSERT INTO todos (title, content, is_done, created_at, updated_at) VALUES ('', '', 0 , NOW(), NOW());

UPDATE todos SET title = '', content = '', is_done = 0, updated_at = NOW() WHERE id = '';

DELETE FROM todos WHERE id = '';

SELECT * FROM todos;

CREATE TABLE posts (
   id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   content VARCHAR(255) NOT NULL,
   created_at DATETIME
);

INSERT INTO posts (content, created_at) VALUES ('', NOW());

TRUNCATE TABLE posts;

SELECT * FROM posts;

CREATE TABLE bodies (
   id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   nowweights DECIMAL(5,2) NOT NULL,
   goalweights DECIMAL(5,2) NOT NULL,
   nowdate DATE
);

INSERT INTO bodies (nowweights, goalweights, nowdate) VALUES ('', '', NOW());

SELECT * FROM bodies;

DELETE FROM bodies WHERE id = '';

CREATE TABLE pictures (
   id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   file_name VARCHAR(255) NOT NULL,
   file_path VARCHAR(255) NOT NULL UNIQUE,
   comment VARCHAR(255) NOT NULL,
   created_at DATETIME
);

INSERT INTO pictures (file_name, file_path, comment, created_at) VALUES ('', '', '', '', NOW());

SELECT * FROM pictures;

DELETE FROM pictures WHERE id = '';