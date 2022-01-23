DROP TABLE IF EXISTS goodsReview;
CREATE TABLE goodsReview(
    goodsId MEDIUMINT UNSIGNED,
    username VARCHAR(25),
    evaluation TINYINT UNSIGNED,
    comment VARCHAR(4100),
    postedDate TIMESTAMP
);
INSERT INTO goodsReview(goodsId, username, evaluation, comment, postedDate) VALUES(1, "sample", 4, "ほんとうにインクが消えました！すごく便利です！！[space][indention]でも、消した後がすこし汚くなってしまいます。[space][indention]", "2021-07-24 21:10:47");
INSERT INTO goodsReview(goodsId, username, evaluation, comment, postedDate) VALUES(1, "user", 5, "いろんな色があって良かったです！[space][indention]", "2021-07-24 21:12:45");
INSERT INTO goodsReview(goodsId, username, evaluation, comment, postedDate) VALUES(2, "user", 1, "商品を買ったのですが、結局宇宙に行く機会なんてなかったです笑[space][indention]", "2021-07-24 21:16:04");