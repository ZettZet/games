<?php

require __DIR__ . '/../vendor/autoload.php';

use CustomerCartRepo;
use VC;

$HOST = getenv("HOST");
$USER = getenv("USER");
$DB_NAME = getenv("DB_NAME");
$PWD = getenv("PWD");
$GAMES_TABLE = getenv("GAMES");
$CUSTOMERS_TABLE = getenv("CUSTOMERS");
$CUSTOMER_CART_TABLE = getenv("CUSTOMER_CART");
$CARTS_TABLE = getenv("CARTS");

VC::set('CCR', new CustomerCartRepo($HOST, $USER, $PWD, $CUSTOMER_CART_TABLE, $GAMES_TABLE));
