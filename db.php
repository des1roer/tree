<?php

$db = new SQLite3("src/db");
if (!$db) exit("Не удалось подключиься к базе данных!"); 