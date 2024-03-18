INSERT INTO gymdb.user (UserID, Email, Password)
VALUES ('1', 'user@example.com', 'userPassword');

INSERT INTO gymdb.image (ImageID, ImageLink)
VALUES ('1', 'http://example.com/image.jpg');

INSERT INTO gymdb.products (ProductID, ProductName, Price, Description, Size, Colour, ImageID) VALUES
('1', 'Dumbbells Set', 50, 'A set of adjustable weight dumbbells perfect for strength training at home.', 'Adjustable', 'Black', '1'),
('2', 'Yoga Mat', 20, 'High-quality, non-slip yoga mat for all types of yoga and fitness exercises.', '68x24 inches', 'Purple', '1'),
('3', 'Resistance Bands', 30, 'A set of 5 resistance bands with different strengths for a versatile workout.', '5-pack', 'Multicolor', '1');

ALTER TABLE gymdb.orders
ADD COLUMN Quantity INT AFTER ProductID;

