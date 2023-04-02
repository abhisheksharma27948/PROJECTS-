create database login_user;
use login_user;

CREATE TABLE user_login (
  id INT NOT NULL AUTO_INCREMENT,
  email VARCHAR(255) NOT NULL,
  username VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  remember_me BOOLEAN, 
  PRIMARY KEY (id)
);

INSERT INTO user_login (email, username, password, remember_me)
VALUES ('abhi@gmail.com', 'abhi', '123ABC', 1);

select * from  user_login;

UPDATE user_login SET password = 'new_password' WHERE username = 'ABC';
