use mvc;
update news set
	importance = false;
update news set
	importance = true
    where id = 2;
select * from news;