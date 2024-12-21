create database if not exists mvc;
use mvc;
CREATE TABLE if not exists news (
        id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        title varchar(128) NOT NULL,
        slug varchar(128) NOT NULL,
        text text NOT NULL,
        importance boolean,
        KEY slug (slug)
);
INSERT INTO news(id, title, slug, text, importance) VALUES
(1,"news item 1","news1","Lorem ipsum dolor sit amet,
consectetur adipiscing elit, sed do eiusmod tempor
incididunt ut labore et dolore magna aliqua. Ut enim ad
minim veniam, quis nostrud exercitation ullamco laboris nisi
ut aliquip ex ea commodo consequat.", false), 
(2,"news item 2","news2","Duis aute irure dolor in
reprehenderit in voluptate velit esse cillum dolore eu
fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id
est laborum.", true), 
(3,"news item 3","news3","Sed ut perspiciatis unde omnis
iste natus error sit voluptatem accusantium doloremque
laudantium, totam rem aperiam, eaque ipsa quae ab illo
inventore veritatis et quasi architecto beatae vitae dicta
sunt explicabo.", false);
create user {username}@localhost identified by '{password_here}';
grant all on news to {username}@localhost;

select * from news;