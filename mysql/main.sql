CREATE TABLE todos (
   id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   title VARCHAR(50), 
   content VARCHAR(255),
   complete TINYINT NOT NULL DEFAULT 0,
   created_at datetime NOT NULL,
   upsated_at datetime NOT NULL
   );

SELECT * FROM todos;