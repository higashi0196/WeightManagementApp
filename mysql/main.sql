use todolists;

CREATE TABLE todos (
   id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   title VARCHAR(50), 
   content VARCHAR(255),
   is_done BOOL DEFAULT false,
   created_at datetime NOT NULL,
   updated_at datetime NOT NULL
);

INSERT INTO todos (title, content, is_done ,created_at, updated_at) VALUES ('', '', 0 , NOW(), NOW());

UPDATE todos SET title = '', content = '',is_done = 0, updated_at = NOW() WHERE id = '';

DELETE FROM todos WHERE id = '';

SELECT * FROM todos;

CREATE TABLE posts (
   id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   content VARCHAR(255),
   created_at datetime NOT NULL
);

INSERT INTO posts (content, created_at) VALUES ('', NOW());

TRUNCATE TABLE posts;

SELECT * FROM posts;

CREATE TABLE bodies (
   id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   nowweights DECIMAL(5,2),
   goalweights DECIMAL(5,2),
   nowdate DATE NOT NULL
);

INSERT INTO bodies (nowweights, goalweights, nowdate) VALUES ('', '', NOW());

SELECT * FROM bodies;

CREATE TABLE pictures (
   id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   file_name VARCHAR(255),
   tmp_name LONGBLOB,
   comment VARCHAR(255) NOT NULL,
   created_at DATETIME NOT NULL
);

INSERT INTO pictures (file_name, tmp_name, comment, created_at) VALUES ('', '', '', '', NOW());

DELETE FROM pictures WHERE id = '';

SELECT * FROM pictures;