<?php

namespace Model;

/**
 * Class User
 *
 * @author  Jonathan SAHM <contact@johnstyle.fr>
 * @package Model
 */
class User
{
    const FILE = '/users.json';

    public static $data;

    protected $id = null;
    protected $name = null;
    protected $screen_name = null;
    protected $profile_image_url_https = null;
    protected $followers_count = null;
    protected $friends_count = null;
    protected $statuses_count = null;
    protected $favourites_count = null;
    protected $lang = null;
    protected $location = null;
    protected $description = null;
    protected $verified = null;
    protected $following = null;
    protected $following_back = null;
    protected $created_at = null;
    protected $last_status = null;

    /**
     * @param int $id
     */
    public function __construct($id = null)
    {
        if(!is_null($id)) {

            $this->id = (int) $id;
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
        if(is_null(static::$data)) {

            static::$data = file_exists(DIR_DATA . static::FILE)
                ? json_decode(file_get_contents(DIR_DATA . static::FILE), true)
                : array();

            if(!is_null($filters)) {

                $filters = array_merge(array(
                    'following' => null,
                    'following_back' => null,
                    'language' => null,
                    'minFollowers' => null,
                    'minFriends' => null,
                    'minTweets' => null,
                    'minActivityDays' => null,
                ), $filters);

                foreach(static::$data as $id=>$data) {

                    if((!is_null($filters['following']) && (int) $filters['following'] === (int) $data['following'])
                        || (!is_null($filters['following_back']) && (int) $filters['following_back'] === (int) $data['following_back'])
                        || (!is_null($filters['minFollowers']) && $filters['minFollowers'] > (int) $data['followers_count'])
                        || (!is_null($filters['minFriends']) && $filters['minFriends'] > (int) $data['friends_count'])
                        || (!is_null($filters['minTweets']) && $filters['minTweets'] > (int) $data['statuses_count'])
                        || (!is_null($filters['minActivityDays']) && strtotime('-' . $filters['minActivityDays'] . ' days') > strtotime($data['last_status']))
                        || (!is_null($filters['language']) && (string) $data['lang'] !== $filters['language'])) {

                        unset(static::$data[$id]);
                    }
                }
            }
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
