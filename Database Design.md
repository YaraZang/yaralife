# Database Design
## Database Name
Currently name is __users__, we might want to create a new one and change the name to something else, ex __market_place__

## Tables
### Users
```sql
CREATE TABLE IF NOT EXISTS users(
    uid varchar(255) NOT NULL,
    user_password varchar(255) NOT NULL,
    first_name varchar(255) NOT NULL,
    last_name varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    home_address varchar(255),
    home_phone varchar(255),
    cell_phone varchar(255)
);
```
Besides username/password, names can not be null cuz they will be deplayed, email is needed for a test feature. The rest fields should not be required.

| uid        | user_password           | first_name  | last_name  | email  | home_address  | home_phone  |cell_phone  |
| -----------|:-----------------------:| -----------:| ----------:| ------:| -------------:| -----------:|-----------:|
| admin | admin|Jane|Doe|jane@gmail.com|1 Washington Sq, San Jose| (650) 123-4567|(650) 123-4567

### Products
```sql
CREATE TABLE IF NOT EXISTS products(
    product_id varchar(255) NOT NULL,
    product_name varchar(255) NOT NULL,
    product_ratings decimal(2,1) NOT NULL
);
```
| product_id        | product_name           | product_ratings  |
| -----------|:-----------------------:| -----------:|
| movie1 | Thor: Ragnarok |5.00|

### Comments
```sql
CREATE TABLE IF NOT EXISTS products(
    comment_id varchar(255) NOT NULL,
    product_id varchar(255) NOT NULL,
    uid varchar(255) NOT NULL,
    comment_content varchar(255) NOT NULL,
    product_ratings decimal(2,1) NOT NULL
);
```
| product_id        | comment_id           | uid  |comment_content|product_ratings
| -----------|:-----------------------:| -----------:| -----------:| -----------:|
| movie1 | commentID |admin|Thor: Ragnarok is awesome!|5.0