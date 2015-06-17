<?php

namespace Core;

/**
 * Class Controller
 *
 * @author  Jonathan SAHM <contact@johnstyle.fr>
 * @package Core
 */
class Controller
{
    const NAME = null;

    protected $id;
    protected $model;

    public function __construct()
    {
        $this->id = isset($_GET['id']) && (is_array($_GET['id']) || 0 !== (int) $_GET['id']) ? $_GET['id'] : null;
    }

    public function init()
    {

    }
}
