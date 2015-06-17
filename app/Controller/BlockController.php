<?php

namespace Controller;

/**
 * Class BlockController
 *
 * @author  Jonathan SAHM <contact@johnstyle.fr>
 * @package Controller
 */
class BlockController extends UserController
{
    const NAME = 'block';

    public function init()
    {
        parent::init();

        $this->model = '\\Model\\Block';
    }
}
