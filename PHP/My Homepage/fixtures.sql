insert into Category(label, description) values 
		('OH Fabio', 'lorem FABIO lorem'),
		('Management', 'Lorem ipsum'),
		('ERP', 'ipsum loremus');

insert into `Status`(label, description) values
		('Analysis', 'Lorem ipsum sit'),
		('In progress', 'Lorem opsum'),
		('Blocked', 'Lorem san'),
		('Finished', 'Lorem resolved');
        
insert into Project(title, description, image, publishingDate, statusId) values
		('wf3pm', 'lorem', 'https://picsum.photos/80/80/?random', now(), 1),
        ('Hots', 'lorem', 'https://picsum.photos/80/80/?random', now(), 3),
        ('Fit4Coding', 'lorem ipus dorem', 'https://picsum.photos/80/80/?random', now(), 2),
        ('Fit', 'lorem ipus', 'https://picsum.photos/80/80/?random', now(), 4);
        
        
insert into ProjectCategory values
		(1,1),
        (2,2),
        (2,3);