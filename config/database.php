<?php
class Database
{
    // Note: specify your own database credentials
    private $host = "151.106.98.0";

    private $db_name = "u241638502_db_melange";

    private $username = "u241638502_melange";

    private $password = "Libya100!";

   


    private static $instance = null;
    public $conn;

    private function __construct(){
        $db_dsn = array(
            'host'    => $this->host,
            'dbname'  => $this->db_name,
            'charset' => 'utf8',
        );

        if (getenv('IDP_ENVIRONMENT') === 'docker') {
            $db_dsn['host'] = 'mysql';
            $this->username = 'docker_u';
            $this->password = 'docker_p';

        }

        try {
            $dsn        = 'mysql:' . http_build_query($db_dsn, '', ';');
            $this->conn = new PDO($dsn, $this->username, $this->password);
        } catch (PDOException $exception) {
            echo json_encode(
                array(
                    'error'   => 'Database connection failed',
                    'message' => $exception->getMessage(),
                )
            );
            exit;
        }
    }
    
    // get the database connection
    public function getConnection()
    {   
        return $this->conn;
    }

    public static function getInstance(){
        if(!self::$instance){
            self::$instance = new Database();
        }

        return self::$instance;
    }
}
