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
   
    category_name varchar(20) PRIMARY key,
    category_desc varchar(20),
    category_imag varchar(20),
    ise_deleted BOOLEAN default 0 not null
   
 );


 INSERT INTO category (category_name,category_desc,category_imag,ise_deleted )
 VALUES ('acsessoire et cablse','jomuhjihouvihjomkjh','Adruinouno.jfif',0),
        ('phones','jomuhjihcategory_idouvihjomkjh','ArduinoDue.jfif',0),
        ('adruino','jomuhjihouvihjomkjh','ArduinoEthernet.jfif',0),
        ('ggg','jomuhjihouvihjomkjh','ArduinoLilyPad.jfif',0);
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
    categorie_id_fk varchar(20),
    FOREIGN KEY (categorie_id_fk) REFERENCES category(category_name) ON DELETE CASCADE
);

INSERT INTO products (pro_image, etiquette, code_barres, prix_dachat, prix_final, Offre_de_prix, description_pro, quantite_min, quantite_stock, categorie_id_fk)
VALUES
('Adruinouno.jfif', 'Arduino Uno', 11111, 2050, 18, 12, 'Description of Arduino Uno', 10, 50, 'acsessoire et cablse'),
('PortableBluetoothSpeakers.jfif', 'Portable Bluetooth Speakers', 22222, 2380, 30, 130, 'Description of Portable Bluetooth Speakers', 15, 40, 'phones'),
('ArduinoDue.jfif', 'Huawei P40 Pro', 33333, 2740, 10, 210, 'Description of Huawei P40 Pro', 20, 35, 'adruino'),
('ArduinoNano.jfif', 'Arduino Nano', 44444, 1875, 10, 80, 'Description of Arduino Nano', 25, 30, 'acsessoire et cablse'),
('ArduinoEthernet.jfif', 'Arduino Due', 55555, 1580, 0, 9, 'Description of Arduino Due', 30, 25, 'acsessoire et cablse'),
('ArduinoLeonardo.jfif', 'Arduino Pro Mini', 66666, 3025, 12, 20, 'Description of Arduino Pro Mini', 35, 20, 'phones'),
('ArduinoLilyPad.jfif', 'Arduino Zero', 77777, 1790, 7, 10, 'Description of Arduino Zero', 40, 15, 'acsessoire et cablse'),
('ArduinoZero.jfif', 'Arduino LilyPad', 88888, 2130, 0, 10, 'Description of Arduino LilyPad', 45, 10, 'acsessoire et cablse'),
('ArduinoNano.jfif', 'Arduino Ethernet', 99999, 1945, 20, 70, 'Description of Arduino Ethernet', 50, 5, 'acsessoire et cablse'),
('WirelessMouseKeyboard.jfif', 'Wireless Mouse Keyboard', 10101, 2875, 77, 180, 'Description of Wireless Mouse Keyboard', 55, 60, 'phones'),
('USBFlashDrives.jfif', 'USB Flash Drives', 12121, 2490, 20, 100, 'Description of USB Flash Drives', 65, 70, 'phones'),
('ArduinoMega.jfif', 'Arduino Mega 2560', 13131, 2050, 34, 120, 'Description of Arduino Mega 2560', 75, 80, 'acsessoire et cablse'),
('SmartphoneCasesCovers.jfif', 'Smartphone Cases Covers', 14141, 1675, 2, 17, 'Description of Smartphone Cases Covers', 85, 90, 'phones'),
('ArduinoLeonardo.jfif', 'Arduino Leonardo', 15151, 2500, 49, 150, 'Description of Arduino Leonardo', 95, 100, 'acsessoire et cablse'),
('ScreenProtectors.jfif', 'Screen Protectors', 16161, 2360, 9, 150, 'Description of Screen Protectors', 105, 110, 'phones'),
('VivoX60Pro.jfif', 'Vivo X 60 Pro', 17171, 2460, 2, 160, 'Description of Vivo X 60 Pro', 115, 120,'ggg' ),
('OppoFindX3Pro.jfif', 'Oppo Find X3 Pro', 18181, 2510, 6, 11, 'Description of Oppo Find X3 Pro', 125, 130, 'adruino'),
('MicroSDCards.jfif', 'Micro SD Cards', 19191, 2080, 7, 12, 'Description of Micro SD Cards', 135, 140, 'adruino'),
('ExternalHardDrives.jfif', 'External Hard Drives', 20202, 2240, 6, 110, 'Description of External Hard Drives', 145, 150, 'phones'),
('EthernetCables.jfif', 'Ethernet Cables', 21212, 1890, 5, 90, 'Description of Ethernet Cables', 155, 160, 'phones'),
('PowerBanks.jfif', 'Power Banks', 22222, 2575, 60, 16, 'Description of Power Banks', 165, 170, 'adruino'),
('Webcams.jfif', 'Webcams', 23232, 1650, 80, 100, 'Description of Webcams', 175, 180, 'adruino'),
('WirelessChargingPads.jfif', 'Wireless Charging Pads', 24242, 3110, 100, 21, 'Description of Wireless Charging Pads', 185, 190, 'phones'),
('XiaomiMi11.jfif', 'Xiaomi Mi 11', 25252, 1860, 21, 110, 'Description of Xiaomi Mi 11', 195, 200, 'ggg'),
('SonyXperia1III.jfif', 'Sony Xperia 1 III', 26262, 2215, 146, 140, 'Description of Sony Xperia 1 III', 205, 210, 'adruino'),
('SamsungGalaxyS21.jfif', 'Samsung Galaxy S21', 27272, 2025, 4, 3, 'Description of Samsung Galaxy S21', 215, 220, 'adruino'),
('RealmeGT.jfif', 'Realme GT', 28282, 2930, 6, 190, 'Description of Realme GT', 225, 230, 'adruino'),
('OnePlus9Pro.jfif', 'One Plus 9 Pro', 29292, 1750, 7, 90, 'Description of One Plus 9 Pro', 235, 240, 'ggg'),
('LaptopSleevesBags.jfif', 'Laptop Sleeves Bags', 30303, 2620, 5, 200, 'Description of Laptop Sleeves Bags', 245, 250, 'phones'),
('MotorolaEdge+.jfif', 'Motorola Edge+', 31313, 2460, 4, 160, 'Description of Motorola Edge+', 255, 260, 'adruino');
