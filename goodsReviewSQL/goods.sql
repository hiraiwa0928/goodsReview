DROP TABLE IF EXISTS goods;
CREATE TABLE goods(
    id MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
    category VARCHAR(25),
    goodsName VARCHAR(400),
    imagePath VARCHAR(100),
    addUsername VARCHAR(25),
    evaluationTotal DOUBLE UNSIGNED,
    overview VARCHAR(4100),
    modified TIMESTAMP,
    commentNum MEDIUMINT UNSIGNED,
    PRIMARY KEY (id)
);
INSERT INTO goods(category, goodsName, imagePath, addUsername, evaluationTotal, overview, commentNum) VALUES("dailyNecessities", "フリクションボールペン[space]", "../changeSizeImages/20210724210953_sWyAFt6OJZ.jpg", "sample", "4.5", "インクを消すことができるボールペンです。[space][indention]URL:[space]https://www.pilot.co.jp/products/pen/ballpen/gel_ink/frixionball/[space][indention]＊履歴書のような大事な書類には使うことはできません。[space][indention]", 2);
INSERT INTO goods(category, goodsName, imagePath, addUsername, evaluationTotal, overview, commentNum) VALUES("fashion", "宇宙服[space]", "../changeSizeImages/20210724211504_rkBxzNOBHK.jpeg", "user", "1", "宇宙に行く時には絶対に必要です！地球では重いですが宇宙空間に行けばへっちゃらです！[space][indention]", 1);
INSERT INTO goods(category, goodsName, imagePath, addUsername, evaluationTotal, overview, commentNum) VALUES("appliances", "エアコン[space]", "../changeSizeImages/20210724211738_3jXBuwlWDn.jpeg", "user", "0", "寒い時にも暑い時にも味方になってくれる家電製品です！一家に一台はあったほうがいいでしょう[space][indention]", 0);