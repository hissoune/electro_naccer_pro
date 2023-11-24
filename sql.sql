drop database Electro_naccer_pro;
create database Electro_naccer_pro;
use Electro_naccer_pro;





create table User (
    userid int PRIMARY key AUTO_INCREMENT,
    user_nam varchar(20)  not null,
    email varchar(20)  not null,
    Passwords varchar(20) not null,
    is_admin  BOOLEAN default 0 not null,
    setuation  BOOLEAN default 0 not null
   
   
);



describe User;
 INSERT INTO User (user_nam ,email , Passwords , is_admin,setuation)
 VALUES ( 'khalid','khalid@em.com','ggggg',1,1);

 create table category (
    category_id int PRIMARY key ,
    category_name varchar(20),
    category_desc varchar(20),
    category_imag varchar(20)
 );


 INSERT INTO category
 VALUES (1,'acsessoire et cablse','jomuhjihouvihjomkjh','Adruinouno.jfif'),
        (2,'phones','jomuhjihcategory_idouvihjomkjh','ArduinoDue.jfif'),
        (3,'adruino','jomuhjihouvihjomkjh','ArduinoEthernet.jfif'),
        (4,'ggg','jomuhjihouvihjomkjh','ArduinoLilyPad.jfif');
CREATE TABLE products (
    reference varchar(50),
    pro_image varchar(50),
    etiquette varchar(50),
    code_barres int,
    prix_dachat int,
    prix_final int,
    Offre_de_prix int,
    description_pro varchar(50),
    quantite_min int,
    quantite_stock int,
    categorie_id_fk int,
    FOREIGN KEY (categorie_id_fk) REFERENCES category(category_id)
);

INSERT INTO products (reference, pro_image, etiquette, code_barres, prix_dachat, prix_final, Offre_de_prix, description_pro, quantite_min, quantite_stock, categorie_id_fk) VALUES
('Product 1 Reference', 'image1.jpg', 'Etiquette 1', 12345, 50, 100, 80, 'Description of Product 1', 10, 50, 1),
('Product 2 Reference', 'image2.jpg', 'Etiquette 2', 54321, 60, 110, 85, 'Description of Product 2', 15, 40, 2),
('Product 3 Reference', 'image3.jpg', 'Etiquette 3', 67890, 70, 120, 90, 'Description of Product 3', 20, 35, 3),
('Product 4 Reference', 'image4.jpg', 'Etiquette 4', 24680, 80, 130, 95, 'Description of Product 4', 25, 30, 1),
('Product 5 Reference', 'image5.jpg', 'Etiquette 5', 13579, 90, 140, 100, 'Description of Product 5', 30, 25, 2),
('Product 6 Reference', 'image6.jpg', 'Etiquette 6', 98765, 100, 150, 105, 'Description of Product 6', 35, 20, 3),
('Product 7 Reference', 'image7.jpg', 'Etiquette 7', 98761, 110, 160, 110, 'Description of Product 7', 40, 15, 4),
('Product 8 Reference', 'image8.jpg', 'Etiquette 8', 54322, 120, 170, 115, 'Description of Product 8', 45, 10, 2),
('Product 9 Reference', 'image9.jpg', 'Etiquette 9', 11111, 130, 180, 120, 'Description of Product 9', 50, 5, 4),
('Product 10 Reference', 'image10.jpg', 'Etiquette 10', 22222, 140, 190, 125, 'Description of Product 10', 55, 60, 1);