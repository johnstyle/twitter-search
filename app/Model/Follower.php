<?php

namespace Model;

use Core\Model;

/**
 * Class Follower
 *
 * @author  Jonathan SAHM <contact@johnstyle.fr>
 * @package Model
 */
class Follower extends Model
{
    const FILE = '/followers.json';

    public static $data;

    protected $id = null;
    protected $date = null;
}
