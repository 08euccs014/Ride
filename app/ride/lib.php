<?php
/**
 * Created by PhpStorm.
 * User: mohit
 * Date: 19/4/15
 * Time: 2:07 PM
 */

class lib
{
    //name of the lib
    public static $name = '';

    public static $instances = array();

    public $id = 0;

    private function __construct()
    {
        //considering modal name should be same as lib name
        //$id = self::getLastIncreament(static::$name);
        //$this->id = $id;

        //if you need anything default to all libs object then do it here
        $this->reset();
    }

    public static function getIntance($id = 0, $bindData = array())
    {
        $className = static::$name;

        if ($id == 0) {
            $object = new $className();
            $object->bind($bindData);
            return $object;
        }

        //caching of objects
        if (isset(self::$instances[$className][$id]) && self::$instances[$className][$id]->getId() == $id) {
            self::$instances[$className][$id]->bind($bindData);
            return self::$instances[$className][$id];
        }

        //it object is not in cache the create a new one
        $object = new $className();
        //load the data from the database
        $object->load($id);
        //if there is something to bind then bind it
        $object->bind($bindData);

        self::setCache($object);
        return self::$instances[$className][$id];
    }

    private function getLastIncreament($modelName)
    {
        $model      = $this->getModel();
        $tableName  = $model->getTableName();

        $res = DB::select("SELECT AUTO_INCREMENT  as id FROM information_schema.TABLES
                            WHERE TABLE_SCHEMA = 'ride'
                            AND TABLE_NAME = '".$tableName."'");

        $res = array_pop($res);

        return $res->id;
    }

    private function getModel()
    {
        $modelClass = static::$name.'Model';
        $model      = new $modelClass();

        return $model;
    }

    /**
     * Bind the given data array or and object to the
     * @param $bindData
     * @return $this
     */
    private function bind($bindData)
    {
        if (is_array($bindData)) {
            foreach($bindData as $key => $data) {
                if ( isset($this->$key) ) {
                    $this->$key = $data;
                }
                else {
                    continue;
                }
            }
        }
        else {
            $properties = get_object_vars($bindData);
            foreach($properties as $key => $val) {
                if ( isset($this->$key) ) {
                    $this->$key = $bindData->$key;
                }
                else {
                    continue;
                }
            }
        }

        return $this;
    }

    public function save()
    {
        $model  = $this->getModel();
        $id     = $this->getId();

        //if new object then insert the data else update the old one
        if ($id !=0 ) {
            $model = $model->find($id);
        }

        $properties = get_object_vars($this);

        foreach($properties as $key => $val) {

            if ( isset($this->$key) ) {

                $model->$key = $this->$key;
            }
            else {
                continue;
            }
        }

        try {
            $model->save();
        }
        catch(Exception $e) {
            throw $e;
            return false;
        }

        if($id == 0) {
            $this->id = $model->id;
        }

        //if successfully updated then update the cached object also
        self::setCache($this);

        return $this;
    }

    private function load($id = 0)
    {
        if ($id == 0) {
            return $this;
        }

        $model  = $this->getModel();
        $obj    = $model->find($id);
        $bindData = $obj->attributesToArray();

        return $this->bind($bindData);
    }

    /**
     * reset all the properties of an object
     * this method should be override by all the lib
     * @return bool
     */
    public function reset()
    {
        return $this;
    }

    private static function setCache($object)
    {
        if(!($object instanceof lib) || !$object->getId()){
            throw new Exception('Invalid instance of Lib to set');
        }

        $classname  = strtolower(get_class($object));

        self::$instances[$classname][$object->getId()] = $object;
    }

    public function getId()
    {
        return $this->id;
    }

}