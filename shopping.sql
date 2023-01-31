CREATE TABLE users (
	id INT PRIMARY KEY AUTO_INCREMENT,
	username VARCHAR(255) NOT NULL UNIQUE,
	password VARCHAR(255) NOT NULL,
	email VARCHAR(255) NOT NULL,
	is_admin TINYINT(1) NOT NULL DEFAULT 0
);

CREATE TABLE categories (
	id INT PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL
);

CREATE TABLE products (
	id INT PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	price DECIMAL(10, 2) NOT NULL,
	sales INT NOT NULL DEFAULT 0,
	description TEXT,
	category_id INT,
	image_path varchar(255) NOT NULL,
	FOREIGN KEY (category_id) REFERENCES categories(id)
);

CREATE TABLE cart (
	id INT NOT NULL AUTO_INCREMENT,
	user_id INT NOT NULL,
	product_id INT NOT NULL,
	quantity INT NOT NULL DEFAULT 1,
	PRIMARY KEY (id),
	FOREIGN KEY (user_id) REFERENCES users(id),
	FOREIGN KEY (product_id) REFERENCES products(id)
);

CREATE TABLE order_status (
	id INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(32) NOT NULL,
	PRIMARY KEY (id)
);

CREATE TABLE orders (
	id INT PRIMARY KEY AUTO_INCREMENT,
	user_id INT NOT NULL,
	total_price DECIMAL(10, 2) NOT NULL,
	status_id INT NOT NULL DEFAULT 1,
	FOREIGN KEY (user_id) REFERENCES users(id),
	FOREIGN KEY (status_id) REFERENCES order_status(id)
);

CREATE TABLE order_items (
	id INT PRIMARY KEY AUTO_INCREMENT,
	order_id INT NOT NULL,
	product_id INT NOT NULL,
	quantity INT NOT NULL,
	price DECIMAL(10, 2) NOT NULL,
	FOREIGN KEY (order_id) REFERENCES orders(id),
	FOREIGN KEY (product_id) REFERENCES products(id)
);

CREATE TABLE comments (
	id INT PRIMARY KEY AUTO_INCREMENT,
	user_id INT NOT NULL,
	product_id INT NOT NULL,
	content TEXT NOT NULL,
	rating INT NOT NULL,
	FOREIGN KEY (user_id) REFERENCES users(id),
	FOREIGN KEY (product_id) REFERENCES products(id)
);

CREATE TABLE promotions (
	id INT PRIMARY KEY AUTO_INCREMENT,
	title VARCHAR(255) NOT NULL,
	description TEXT,
	start_date DATE NOT NULL
);

INSERT INTO
	users (email, username, password, is_admin)
VALUES
	('user1@qq.com', '往事随风', 'password1', 1),
	('user2@qq.com', '浅唱低吟', 'password2', 0),
	('user3@qq.com', '花开半夏', 'password3', 0),
	('user4@qq.com', '繁华落尽', 'password4', 0),
	('user5@qq.com', '落花有意', 'password5', 0),
	('user6@qq.com', '浅笑安然', 'password6', 0),
	('user7@qq.com', '一世浮华', 'password7', 0),
	('user8@qq.com', '半壶纱', 'password8', 0),
	('user9@qq.com', '清风徐来', 'password9', 0),
	('user10@qq.com', '繁华落寞', 'password10', 0);

INSERT INTO
	categories (name)
VALUES
	('家用电器'),
	('手机数码'),
	('电脑办公'),
	('家居家装'),
	('服饰鞋帽');

INSERT INTO
	products (
		name,
		category_id,
		price,
		sales,
		description,
		image_path
	)
VALUES
	(
		'电视机',
		1,
		1999.99,
		100,
		'50英寸智能电视',
		'assets/images/products/product1.jpg'
	),
	(
		'空调',
		1,
		2999.99,
		50,
		'变频冷暖空调',
		'assets/images/products/product2.jpg'
	),
	(
		'手机',
		2,
		999.99,
		200,
		'5G智能手机',
		'assets/images/products/product3.jpg'
	),
	(
		'平板电脑',
		2,
		1499.99,
		150,
		'10英寸平板电脑',
		'assets/images/products/product4.jpg'
	),
	(
		'台式电脑',
		3,
		3999.99,
		80,
		'i5处理器台式电脑',
		'assets/images/products/product5.jpg'
	),
	(
		'笔记本电脑',
		3,
		4999.99,
		60,
		'i7处理器笔记本电脑',
		'assets/images/products/product6.jpg'
	),
	(
		'沙发',
		4,
		999.99,
		120,
		'真皮沙发',
		'assets/images/products/product7.jpg'
	),
	(
		'床',
		4,
		1499.99,
		90,
		'双人床',
		'assets/images/products/product8.jpg'
	),
	(
		'衣柜',
		4,
		1999.99,
		70,
		'大衣柜',
		'assets/images/products/product9.jpg'
	),
	(
		'T恤',
		5,
		99.99,
		300,
		'纯棉T恤',
		'assets/images/products/product10.jpg'
	);

INSERT INTO
	order_status (name)
VALUES
	('待处理'),
	('处理中'),
	('已发货'),
	('已完成'),
	('已取消');

INSERT INTO
	promotions (title, description, start_date)
VALUES
	(
		'新年特惠',
		'新年到，商城也有新气象！本月内享受全场8折优惠，购物更划算！',
		'2022-01-31'
	),
	(
		'春季大促',
		'春天到了，温暖回来！本月内享受全场7折优惠，购物更美好！',
		'2022-03-31'
	),
	(
		'夏日特价',
		'夏天来了，清凉到！本月内享受全场6折优惠，购物更舒心！',
		'2022-06-30'
	),
	(
		'秋季促销',
		'秋天来了，又是一年美好的季节！本月内享受全场5折优惠，购物更愉快！',
		'2022-09-30'
	),
	(
		'冬季特惠',
		'冬天来了，暖暖迎接！本月内享受全场4折优惠，购物更温馨！',
		'2022-12-31'
	),
	(
		'周末特惠',
		'周末到了，放松一下！本周末内享受全场9折优惠，购物更轻松！',
		'2022-01-02'
	),
	(
		'黑色星期五',
		'黑色星期五到了，购物狂欢！本周五内享受全场7折优惠，购物更省心！',
		'2022-11-25'
	);