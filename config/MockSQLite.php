<?php
/**
 * Mock config file for SQLite database.
 */
return [
    "dsn"             => "sqlite::memory:",
    "username"        => null,
    "password"        => null,
    "driver_options"  => null,
    "fetch_mode"      => \PDO::FETCH_OBJ,
    "table_prefix"    => null,
    "session_key"     => "Anax\Database",
    // True to be very verbose during development
    "verbose"         => true,//null,
    // True to be verbose on connection failed
    "debug_connect"   => true//false,
];
