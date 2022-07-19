<?php
namespace Hasinur\Xspeed\Models;

/**
 * Core Model Class
 */
class Model {
    /**
     * PDO Object
     *
     * @var Object
     */
    public $pdo;

    /**
     * Store table name
     *
     * @var string
     */
    public $table;

    /**
     * Store all records
     *
     * @var arry
     */
    public $results;

    /**
     * Count all records
     *
     * @var integer
     */
    public $count;

    /**
     * Constructor for Model Class
     */
    public function __construct() {
        $config = get_config();
        try {
            $this->pdo = new \PDO( "mysql:host={$config['DB_HOST']}; dbname={$config['DB_NAME']}", $config['DB_USER'], $config['DB_PASSWORD'] );

        } catch ( \PDOException $e ) {
            die( $e->getMessage() );
        }
    }

    /**
     * Execute query
     *
     * @param string $sql
     * @param array $params
     * @return boolean
     */
    public function query( $sql, $params = [] ) {

        if ( $query = $this->pdo->prepare( $sql ) ) {
            $x = 1;

            if ( count( $params ) ) {
                foreach ( $params as $param ) {
                    $query->bindValue( $x, $param );
                    $x++;
                }
            }
        }

        if ( $query->execute() ) {
            $this->results = $query->fetchAll(\PDO::FETCH_OBJ);
            $this->count = $query->rowCount();
            return true;
        }

        return false;
    }

    /**
     * Create record
     *
     * @param array $fields
     * @return boolean
     */
    public function create( $fields ) {
        if ( count( $fields ) ) {
            $keys   = array_keys( $fields );
            $values = '';
            $x      = 1;

            foreach ( $fields as $field ) {
                $values .= '?';

                if ( $x < count( $fields ) ) {
                    $values .= ', ';
                }
                $x++;
            }

            $sql = "INSERT INTO {$this->table}(" . implode( ', ', $keys ) . ") VALUES({$values})";

            if ( $this->query( $sql, $fields ) ) {
                return true;
            }
        }

        return false;
    }

    /**
     * Update record
     *
     * @param integer $id
     * @param array $fields
     * @return void
     */
    public function update( $id, $fields ) {
        $set = '';
        $x   = 1;

        foreach ( $fields as $name => $value ) {
            $set .= "{$name} = ?";
            if ( $x < count( $fields ) ) {
                $set .= ',';
            }
            $x++;
        }

        $sql = "UPDATE {$this->table} SET {$set} WHERE id = {$id}";

        if ( $this->query( $sql, $fields ) ) {
            return true;
        }

        return false;
    }

    /**
     * Get all records
     *
     * @return void
     */
    public function get() {
        $this->query("SELECT * FROM {$this->table}");

        return $this->results;
    }


}