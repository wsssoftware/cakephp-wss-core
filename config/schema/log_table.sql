CREATE TABLE `logs`
(
    `id`         bigint(20) NOT NULL AUTO_INCREMENT,
    `type`       varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci  NOT NULL,
    `message`    text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    `summary`    varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    `context`    text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
    `ip`         varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
    `hostname`   varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
    `uri`        text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
    `refer`      text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
    `user_agent` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
    `count`      int(10) NULL DEFAULT NULL,
    `created`    datetime NULL DEFAULT NULL,
    PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 813 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;
