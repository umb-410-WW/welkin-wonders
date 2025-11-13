
```
CREATE TABLE Product {
	id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR(255) UNIQUE,
	price DECIMAL (10, 2),
	description VARCHAR(255),
	quantity INT,
	image_path VARCHAR(255)
}
```

```
CREATE TABLE Customer {
	id INT AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(255) UNIQUE,
	password VARCHAR(255),
}
``` 

```
CREATE TABLE Cart_Item {
	item_id INT AUTO_INCREMENT PRIMARY KEY,
	product_id INT,
	customer_id INT,
	
	FOREIGN KEY (product_id) REFERENCES Product(id),
	FOREIGN KEY (customer_id) REFERENCES Customer(id),
}
```