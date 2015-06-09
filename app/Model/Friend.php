<?php

namespace Model;

use Core\Model;

/**
 * Class Friend
 *
 * @author  Jonathan SAHM <contact@johnstyle.fr>
 * @package Model
 */
class Friend extends Model
{
    const FILE = '/friends.json';

    public static $data;

    protected $id = null;
    protected $date = null;
}
