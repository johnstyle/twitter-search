<?php

namespace Model;

use Core\Model;

/**
 * Class Hide
 *
 * @author  Jonathan SAHM <contact@johnstyle.fr>
 * @package Model
 */
class Hide extends Model
{
    const FILE = '/hides.json';

    public static $data;

    protected $id = null;
    protected $date = null;
}
