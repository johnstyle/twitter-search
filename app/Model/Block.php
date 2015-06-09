<?php

namespace Model;

use Core\Model;

/**
 * Class Block
 *
 * @author  Jonathan SAHM <contact@johnstyle.fr>
 * @package Model
 */
class Block extends Model
{
    const FILE = '/blocks.json';

    public static $data;

    protected $id = null;
    protected $date = null;
}
