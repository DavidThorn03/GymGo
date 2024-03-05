use gymdb;
insert into `user` (UserID, Email, `Password`) values (1, "admin@gmail.com", "Password");
insert into `user` (UserID, Email, `Password`) values (2, "user@gmail.com", "Password");
insert into `admin` (AdminID, UserID) value (1, 1);
insert into cust (Fname, Sname, DOB, EirCode, Phone, UserID) values ("David", "Thornton", '2003-10-01', 'B16W375', 0862268473, 2);
insert into gallary (ImageID, ImageLink) values (1, "blabla");
insert into lessons (LessonID, LessonName, DurationMin, NumPlaces, Trainer, About, ImageID) values (1, "Spin", 60, 24, "Bob Ross", "BlaBlaBal", 1),
																							values (2, "Yoga", 30, 24, "Daniel Connors", "BlaBlaBal", 1);
insert into `lesson-time` (LessonTimeID, `Time`, `Day`, LessonID) values (1, '19:30:00', 1, 1);
insert into `booked-lesson` (BookedLessonID, LessonTimeID, UserID) values (1, 1, 2);
insert into `products` (ProductID, ProductName, Price, `Description`, Size, Colour, ImageID) values (1, "Hoodie", 30, "BlaBlaBla", "Medium", "Red",1);
insert into orders (UserID, ProductID, OrderTime) value (2, 1, '2024-04-05 20:30:23');
