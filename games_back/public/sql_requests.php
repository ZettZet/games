<?php

function construct_connection_string_sql(string $host, string $name_table): string
{
    return "mysql:host=$host;dbname=$name_table";
}

function construct_fetch_all_sql(string $name_table): string
{
    return "SELECT * FROM $name_table LIMIT (?) OFFSET (?);";
}

function construct_fetch_by_id_sql(string $name_table): string
{
    return "SELECT * FROM $name_table WHERE id=(?) LIMIT (?) OFFSET (?);";
}

function construct_fetch_by_price_sql(string $name_table): string
{
    return "SELECT * FROM $name_table WHERE price>=(?) AND price<=(?);";
}

function construct_fetch_games_by_customer_cart_sql(string $left_name_table, string $right_name_table): string
{
    return "SELECT * FROM $left_name_table AS l WHERE l.id=r.game_id LEFT JOIN $right_name_table AS r ON r.customer_id=(?);";
}

function construct_update_sql(string $name_table, string $class_name): string
{
    $vars = get_class_vars($class_name);
    unset($vars['id']);
    $vars = array_keys($vars);

    $sql = "UPDATE $name_table SET";

    foreach ($vars as $var) {
        $sql .= " $var=:$var ";
    }

    $sql .= "WHERE id=:id;";

    return $sql;
}

function construct_add_sql(string $name_table, string $class_name): string
{
    $vars = get_class_vars($class_name);
    unset($vars['id']);
    $vars = array_keys($vars);

    $sql_left = "INSERT $name_table (";
    $sql_right = "VALUES (";

    foreach ($vars as $var) {
        $sql_left .= "$var, ";
        $sql_right .= ":$var, ";
    }

    $sql_left .= ')';
    $sql_right .= ')';

    return $sql_left . $sql_right . ';';
}

function construct_delete_sql(string $name_table): string
{
    return "DELETE FROM $name_table WHERE id=(?);";
}

function cunstruct_delete_game_sql(string $name_table): string
{
    return "DELETE FROM $name_table WHERE customer_id=(?) AND game_id=(?);";
}
