<?php
/**
 * Copyright (C) 2016 Álvaro Orduna León
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
namespace App\Database;


use mysqli;

class DbHelper
{
    private $user;
    private $password;
    private $host;
    protected $database;

    /**
     * @var $connection mysqli
     */
    public $connection;

    /**
     * @var $_connection DbHelper
     */
    private static $instance;

    /**
     * DbHelper constructor.
     */
    public function __construct()
    {
        // Load Db config
        $config = parse_ini_file(FOLDER_CONFIG . DIRECTORY_SEPARATOR . 'db_config.ini');

        // Set fields
        $this->host = $config["host"];
        $this->user = $config["user"];
        $this->password = $config["password"];
        $this->database = $config["database"];
        $this->connection = new mysqli($this->host, $this->user, $this->password, $this->database);
        if ($this->connection->errno) {
            throw new \Exception('Could not connect to the database', 500);
        }
    }

    /**
     * Get DbHelper instance
     * @return DbHelper
     */
    public static function instance()
    {
        if (!isset(self::$instance)) {
            $class = __CLASS__;
            self::$instance = new $class;
        }

        return self::$instance;
    }

    /**
     * Performs a query on the database
     * @param string $query The query string
     * @return mixed
     * @throws \Exception
     */
    public function query($query)
    {
        $result = $this->connection->query($query);
        if ($this->connection->errno) {
            throw new \Exception('Error querying the database: ' . $this->connection->error . '<br/>Query: ' . $query, 500);
        }

        $results_array = array();
        while ($row = $result->fetch_assoc()) {
            $results_array[] = $row;
        }

        return $results_array;
    }
}
