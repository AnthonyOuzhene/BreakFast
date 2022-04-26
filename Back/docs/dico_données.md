# Dictionnaire de données

## USER (`utilisateur`)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|user_identifier|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|User ID|
|name|VARCHAR(64)|NOT NULL,|User name|
|password|VARCHAR(255)|NOT NULL|Hashed password|
|email|VARCHAR(125)|NOT NULL|User email to login|
|role|VARCHAR(64)|NOT NULL|User role for security purposes|
|address|VARCHAR(125)|NOT NULL|User address|
|zip_code|INT|NOT NULL|User address|
|bakery_id|ENTITY|UNSIGNED, NOT NULL|Bakery ID to connect the user for admin purposes|

## BAKERY (`boulangerie`)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|bakery_identifier|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|Bakery ID|
|name|VARCHAR(64)|NOT NULL,|Bakery name|
|address|VARCHAR(125)|NOT NULL|Bakery address|
|profile_img|VARCHAR(125)|NOT NULL|Picture URL|
|phone_number|VARCHAR(125)|NOT NULL|Bakery phone number|
|rating|INT|NULLABLE|Bakery rating|
|status|INT|UNSIGNED, NOT NULL| Bakery open or closed |
|delivery_fees|FLOAT|UNSIGNED, NOT NULL| money cost for delivery products|
|delivery_time|INT|UNSIGNED, NOT NULL| time cost to get the command |
|user_id|ENTITY|UNSIGNED, NOT NULL| User ID to connect to Bakery|

## CATEGORY (`catégories`) 

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|category_identifier|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|Category ID|
|name|VARCHAR(64)|NOT NULL,|Category name|


## PRODUCT (`produits`)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|product_identifier|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|Product ID|
|name|VARCHAR(64)|NOT NULL,|Product name|
|price|FLOAT|NOT NULL|Product price|
|description|VARCHAR(125)|NOT NULL|Product description|
|picture|VARCHAR(64)|NOT NULL|Product image|
|category_id|ENTITY|UNSIGNED, NOT NULL| Category ID to connect to Product

## TAG (`label`)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|tag_identifier|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|Tag ID|
|name|VARCHAR(64)|NOT NULL,|Tag name|

## ORDER (`commande`)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|order_identifier|INT|PRIMARY KEY, NOT NULL, UNSIGNED, AUTO_INCREMENT|Tag ID|
|total_price|VARCHAR(64)|NOT NULL,|Total price payed in order|
|order_date|TIMESTAMP|NOT NULL, DEFAULT CURRENT_TIMESTAMP|Order date|
|user_id|ENTITY|NOT NULL| User ID to connect to Order

## RELATION ENTRE ENTITIES(`association`)

|Champ|Type|Spécificités|Description|
|-|-|-|-|
|product_tag|ENTITY|PRIMARY KEY, NOT NULL, UNSIGNED|le tag du produit|
|user_bakery|ENTITY|PRIMARY KEY, NOT NULL, UNSIGNED|le propriétaire de la boulangerie
|order_product|ENTITY|PRIMARY KEY, NOT NULL, UNSIGNED|la commande du produit|