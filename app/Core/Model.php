<?php

namespace Core;

/**
 * Class Model
 *
 * @author  Jonathan SAHM <contact@johnstyle.fr>
 * @package Core
 */
class Model
{
    /**
     * @param int $id
     */
    public function __construct($id = null)
    {
        if(!is_null($id)) {

            $this->id = (int) $id;
        }

        if(is_null($this->date)) {

            $this->date = date('Y-m-d H:i:s');
        }
    }

    /**
     * @param  string $name
     * @return mixed
     */
    public function __get($name)
    {
        if(property_exists($this, $name)) {

            return $this->{$name};
        }

        return null;
    }

    /**
     * @param  array $data
     * @return $this
     */
    public function hydrate(array $data)
    {
        foreach($data as $name=>$value) {

            if(property_exists($this, $name)) {

                $this->{$name} = $value;
            }
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return get_object_vars($this);
    }

    /**
     * @param  array $filters
     * @return array
     */
    public static function load(array $filters = null)
    {
        if (is_null(static::$data)) {

            static::$data = file_exists(DIR_DATA . static::FILE)
                ? json_decode(file_get_contents(DIR_DATA . static::FILE), true)
                : array();
        }

        return static::$data;
    }

    /**
     * @return array
     */
    public static function save()
    {
        if(!is_null(static::$data)) {

            file_put_contents(DIR_DATA . static::FILE, json_encode(static::$data));
        }
    }
}
