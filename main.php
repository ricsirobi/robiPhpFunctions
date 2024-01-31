<?php

function dd()
{
    foreach (func_get_args() as $arg) {
        echo "<pre>";
        var_dump($arg);
        echo "</pre>";
    }
    exit();
}

function ddWithoutExit()
{
    foreach (func_get_args() as $arg) {
        echo "<pre>";
        var_dump($arg);
        echo "</pre>";
    }
}

function getDatabaseStructure($connection)
{
    $databaseStructure = [];
    $tablesQuery = $connection->query("SHOW TABLES");
    if ($tablesQuery) {
        while ($table = $tablesQuery->fetch_row()) {
            $tableName = $table[0];
            $databaseStructure[$tableName] = [];
            $columnsQuery = $connection->query("SHOW COLUMNS FROM " . $tableName);
            if ($columnsQuery) {
                while ($column = $columnsQuery->fetch_assoc()) {
                    $databaseStructure[$tableName][] = [
                        'Field' => $column['Field'],
                        'Type' => $column['Type']
                    ];
                }
            }
        }
    }
    return $databaseStructure;
}



?>
