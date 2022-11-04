CREATE TABLE IF NOT EXISTS `users` (
    `id` int(11) not NULL,
    `firstname` varchar(256) NOT NULL,
    `lastname` varchar(256) NOT NULL,
    `email` varchar(256) NOT NULL,
    `password` varchar(2048) NOT NULL,
    `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `users` ADD PRIMARY KEY (`id`);
ALTER TABLE `users` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;