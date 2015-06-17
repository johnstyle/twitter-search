<?php

namespace Controller;

/**
 * Class FriendController
 *
 * @author  Jonathan SAHM <contact@johnstyle.fr>
 * @package Controller
 */
class FriendController extends UserController
{
    const NAME = 'friend';

    public function init()
    {
        parent::init();

        $this->model = '\\Model\\Friend';
    }
}
