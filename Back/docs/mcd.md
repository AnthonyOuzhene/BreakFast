# MCD

TAG: tag_identifier, name
sells, 11 PRODUCT, 0N BAKERY
BAKERY: bakery_identifier, name, address, zip_code, profile_img, phone_number, rating, status, delivery_fees, delivery_time
favorites, ON USER, ON BAKERY
POST: post_identifier, title, summary, content, publication_date, author

is tagged by, 0N PRODUCT, 0N TAG
PRODUCT: product_identifier, name, price, description, picture
owns, 11 BAKERY, 0N USER
USER: user_identifier, name, password, email, role, address
write, 11 POST, 0N USER

CATEGORY: category_identifier, name
relates to, 11 PRODUCT, 0N CATEGORY
have, 1N ORDER, 0N PRODUCT
ORDER: order_identifier, total_price, order_date
can make, ON USER, 11 ORDER

# MLD

TAG ( tag_identifier, name )
BAKERY ( bakery_identifier, name, address, zip_code, profile_img, phone_number, rating, status, delivery_fees, delivery_time, user_identifier )
favorites ( user_identifier, bakery_identifier )
POST ( post_identifier, title, summary, content, publication_date, author, user_identifier )
is tagged by ( product_identifier, tag_identifier )
PRODUCT ( product_identifier, name, price, description, picture, category_identifier, bakery_identifier )
USER ( user_identifier, name, password, email, role, address )
CATEGORY ( category_identifier, name )
have ( order_identifier, product_identifier )
ORDER ( order_identifier, total_price, order_date, user_identifier )