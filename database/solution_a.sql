-- 1. Li?t kê các hóa ??n c?a khách hàng
SELECT users.user_id, users.user_name, orders.order_id 
FROM users 
JOIN orders ON users.user_id = orders.user_id;

-- 2. Li?t kê s? l??ng các hóa ??n c?a khách hàng
SELECT users.user_id, users.user_name, COUNT(orders.order_id) AS so_don_hang 
FROM users 
LEFT JOIN orders ON users.user_id = orders.user_id 
GROUP BY users.user_id, users.user_name;

-- 3. Li?t kê thông tin hóa ??n
SELECT orders.order_id, COUNT(order_details.product_id) AS so_san_pham 
FROM orders 
JOIN order_details ON orders.order_id = order_details.order_id 
GROUP BY orders.order_id;

-- 4. Li?t kê thông tin mua hàng c?a ng??i dùng
SELECT users.user_id, users.user_name, orders.order_id, products.product_name 
FROM users 
JOIN orders ON users.user_id = orders.user_id 
JOIN order_details ON orders.order_id = order_details.order_id 
JOIN products ON order_details.product_id = products.product_id 
ORDER BY orders.order_id;

-- 5. Li?t kê 7 ng??i dùng có s? l??ng ??n hàng nhi?u nh?t
SELECT TOP 7 users.user_id, users.user_name, COUNT(orders.order_id) AS so_luong_don_hang 
FROM users 
JOIN orders ON users.user_id = orders.user_id 
GROUP BY users.user_id, users.user_name 
ORDER BY so_luong_don_hang DESC;

-- 6. Li?t kê 7 ng??i dùng mua s?n ph?m có tên 'Samsung' ho?c 'Apple'
SELECT DISTINCT users.user_id, users.user_name, orders.order_id, products.product_name 
FROM users 
JOIN orders ON users.user_id = orders.user_id 
JOIN order_details ON orders.order_id = order_details.order_id 
JOIN products ON order_details.product_id = products.product_id 
WHERE products.product_name LIKE '%Samsung%' OR products.product_name LIKE '%Apple%';

-- 7. Li?t kê danh sách mua hàng c?a user v?i t?ng ti?n m?i ??n hàng
SELECT users.user_id, users.user_name, orders.order_id, SUM(products.product_price) AS tong_tien 
FROM users 
JOIN orders ON users.user_id = orders.user_id 
JOIN order_details ON orders.order_id = order_details.order_id 
JOIN products ON order_details.product_id = products.product_id 
GROUP BY users.user_id, users.user_name, orders.order_id;

-- 8. Li?t kê m?i user ch? có 1 ??n hàng giá tr? l?n nh?t
SELECT user_id, user_name, order_id, tong_tien FROM (
    SELECT users.user_id, users.user_name, orders.order_id, SUM(products.product_price) AS tong_tien, 
           RANK() OVER (PARTITION BY users.user_id ORDER BY SUM(products.product_price) DESC) AS rank_order 
    FROM users 
    JOIN orders ON users.user_id = orders.user_id 
    JOIN order_details ON orders.order_id = order_details.order_id 
    JOIN products ON order_details.product_id = products.product_id 
    GROUP BY users.user_id, users.user_name, orders.order_id
) AS ranked_orders WHERE rank_order = 1;

-- 9. Li?t kê m?i user ch? có 1 ??n hàng giá tr? nh? nh?t
SELECT user_id, user_name, order_id, tong_tien FROM (
    SELECT users.user_id, users.user_name, orders.order_id, SUM(products.product_price) AS tong_tien, 
           RANK() OVER (PARTITION BY users.user_id ORDER BY SUM(products.product_price) ASC) AS rank_order 
    FROM users 
    JOIN orders ON users.user_id = orders.user_id 
    JOIN order_details ON orders.order_id = order_details.order_id 
    JOIN products ON order_details.product_id = products.product_id 
    GROUP BY users.user_id, users.user_name, orders.order_id
) AS ranked_orders WHERE rank_order = 1;

-- 10. Li?t kê m?i user ch? có 1 ??n hàng có s? s?n ph?m nhi?u nh?t
SELECT user_id, user_name, order_id, so_san_pham FROM (
    SELECT users.user_id, users.user_name, orders.order_id, COUNT(order_details.product_id) AS so_san_pham, 
           RANK() OVER (PARTITION BY users.user_id ORDER BY COUNT(order_details.product_id) DESC) AS rank_order 
    FROM users 
    JOIN orders ON users.user_id = orders.user_id 
    JOIN order_details ON orders.order_id = order_details.order_id 
    GROUP BY users.user_id, users.user_name, orders.order_id
) AS ranked_orders WHERE rank_order = 1;