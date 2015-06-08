<?php

namespace Core;

/**
 * Class TwitterApi
 *
 * @author  Jonathan SAHM <contact@johnstyle.fr>
 * @package Core
 */
class TwitterApi extends \TwitterOAuth
{
    /** @var array $searches */
    public static $searches;

    /**
     * @param  string $url
     * @param  array  $parameters
     * @param  string $file
     * @param  int    $cache
     * @param  int    $sleep
     * @return array
     */
    public function getCached($url, array $parameters = array(), $file, $cache = DEFAULT_CACHE_TIME, $sleep = 10)
    {
        if(is_null($cache)
            || !file_exists($file)
            || filemtime($file) < (time() - $cache)) {

            if(!is_null($sleep)) {

                sleep($sleep);
            }

            file_put_contents($file, json_encode($this->get($url, $parameters)));
        }

        return json_decode(file_get_contents($file), true);
    }
}
