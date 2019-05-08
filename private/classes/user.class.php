<?php 
class User {
    //-----start of active record pattern-----
    static protected $database;
    static public function set_database($database) {
        self::$database = $database;
    }
    
    static public function find_by_sql($sql) {
        $result = self::$database->query($sql);
        if(!$result) {
            exit('Database query failed');
        }
        // result into objects
        $object_array = [];
        while ($record = $result->fetch_assoc()) {
            $object_array[] = self::instantiate($record);  
        }
        $result->free();

        return $object_array;
    }
    static public function find_all() {
        $sql = "SELECT * FROM user";
        return self::find_by_sql($sql);
    }
    static public function find_by_id($id) {
        $sql = "SELECT *FROM " .static::$table_name ." ";
        $sql .= "WHERE id = '" .self::$database->escape_string($id)."'";
        $obj_array = static::find_by_sql($sql);
        if(!empty($obj_array)) {
          return array_shift($obj_array);
        } else {
          return false;
        }
      }
    static protected function instantiate($record) {
        $object = new self;
        // automatically assign the values to properties
        foreach($record as $property=> $value) {
            if(property_exists($object, $property)) {
                $object->$property = $value;
            }
        }
        return $object;
    }
    public function create() {
        $sql = "INSERT INTO user (";
        $sql .= "name, age ";
        $sql .= ") VALUES (";
        $sql .= "'" .$this->name ."', " ;
        $sql .= "'" .$this->age ."'" ;
        $sql .= ")";
        $result = self::$database->query($sql);
        if ($result) {
            $this->id = self::$database->insert_id;
        }
        return $result;
    }

    //-----end of active record pattern-----
    public $id;
    public $name;
    public $age;

    public function __construct($args=[]) {
        $this->name = $args['name'] ?? '';
        $this->age = $args['age'] ?? '';
}

    

}


?>