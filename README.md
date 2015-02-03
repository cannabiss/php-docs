__The system of reference of the working documentation.__

__Used models:__

- Model-View-Controller;

__Destination:__

- Expeditious conduct of the working documents;

__Used programming languages:__
    
- *PHP5.5*;
- *JavaScript*;

__Libraries:__

- *Bootstrap 3*;
- *JQuery*;

__Used database:__

- *MySql*;

__Description catalogs:__

- `/:`
    - `.gitignore`: Configuration file to ignore directories and files Git version control;
    - `index.php`: Starting a project file (read the configuration file, the database connection, load the appropriate modules);
    - `composer.json`: Configuration file package composer describing dependencies and autoloader;

- `/sqlbase`:
    - `db_query`: File maintain the relevance of the project database (contains all the SQL-queries required to bring the database schema to the state Fidler);
    - `documents.sql`: SQL database dump file with the basic structure of the project;

- `/libs`:
    - `js`: The directory containing the necessary work for those functions or, JavaScript files;
    - `bootstrap (css, fonts, js)`: Library Bootstrap 3.0, neoyuhodimaya to build an interface system;

- `/configs`:
    - `config-sample.inc`: A sample configuration file:
        - `date_default_timezone_set - timezone sets used in the system default;
        - `array db` - задает параметры соединения с SQL базой;

- `/common`:
Содержит в себе весь базовый набор классов и функций, необходимых для работы системы.
    - `auth.php`: Класс "Auth" содержащий функционал, необходимый для авторизации в систеиме;
    - `common.php`: Базовй функционал;
    - `components.php`: Класс "Components", формирующий основные блоки интерфейса системы;
    - `db.php`: Класс "database" - Набор основных функций работы с базой данных MySQL;
    - `incFiles.php`: Класс "IncFiles", предназначенный для быстрой подгрузки необходимых модулей;
    - `managerUrl.php`: Класс "managerUrl", необходимый для получения текущих страниц и редиректа;
    - ``menu.php`: Класс "Menu", отвечающий за динамическое формирование меню страниц;
    - `model.php`: Класс "Model", описывающий базовые функции построения моделей;
    - `route.php`: Класс "Route", необходимый для осуществления роутинга в системе;
    - `tableManager.php`: Класс "tableManager", необходимый для динамического построения таблиц в системе;
    - `view.php`: Класс "View", необходимый для подгрузки шаблонов и статичных блоков для отображения;