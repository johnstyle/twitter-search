<?php

namespace Controller;

use Core\Controller;
use Model\Hide;
use Model\User;

/**
 * Class UserController
 *
 * @author  Jonathan SAHM <contact@johnstyle.fr>
 * @package Controller
 */
class UserController extends Controller
{
    public function getHide()
    {
        User::load();
        Hide::load();

        if(!is_array($this->id)) {

            $this->id = array($this->id);
        }

        $update = false;

        foreach($this->id as $id) {

            $idStr = '_' . $id;

            Hide::$data[$idStr] = (new Hide($id))->getData();

            if(array_key_exists($idStr, User::$data)) {

                unset(User::$data[$idStr]);
                $update = true;
            }
        }

        if(true === $update) {

            User::save();
        }

        Hide::save();

        header('Location:?controller=user');
        exit;
    }
}
