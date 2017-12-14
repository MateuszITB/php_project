<?php
_once __DIR__ . '/../vendor/autoload.php';

use Itb\StoreRepository;

$storeRepository = new StoreRepository();

$storeRepository->dropTable();
$storeRepository->createTable();

//$productRepository->deleteAll();

$storeRepository->insert('item1', 69.99);
$storeRepository->insert('item2', 9.99);
$storeRepository->insert('item3', 49.99);
$storeRepository->insert('item4', 34.99);
$storeRepository->insert('item5', 4.99);


use Itb\UsersRepository;

$usersRepository = new UsersRepository();

$usersRepository->dropTable();
$usersRepository->createTable();

$usersRepository->insert('admin', 'admin', 'admin@admin.ie');
$usersRepository->insert('staff', 'staff', 'staff@staff.ie');