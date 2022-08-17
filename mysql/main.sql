
use todolists;

CREATE TABLE todos (
   id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   title VARCHAR(50), 
   content VARCHAR(255),
   created_at datetime NOT NULL,
   updated_at datetime NOT NULL
);

INSERT INTO todos (title, content,  is_done ,created_at, updated_at) VALUES ('%s', '%s',true, NOW(), NOW());

UPDATE todos SET title = '', content = '', updated_at = NOW() WHERE id = '';

SELECT * FROM todos;

CREATE TABLE words (
   id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   content VARCHAR(255),
   created_at datetime NOT NULL
);

INSERT INTO words (content, created_at) VALUES ('', NOW());

SELECT * FROM words;

CREATE TABLE bodies (
   id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   nowweights DECIMAL(5,2),
   goalweights DECIMAL(5,2),
   difference DECIMAL(5,2) AS (nowweights - goalweights),
   nowdate DATE NOT NULL
);

INSERT INTO bodies (nowweights, goalweights, nowdate) VALUES ('', '', '');

SELECT * FROM bodies;

CREATE TABLE pictures (
   id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   file_name VARCHAR(255),
   file_path VARCHAR(255) UNIQUE KEY,
   comment VARCHAR(255) NOT NULL,
   created_at DATETIME NOT NULL
);

INSERT INTO pictures (file_name, file_path, comment, created_at) VALUES ('', '', '', NOW());

SELECT * FROM pictures;