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
   category_id int PRIMARY key AUTO_INCREMENT,
    category_name varchar(20) ,
    category_desc varchar(20),
    category_imag varchar(20),
    ise_deleted BOOLEAN default 0 not null
   
 );


 INSERT INTO category (category_name,category_desc,category_imag,ise_deleted )
 VALUES ('acsessoire et cablse','acsesoire description','acsessoir_cat.jpg',0),
        ('phones','phones description','phone_cat.jpg',0),
        ('adruino','arduino description','ArduinoEthernet.jfif',0),
        ('tv','tv description','tv_cat.jpg',0);
CREATE TABLE products (
    reference INT PRIMARY key AUTO_INCREMENT,
    pro_image varchar(50),
    etiquette varchar(50),
    code_barres int,
    prix_dachat int,
    prix_final int,
    Offre_de_prix int,
    description_pro varchar(50),
    quantite_min int,
    quantite_stock int,
     ise_deleted BOOLEAN default 0 not null,
    categorie_id_fk int,
    FOREIGN KEY (categorie_id_fk) REFERENCES category(category_id) ON DELETE CASCADE
);

INSERT INTO products (pro_image, etiquette, code_barres, prix_dachat, prix_final, Offre_de_prix, description_pro, quantite_min, quantite_stock, categorie_id_fk)
VALUES
('Adruinouno.jfif', 'Arduino Uno', 11111, 2050, 18, 12, 'Description of Arduino Uno', 10, 50, 3),
('ArduinoDue.jfif', 'Arduino Due', 55555, 1580, 333, 9, 'Description of Arduino Due', 30, 25, 3),
('ArduinoNano.jfif', 'Arduino Nano', 44444, 1875, 10333, 80, 'Description of Arduino Nano', 25, 30, 3),
('ArduinoEthernet.jfif', 'Arduino Ethernet', 99999, 1945, 20, 70, 'Description of Arduino Ethernet', 50, 5, 3),
('ArduinoLeonardo.jfif', 'Arduino Pro Mini', 66666, 3025, 12, 20, 'Description of Arduino Pro Mini', 35, 20, 3),
('LGOLED.jpg', 'LG OLED', 77777, 1790, 7, 10, 'Description of LG OLED', 40, 55, 4),
('XiaomiMi11.jfif', 'XiaomiMi 11', 88888, 2130, 0, 10, 'Description of Arduino LilyPad', 45, 10, 2),
('ScreenProtectors.jfif', 'Screen Protectors', 13131, 2050, 34, 120, 'Description of Arduino Mega 2560', 75, 80, 1),
('PanasonicViera.jpg', 'Panasonic Viera', 15151, 2500, 49, 150, 'Description of Panasonic Viera', 95, 100, 4),
('RealmeGT.jfif', 'Realme GT', 99999, 1945, 20, 70, 'Description of Realme GT', 50, 100, 2),
('SamsungGalaxyS21.jfif', 'Samsung Galaxy S21', 16161, 2360, 9, 150, 'Description of Samsung Galaxy S21', 105, 110, 2),
('Webcams.jfif', 'Webcams', 23232, 1650, 80, 100, 'Description of Webcams', 175, 180, 1),
('SmartphoneCasesCovers.jfif', 'Smartphone Cases Covers', 14141, 1675, 2, 17, 'Description of Smartphone Cases Covers', 85, 90, 1),
('WirelessChargingPads.jfif', 'Wireless Charging Pads', 24242, 3110, 100, 21, 'Description of Wireless Charging Pads', 185, 190, 1),
('SamsungQLED.jpg', 'Samsung QLED', 20202, 2240, 6, 110, 'Description of External Samsung QLED', 145, 150, 4),
('EthernetCables.jfif', 'Ethernet Cables', 21212, 1890, 5, 90, 'Description of Ethernet Cables', 155, 160, 1),
('SonyBravia.jpg', 'Sony Bravia', 22222, 2575, 60, 16, 'Description of Sony Bravia', 165, 170, 4),
('VivoX60Pro.jfif', 'VivoX60Pro', 19191, 2080, 7, 12, 'Description of Vivo X60Pro', 135, 140, 2),
('TCLRokuTV.jpg', 'TCL Roku TV', 31313, 2460, 4, 160, 'Description of TCL Roku TV', 255, 260, 4),
('MotorolaEdge+.jfif', 'MotorolaEdge+', 12121, 2490, 20, 100, 'Description of Motorola Edge+', 65, 70, 2);
