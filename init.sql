CREATE DATABASE IF NOT EXISTS laravel DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE laravel;

CREATE TABLE IF NOT EXISTS `currency_rates`
(
    `id`         BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `valute_id`  VARCHAR(10)    NOT NULL,
    `num_code`   INT            NOT NULL,
    `char_code`  VARCHAR(3)     NOT NULL,
    `nominal`    INT            NOT NULL,
    `name`       VARCHAR(255)   NOT NULL,
    `value`      DECIMAL(10, 4) NOT NULL,
    `date`       DATE           NOT NULL,
    `created_at` TIMESTAMP      NULL DEFAULT NULL,
    `updated_at` TIMESTAMP      NULL DEFAULT NULL,
    UNIQUE KEY `currency_date_unique` (`valute_id`, `date`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4
  COLLATE = utf8mb4_unicode_ci;
