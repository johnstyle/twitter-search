<?php

namespace Controller;

/**
 * Class SearchController
 *
 * @author  Jonathan SAHM <contact@johnstyle.fr>
 * @package Controller
 */
class SearchController extends UserController
{
    const NAME = 'search';

    public function init()
    {
        parent::init();

        $this->model = '\\Model\\User';
    }
}
