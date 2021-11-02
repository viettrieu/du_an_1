CREATE DATABASE ps17048 CHARACTER SET utf8 COLLATE utf8_general_ci;
CREATE TABLE ps17048.ps_users (
  id BIGINT NOT NULL AUTO_INCREMENT,
  admin BIT NOT NULL DEFAULT 0,
  username varchar(50) NOT NULL,
  fullName VARCHAR(100) NULL DEFAULT NULL,
  mobile VARCHAR(15) NOT NULL,
  email VARCHAR(100) NOT NULL,
  passwordHash VARCHAR(32) NOT NULL,
  registeredAt DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  address VARCHAR(150) NULL DEFAULT NULL,
  avatar MEDIUMTEXT NULL,
  gender BIT NOT NULL DEFAULT 0,
  verify BIT NOT NULL DEFAULT 0,
  PRIMARY KEY (id),
  UNIQUE INDEX uq_mobile (mobile ASC),
  UNIQUE INDEX uq_email (email ASC) );




-- CREATE TABLE ps17048.ps_media (
--   id BIGINT NOT NULL AUTO_INCREMENT,
--   title VARCHAR(75) NOT NULL,
--   slug VARCHAR(100) NOT NULL,
--   PRIMARY KEY (id))



CREATE TABLE ps17048.ps_category (
  id BIGINT NOT NULL AUTO_INCREMENT,
  title VARCHAR(75) NOT NULL,
  published DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  content TEXT NULL,
  PRIMARY KEY (id),
  UNIQUE(title)
)
CREATE TABLE ps17048.product_category (
  productId BIGINT NOT NULL,
  categoryId BIGINT NOT NULL,
  PRIMARY KEY (productId, categoryId),
  INDEX idx_pc_category (categoryId ASC),
  INDEX idx_pc_product (productId ASC),
  CONSTRAINT fk_pc_product
    FOREIGN KEY (productId)
    REFERENCES ps17048.ps_product (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT fk_pc_category
    FOREIGN KEY (categoryId)
    REFERENCES ps17048.ps_category (id)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE TABLE ps17048.ps_tag (
  id BIGINT NOT NULL AUTO_INCREMENT,
  title VARCHAR(75) NOT NULL,
  published DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  content TEXT NULL,
  PRIMARY KEY (id),
  UNIQUE(title)
)

CREATE TABLE ps17048.product_tag (
  productId BIGINT NOT NULL,
  tagId BIGINT NOT NULL,
  PRIMARY KEY (productId, tagId),
  INDEX idx_pc_tag (tagId ASC),
  INDEX idx_pc_product (productId ASC),
  CONSTRAINT fk_pc_product_tag
    FOREIGN KEY (productId)
    REFERENCES ps17048.ps_product (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT fk_pc_tag
    FOREIGN KEY (tagId)
    REFERENCES ps17048.ps_tag (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE);

CREATE TABLE ps17048.ps_product (
  id BIGINT NOT NULL AUTO_INCREMENT,
  thumbnail VARCHAR(255) NULL,
  title VARCHAR(75) NOT NULL,
  summary MEDIUMTEXT NULL,
  sku VARCHAR(100) NULL,
  price FLOAT NOT NULL DEFAULT 0,
  discount FLOAT NULL,
  quantity SMALLINT(6) NULL DEFAULT NULL,
  published DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  content TEXT NULL,
  PRIMARY KEY (id),
    ON DELETE CASCADE
    ON UPDATE CASCADE)










CREATE TABLE ps17048.ps_product_meta (
  id BIGINT NOT NULL AUTO_INCREMENT,
  productId BIGINT NOT NULL,
  key VARCHAR(50) NOT NULL,
  content TEXT NULL DEFAULT NULL,
  PRIMARY KEY (id),
  INDEX idx_meta_product (productId ASC),
  UNIQUE INDEX uq_product_meta (productId ASC, key ASC),
  CONSTRAINT fk_meta_product
    FOREIGN KEY (productId)
    REFERENCES ps17048.ps_product (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;











-- CREATE TABLE ps17048.product_category (
--   productId BIGINT NOT NULL,
--   categoryId BIGINT NOT NULL,
--   PRIMARY KEY (productId, categoryId),
--   INDEX idx_pc_category (categoryId ASC),
--   INDEX idx_pc_product (productId ASC),
--   CONSTRAINT fk_pc_product
--     FOREIGN KEY (productId)
--     REFERENCES ps17048.ps_product (id)
--     ON DELETE CASCADE
--     ON UPDATE CASCADE,
--   CONSTRAINT fk_pc_category
--     FOREIGN KEY (categoryId)
--     REFERENCES ps17048.ps_category (id)
--     ON DELETE CASCADE
--     ON UPDATE CASCADE);






-- CREATE TABLE ps17048.ps_cart (
--   id BIGINT NOT NULL AUTO_INCREMENT,
--   userId BIGINT  NOT NULL,
--   PRIMARY KEY (id),
--   INDEX idx_cart_user (userId ASC),
--   CONSTRAINT fk_cart_user
--     FOREIGN KEY (userId)
--     REFERENCES ps17048.ps_users (id)
--     ON DELETE CASCADE
--     ON UPDATE CASCADE);


CREATE TABLE ps17048.ps_cart_item(
    id BIGINT NOT NULL AUTO_INCREMENT,
    productId BIGINT NOT NULL,
    userId BIGINT NOT NULL,
    quantity BIGINT NOT NULL,
    PRIMARY KEY(id),
    INDEX idx_cart_item_product(productId ASC),
    CONSTRAINT fk_cart_item_product FOREIGN KEY(productId) REFERENCES ps17048.ps_product(id) ON DELETE CASCADE ON UPDATE CASCADE
); ALTER TABLE
    ps17048.ps_cart_item ADD INDEX idx_cart_item_cart(userId ASC);
ALTER TABLE
    ps17048.ps_cart_item ADD CONSTRAINT fk_cart_item_users FOREIGN KEY(userId) REFERENCES ps17048.ps_users(id) ON DELETE CASCADE ON UPDATE CASCADE;













CREATE TABLE ps17048.ps_order(
    id BIGINT NOT NULL AUTO_INCREMENT,
    userId BIGINT NULL,
    published DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    status BIGINT NOT NULL DEFAULT 0,
    subTotal FLOAT NOT NULL DEFAULT 0,
    discount FLOAT NOT NULL DEFAULT 0,
    shipping FLOAT NOT NULL DEFAULT 0,
    total FLOAT NOT NULL DEFAULT 0,
    transaction VARCHAR(50) NOT NULL,
    fullName VARCHAR(150) NOT NULL,
    mobile VARCHAR(15) NOT NULL,
    email VARCHAR(50) NULL,
    address VARCHAR(150) NOT NULL,
    range VARCHAR(50) NULL DEFAULT NULL,
    time VARCHAR(50) NULL DEFAULT NULL,
    content TEXT NULL,
    PRIMARY KEY(id),
    INDEX idx_order_user(userId ASC),
    CONSTRAINT fk_order_user FOREIGN KEY(userId) REFERENCES ps17048.ps_users(id) ON DELETE CASCADE ON UPDATE CASCADE
    INDEX fk_order_status(status ASC),
    CONSTRAINT fk_order_status FOREIGN KEY(status) REFERENCES ps17048.ps_order_status(id) ON DELETE CASCADE ON UPDATE CASCADE
);




CREATE TABLE ps17048.ps_product_review(
    id BIGINT NOT NULL AUTO_INCREMENT,
    userId BIGINT NOT NULL,
    productId BIGINT NOT NULL,
    rating SMALLINT(6) NOT NULL DEFAULT 5,
    published DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    status BIGINT NOT NULL DEFAULT 0,
    content TEXT NOT NULL,
    email VARCHAR(50) NULL DEFAULT NULL,
    fullName VARCHAR(150) NULL DEFAULT NULL,
    PRIMARY KEY(id),
    INDEX idx_review_product(productId ASC),
    CONSTRAINT fk_review_product FOREIGN KEY(productId) REFERENCES ps17048.ps_product(id) ON DELETE CASCADE ON UPDATE CASCADE,
    INDEX idx_review_product_userId(userId ASC),
    CONSTRAINT fk_review_product_userId FOREIGN KEY(userId) REFERENCES ps17048.ps_users(id) ON DELETE CASCADE ON UPDATE CASCADE
);



CREATE TABLE ps17048.ps_order_item(
    id BIGINT NOT NULL AUTO_INCREMENT,
    orderId BIGINT NOT NULL,
    productId BIGINT NOT NULL,
    quantity BIGINT NOT NULL,
    PRIMARY KEY(id),
    INDEX idx_ps_order_item_productId(productId ASC),
    CONSTRAINT idx_ps_order_item_productId FOREIGN KEY(productId) REFERENCES ps17048.ps_product(id) ON DELETE CASCADE ON UPDATE CASCADE,
    INDEX idx_ps_order_item_orderId(orderId ASC),
    CONSTRAINT idx_ps_order_item_orderId FOREIGN KEY(orderId) REFERENCES ps17048.ps_order(id) ON DELETE CASCADE ON UPDATE CASCADE,
);



CREATE TABLE ps17048.ps_order_status(
    id BIGINT NOT NULL AUTO_INCREMENT,
    status  VARCHAR(50) NOT NULL,
    PRIMARY KEY(id)
);


INSERT INTO ps_order_status(status) VALUES
('Chờ xác nhận'),
('Chưa thanh toán'),
('Đã thanh toán'),
('Đang giao hàng'),
('Thành công'),
('Thất bại')





INSERT INTO ps_category(title) VALUES
('Burgers'),
('Pizza'),
('Cupcake'),
('Fast Food'),
('Salads')




INSERT INTO ps_product(thumbnail_id, title, slug, price, published) VALUES
(1, 'Effects Of Time', 'effects-of time', '50000', '2021-07-02 13:15:27'),
(2, 'Attribute Variation', 'attribute-variation', '100000', '2021-07-02 14:15:46',)
(3, 'Fried Chicken', 'fried-chicken', '80000', '2021-07-02 16:15:59')
(4, 'Printed A-Line', 'printed-a-line', '85000', '2021-07-02 16:38:13')
(5, 'Fit and Flare', 'fit-and flare', '110000', '2021-07-02 16:59:18')
(6, 'Flawless', 'flawless', '55000', '2021-07-02 17:16:26')
(7, 'Floral Print', 'floral-print', '450000', '2021-07-02 19:16:30')
(8, 'Solid Straight', 'solid-straight', '115000', '2021-07-03 13:16:58'),
(9, 'Fettle Mesh', 'fettle-mesh', '65000', '2021-07-03 13:24:01'),
(10, 'Pene Salmone', 'pene-salmone', '50000', '2021-07-03 13:35:06'),
(11, 'Mushroom Burger', 'mushroom-burger', '100000', '2021-07-03 14:17:40'),
(12, 'Bacon Burger', 'bacon-burger', '80000', '2021-07-03 14:37:45')


INSERT INTO ps_product( thumbnail, title, price) VALUES
('./assets/img/product-1-600x600.jpg','Effects Of Time',  '50000'),
('./assets/img/product-2-600x600.jpg','Attribute Variation', '100000'),
('./assets/img/product-3-600x600.jpg','Fried Chicken',  '80000'),
('./assets/img/product-4-600x600.jpg','Printed A-Line', '85000'),
('./assets/img/product-5-600x600.jpg','Fit and Flare',  '110000'),
('./assets/img/product-6-600x600.jpg','Flawless',  '55000'),
('./assets/img/product-7-600x600.jpg','Floral Print',  '450000'),
('./assets/img/product-8-600x600.jpg','Solid Straight', '115000'),
('./assets/img/product-9-600x600.jpg','Fettle Mesh',  '65000'),
('./assets/img/product-10-600x600.jpg','Pene Salmone',  '50000'),
('./assets/img/product-11-600x600.jpg','Mushroom Burger',  '100000'),
('./assets/img/product-12-600x600.jpg','Bacon Burger', '80000')

UPDATE ps_product SET content='<h4 class="ql-align-center">Được thực hiện bởi đầu bếp giỏi nhất</h4><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud tập thể dục ullamco labris nisi ut aliquip ex ea Goodsoequat. Duis aute irure dolor in repmblenderit in voluptate velit esse cillum dolore eu fugiat nulla pariesur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia Desunt</p><h4 class="ql-align-center">Nguyên liệu hàng đầu</h4><p>Chất lượng là thành phần số 1 của chúng tôi. Đó là lý do tại sao Cánh gà, Cắn gà và Topping gà nướng của chúng tôi được làm từ gà được nuôi không dùng thuốc kháng sinh và cho ăn chế độ ăn hoàn toàn từ ngũ cốc thực vật, không có phụ phẩm động vật. Thêm vào đó, Bites của chúng tôi được làm bằng 100% thịt ức gà.</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum corporis at fugit dolores quidem saepe odit illum, quisquam voluptas in ipsam voluptatibus numquam ullam cum, itaque perferendis, nisi expedita tempore.</p><h4 class="ql-align-center">Được thực hiện bởi đầu bếp giỏi nhất</h4><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud tập thể dục ullamco labris nisi ut aliquip ex ea Goodsoequat. Duis aute irure dolor in repmblenderit in voluptate velit esse cillum dolore eu fugiat nulla pariesur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia Desunt</p>'



UPDATE ps_product SET summary='Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, vel veritatis facere natus sed consectetur ducimus ea, nulla libero a inventore accusamus similique eum cum! Nesciunt accusantium inventore earum neque?'


INSERT INTO ps_product_meta(productId, key, content) VALUES
(1, 'label', 'trend'),
(2, 'label', 'hot'),
(3, 'label', 'new'),
(4, 'label', 'new'),
(6, 'label', 'trend'),
(8, 'label', 'hot'),
(9, 'label', 'trend'),
(10, 'label', 'hot'),
(12, 'label', 'new')















SELECT *
FROM ps_category ORDER BY published DESC



SELECT ps_product.* , ps_product_meta.content
FROM ps_product
INNER JOIN ps_product_meta ON ps_product.id = ps_product_meta.productId AND ps_product_meta.key = 'label'

AND ps_product_meta.content = 'hot'


SELECT ps_product.* , ps_product_meta.content
FROM ps_product
INNER JOIN ps_product_meta ON ps_product.id = ps_product_meta.productId AND ps_product_meta.key = 'label'

AND ps_product_meta.content = 'new'


SELECT ps_product.* , ps_product_meta.content
FROM ps_product
INNER JOIN ps_product_meta ON ps_product.id = ps_product_meta.productId AND ps_product_meta.key = 'label'

AND ps_product_meta.content = 'trend'

SELECT ps_product.* , ps_product_meta.content
FROM ps_product
INNER JOIN ps_product_meta ON ps_product.id = ps_product_meta.productId AND ps_product_meta.key = 'views'

ORDER BY content DESC LIMIT 5


INSERT INTO chitiet_hoa_don(ma_hang, so_luong, so_hoa_don) SELECT id, sl, 11111 AS so_hoa_don FROM cart;
INSERT INTO ps_order_item(orderId, userId, productId, quantity) SELECT sss AS orderId, userId, productId, quantity  FROM ps_cart_item WHERE userId = 19;


select ps_order.id, ps_order.userId, ps_order.published, ps_order.status ,ps_order.total, COUNT(ps_order_item.orderId) from ps_order INNER JOIN ps_order_item ON ps_order.id = ps_order_item.orderId GROUP BY ps_order_item.orderId HAVING ps_order.userId = 1