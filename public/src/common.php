<?php
define("ID_NEWS", 1);
define("ID_GAMES", 7);
define("ID_PROMOS", 10);
define("ID_TAXONOMIES", 3);
    define("ID_TAGS", 4);
    define("ID_SLIDER", 58);
    define("ID_COUNTRIES", 43);
    define("ID_COMPILIANCE_LICENSES", 49);
define("ID_NOTIFICATIONS", 11);
define("ID_CHATS", 17);
define("ID_ROADMAP", 14);


if($_SERVER["REMOTE_ADDR"]=="127.0.0.1"){
    define("ID_GAME_PARENTS", 92);
}else{
    define("ID_GAME_PARENTS", 158);
}

