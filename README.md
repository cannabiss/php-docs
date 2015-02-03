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
        - `date_default_timezone_set` - timezone sets used in the system default;
        - `array db` - sets the connection to SQL database;

- `/common`:
Contains all the basic set of classes and functions needed to operate the system.
    - `auth.php`: Class "Auth" contains functionality necessary for authorization in sisteime;
    - `common.php`: Basic functionality;
    - `components.php`: Class "Components", which forms the basic building blocks of the system interface;
    - `db.php`: Класс "database" - Set the basic functions work with a MySQL database;
    - `incFiles.php`: Class "IncFiles", designed for fast-loading the required modules;
    - `managerUrl.php`: Class "managerUrl", required for the current page and redirect;
    - ``menu.php`: Class "Menu", responsible for the formation of a dynamic menu pages;
    - `model.php`: Class "Model", which describes the basic functions of building models;
    - `route.php`: Class "Route", necessary for the implementation of the routing system;
    - `tableManager.php`: Class "tableManager", necessary to dynamically build tables in the system;
    - `view.php`: Class "View", required to load templates and static blocks to display;