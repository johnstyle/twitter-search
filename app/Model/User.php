<?php

namespace Model;

use Core\Model;

/**
 * Class User
 *
 * @author  Jonathan SAHM <contact@johnstyle.fr>
 * @package Model
 */
class User extends Model
{
    const FILE = '/users.json';

    public static $data;

    protected $id = null;
    protected $date = null;
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
    protected $following_date = null;
    protected $following_back = null;
    protected $following_back_date = null;
    protected $created_at = null;
    protected $last_status = null;

    /**
     * @param  array $data
     * @return $this
     */
    public function hydrate(array $data)
    {
        static::load();
        Friend::load();
        Follower::load();

        $idStr = '_' . $data['id'];

        $this->following = array_key_exists($idStr, Friend::$data);
        $this->following_date = null;
        $this->following_back = array_key_exists($idStr, Follower::$data);
        $this->following_back_date = null;
        $this->last_status = isset($data['status']['created_at']) ? $data['status']['created_at'] : null;

        if(true === $this->following
            && (!array_key_exists($idStr, static::$data)
                || !isset(static::$data[$idStr]['following_date']))) {

            $this->following_date = date('Y-m-d H:i:s');
        }

        if(true === $this->following_back
            && (!array_key_exists($idStr, static::$data)
                || !isset(static::$data[$idStr]['following_back_date']))) {

            $this->following_back_date = date('Y-m-d H:i:s');
        }

        foreach($data as $name=>$value) {

            if(property_exists($this, $name)) {

                $this->{$name} = $value;
            }
        }

        return $this;
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

            if(!is_null($filters)) {

                $filters = array_merge(array(
                    'following' => null,
                    'followingBack' => null,
                    'language' => null,
                    'minFollowers' => null,
                    'minFriends' => null,
                    'minTweets' => null,
                    'minActivityDays' => null,
                    'search' => null,
                ), $filters);

                foreach(static::$data as $id=>$data) {

                    if((!is_null($filters['following']) && (int) $filters['following'] !== (int) $data['following'])
                        || (!is_null($filters['followingBack']) && (int) $filters['followingBack'] !== (int) $data['following_back'])
                        || (!is_null($filters['minFollowers']) && $filters['minFollowers'] > (int) $data['followers_count'])
                        || (!is_null($filters['minFriends']) && $filters['minFriends'] > (int) $data['friends_count'])
                        || (!is_null($filters['minTweets']) && $filters['minTweets'] > (int) $data['statuses_count'])
                        || (!is_null($filters['minActivityDays']) && strtotime('-' . $filters['minActivityDays'] . ' days') > strtotime($data['last_status']))
                        || (!is_null($filters['language']) && (string) $data['lang'] !== $filters['language'])
                        || (!is_null($filters['search']) && (
                                !strstr($data['description'], $filters['search'])
                                && !strstr($data['location'], $filters['search'])
                                && !strstr($data['screen_name'], $filters['search'])
                        ))) {

                        unset(static::$data[$id]);
                    }
                }
            }
        }

        return static::$data;
    }
}
