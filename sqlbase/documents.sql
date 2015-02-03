-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Мар 04 2014 г., 22:03
-- Версия сервера: 5.5.32-0ubuntu0.12.10.1
-- Версия PHP: 5.5.8-3+sury.org~quantal+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `documents`
--

-- --------------------------------------------------------

--
-- Структура таблицы `chapter`
--

CREATE TABLE IF NOT EXISTS `chapter` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `section_id` int(255) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `date_create` date NOT NULL,
  `date_update` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `chapter`
--

INSERT INTO `chapter` (`id`, `section_id`, `name`, `description`, `date_create`, `date_update`) VALUES
(1, 1, 'Описание возможностей системы.', 'Основные возможности и функционал системы.', '2014-02-25', '2014-03-03'),
(2, 1, 'Компоненты для работы системы.', 'nginx (apache2), php5, http, twig, yaml, curl...', '2014-02-25', '2014-03-01'),
(3, 2, 'Установка и настройка системы.', 'Последовательная устанвовка и настройка системы.', '2014-02-25', '2014-02-28');

-- --------------------------------------------------------

--
-- Структура таблицы `db_version`
--

CREATE TABLE IF NOT EXISTS `db_version` (
  `current_version` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `db_version`
--

INSERT INTO `db_version` (`current_version`) VALUES
('1');

-- --------------------------------------------------------

--
-- Структура таблицы `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chapter_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `date_create` date DEFAULT NULL,
  `date_update` date DEFAULT NULL,
  `item_text` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `author` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `author_id` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `items`
--

INSERT INTO `items` (`id`, `chapter_id`, `name`, `description`, `date_create`, `date_update`, `item_text`, `author`, `author_id`) VALUES
(1, 1, 'Настройка nginx+php-fpm на Debian 6-7', 'Требования\r\n\r\nPHP версии не ниже 5.4\r\nРасширения PHP: mbstring,iconv,json,http,interbase. Не обязательные но рекомендуемые: apc,curl,fileinfo,igbinary,yaml,twig\r\nFirebird не ниже 2.1, желательно 2.5\r\n', '2014-02-25', '2014-03-03', 'Установка NGINX и PHP\r\n\r\n1. Редактировать список репозиториев сервера. В файл /etc/apt/sources.list добавить следующие строки:\r\ndeb http://packages.dotdeb.org squeeze all;\r\ndeb-src http://packages.dotdeb.org squeeze all;\r\ndeb http://packages.dotdeb.org squeeze-php54 all;\r\ndeb-src http://packages.dotdeb.org squeeze-php54 all;\r\n2. Обновить список пакетов:''\r\napt-get update; apt-get upgrade;\r\n3. Установить nginx:\r\napt-get install nginx;\r\n4. Установить php 5.4:\r\napt-get install php5-cli php5-cgi php5-common php-pear php5-fpm;\r\nНастройка NGINX\r\n\r\n1. Запустить nginx-сервер: /etc/init.d/nginx start\r\n2. Заходим в браузер и вводим его IP-адрес. Если видим «Welcome to nginx!» - значит сервер установился.\r\n3. Создать директорию для настройки x1db-php.\r\n4. Пусть база находится в папке /var/www/sqlbase, а x1db-php в папке /var/www/x1db-php.\r\n\r\n5. В папке /etc/init.d/nginx/sites-available создать конфигурационный файл для x1db-php. Php будет запускаться через сокеты. Поэтому конфигурационный файл создаем следующего содержания:\r\n\r\nserver {\r\nroot /var/www/x1db-php/public;\r\nindex index.php;\r\nserver_name name_server.ru;\r\ntry_files $uri $uri/ @php_index;\r\nerror_log /var/www/x1db-php/logs/error.log;\r\nlocation ~ ^/app/([0-9a-zA-Z]+)/(.+)$ {\r\nalias /var/www/x1db/webapps/$1/public/$2;\r\nbreak;\r\n}\r\nlocation @php_index {\r\nfastcgi_pass unix:/var/run/php-fastcgi/x1db-fpm.socket;\r\nfastcgi_index index.php;\r\ninclude fastcgi_params;\r\nfastcgi_param SCRIPT_FILENAME /var/www/portal/x1db-php/public/index.php;\r\nfastcgi_ignore_client_abort off;\r\n}\r\nlocation ~ \\.php$ {\r\nfastcgi_pass unix:/var/run/php-fastcgi/x1db-fpm.socket;\r\ninclude fastcgi_params;\r\nfastcgi_ignore_client_abort off;\r\n}\r\nlocation ~ /\\.ht {\r\ndeny all;\r\n}\r\n}\r\nНастройка PHP5-FPM\r\n\r\n1. Отключаем одну мелкую уязвимость связки PHP+nginx. Для этого прописываем в /etc/php5/fpm/php.ini:\r\ncgi.fix_pathinfo=0.\r\n2. Редактируем конфигурационный файл пула, используемый по умолчанию /etc/php5/fpm/pool.d/www.conf :\r\n[www] #Имя пула;\r\nuser = www-data #Пользователь\r\ngroup = www-data #Группа\r\nlisten = /var/run/php5-fpm.socket #Где слушать будем сокеты\r\npm = dynamic #Режим балансировки (динамический)\r\npm.max_children = 7 #Максимальное количество дочерних процессов\r\npm.start_servers = 3 # Количество дочерних процессов, стартующих сразу при загрузке сервера. Т.к. время запуска каждого нового процесса отлично от нулевого, то выбираем значение больше 1, не смотря на экономию ресурсов.\r\npm.min_spare_servers = 3 # Минимальное чисто простаивающих процессов. Должен согласовываться по логике с предыдущими при экономии ресурсов будет удобно pm.start_servers = pm.min_spare_servers.\r\npm.max_spare_servers = 4 # Максимальное чисто простаивающих процессов. Естественно, что не более чем pm.max_children и не менее pm.min_spare_servers. Остальные будут выгружены.\r\nrequest_slowlog_timeout = 5s # Если скрипт будет выполняться больше указанного времени, то отладочная информация по нему будет записана в файл "медленных" запросов.\r\nslowlog = /var/log/php-slow.log # Определяет путь к файлу "медленных" запросов (обязательный параметр, в случае определения request_slowlog_timeout)\r\n3. Создаем отдельный пулл для x1db : nano /etc/php5/fpm/pool.d/x1db.conf :\r\n[x1db]\r\nuser = www-data\r\ngroup = www-data\r\nlisten = /var/run/x1db-fpm.sock\r\npm = dynamic\r\npm.max_children = 100\r\npm.start_servers = 6\r\npm.min_spare_servers = 6\r\npm.max_spare_servers = 10\r\nrequest_slowlog_timeout = 7s\r\nslowlog = /var/log/x1db-slow.log\r\n4. Выполняем рестарт php5-fpm : service php5-fpm restart .\r\n5. Выполняем рестарт nginx : service nginx restart .\r\nНастройка X1DB\r\n\r\n1. Распаковать архив с дистрибутивом (или настроить репозиторий hg) в папку(для примера будем использовать /var/www/x1db-php).\r\n2. Установить Firebird: apt-get install firebird2.5-super и настроить.\r\n3. Вводим ip-фдрес сервера/cgi/test.php и выполняем тесты на совместимость с установленным окружением. Если какой-либо тест провалился, то необходимо донастроить php. Если выдаются предупреждения (блоки желтого цвета), то их можно пропустить.\r\n4. Настроить проект. Проект представляет из себя конкретную БД со своими настройками, скриптами, обработками и отчетами. Чтобы создать новый проект необходимо создать папку проекта в /var/www/x1db/projects. Например, создадим проект xp: /var/www/x1db-php/projects/xp . В папке проекта создаем папку configs и в ней создаем конфигурационный файл project.yaml , примерно следующего содержания:\r\nproject:\r\nalias: Портал\r\ndb:\r\nadapter: Firebird\r\ndbname: /var/www/x1db-php/sqlbase/xp.fdb\r\n5. Настроить x1db-php, для этого создать новый файл /var/www/x1db-php/configs/web.yaml (за основу можно взять web-sample.yaml в этой же папке).\r\nВ секции routes указываются под которыми хостами будут доступны приложения и с какими проектами они будут связаны.\r\n#режим работы. development - режим отладки\r\n\r\ndevelopment:\r\n\r\n#базовые маршруты для определения приложения\r\n\r\n#с каждым приложением может связывается свои dns адреса и базовый путь: например для WebPont /wp\r\n\r\nroutes:\r\n\r\nlocalhost:\r\nprojects:\r\n- eservice\r\n- xp\r\napps:\r\n/: eservice\r\n/xp: xp\r\ndefault:\r\n/: eservice\r\n/xp : xp\r\n#настройки приложений - переопределяются в /webapps/../configs/app.yaml\r\napps:\r\neservice:\r\nxp:\r\n#боевой режим\r\nproduction:\r\n_extend: development', 'Sergey Schetkin', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `section`
--

CREATE TABLE IF NOT EXISTS `section` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `date_create` date NOT NULL,
  `date_update` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `section`
--

INSERT INTO `section` (`id`, `user_id`, `name`, `description`, `date_create`, `date_update`) VALUES
(1, 1, 'x1db fraemwork', 'Описание основного функционала фраемворка, его возможностей, функций. Настройка и установка системы. Компоненты, необходимые для работы системы.', '2014-02-25', '2014-03-01'),
(2, 1, 'WebPoint', 'Описание системы. Установка и настройка.', '2014-02-25', '2014-03-01'),
(3, 1, 'Passport Manager', 'Get Involved\r\nGetting involved in the MongoDB community is a great way to build relationships with other talented engineers, increase awareness for the interesting work that you are doing, sharpen your skills, or give back. Here are some of the ways that you can contribute to the MongoDB ecosystem.\r\n\r\nDiscuss MongoDB through Community Forums\r\n\r\nDiscuss, learn about, and get help with MongoDB through community-supported forums. We also offer office hours and paid support options.\r\n\r\nView answered Stack Overflow questions\r\nIRC Chat and Support\r\nMongoDB User Forum\r\nMongoDB Dev Forum, for those developing drivers and tools, or who are contributing to the MongoDB codebase itself.\r\nJoin (or Start) a MongoDB User Group\r\n\r\nMongoDB User Groups (MUGs) are a great way to network, learn from one another about MongoDB best practices, and have fun. There are dozens of MUGs on every continent. If there’s not a MUG in your area, contact us and we’ll help you get one started.\r\n\r\nFind a user group near you\r\nContribute to the Docs\r\n\r\nWe run the MongoDB docs like an open source project. The docs are posted in a public repo on Github, and you can submit changes by making a pull request. We encourage you to make improvements, write tutorials, or expand sections.\r\n\r\nLearn more about contributing to the docs\r\nWrite Code\r\n\r\nOpen source projects benefit from the contributions of the developer community. Take a look at our bug tracker and consider submitting a patch for the core server or one of our drivers. Or build tools that help other developers use MongoDB more effectively, such as object document mappers, admin UIs, integration with other open source technologies, and more.\r\n\r\nLearn more about contributing to the MongoDB core server\r\nLearn more about contributing to MongoDB drivers\r\nShare MongoDB\r\n\r\nIf you love MongoDB, consider telling others about it.\r\n\r\nTell your story at a company tech talk, present at your local user group, or submit a talk proposal about how you are using MongoDB.\r\nIf you are using MongoDB in production, become a public reference for MongoDB by getting listed on our production deployments page.\r\nAttend a MongoDB Sponsored Event\r\n\r\nMongoDB sponsors NoSQL events all around the world. Join other developers and IT professionals at conferences and workshops.\r\n\r\nCheck out the next event in your area', '2014-03-03', '2014-03-03');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `surname` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `login` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  `mail` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_birth` date DEFAULT NULL,
  `country` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `specialization` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `login`, `is_admin`, `mail`, `password`, `date_birth`, `country`, `city`, `specialization`) VALUES
(1, 'Sergey', 'Shchetkin', 'admin', 1, 'mrschetkin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '1988-10-29', 'Russia', 'Pskov', 'PHP- developer'),
(2, 'Test', 'test', 'user', NULL, 'test@mail.ru', 'c4ca4238a0b923820dcc509a6f75849b', '1999-01-09', 'China', 'Gonkong', 'web-designer');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
