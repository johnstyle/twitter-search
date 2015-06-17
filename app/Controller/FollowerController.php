<?php

namespace Controller;

/**
 * Class FollowerController
 *
 * @author  Jonathan SAHM <contact@johnstyle.fr>
 * @package Controller
 */
class FollowerController extends UserController
{
    const NAME = 'follower';

    public function init()
    {
        parent::init();

        $this->model = '\\Model\\Follower';
    }
}
