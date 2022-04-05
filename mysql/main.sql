CREATE TABLE todos (
   id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   title VARCHAR(50), 
   content VARCHAR(255),
   complete TINYINT NOT NULL DEFAULT 0,
   created_at datetime NOT NULL,
   upsated_at datetime NOT NULL
   );

INSERT INTO todos (title, content, complete, created_at, upsated_at) VALUES ('sample', 'tests',0,now(),now());
INSERT INTO todos (title, content, complete, created_at, updated_at) VALUES ('do', 'done',1,now(),now());

SELECT * FROM todos;