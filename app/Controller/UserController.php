<?php

namespace Controller;

use Core\Controller;
use Core\DatatableServerSide;
use Model\Hide;

/**
 * Class UserController
 *
 * @author  Jonathan SAHM <contact@johnstyle.fr>
 * @package Controller
 */
class UserController extends Controller
{
    public $language;
    public $minFollowers;
    public $minFriends;
    public $minTweets;
    public $minActivityDays;
    public $following;
    public $followingBack;

    public function init()
    {
        parent::init();

        $this->language = isset($_GET['language']) && '' !== (string) $_GET['language'] ? (string) $_GET['language'] : null;
        $this->minFollowers = isset($_GET['min-followers']) && 0 !== (int) $_GET['min-followers'] ? (int) $_GET['min-followers'] : null;
        $this->minFriends = isset($_GET['min-friends']) && 0 !== (int) $_GET['min-friends'] ? (int) $_GET['min-friends'] : null;
        $this->minTweets = isset($_GET['min-tweets']) && 0 !== (int) $_GET['min-tweets'] ? (int) $_GET['min-tweets'] : null;
        $this->minActivityDays = isset($_GET['min-activity-days']) && 0 !== (int) $_GET['min-activity-days'] ? (int) $_GET['min-activity-days'] : null;
        $this->following = isset($_GET['following']) && '' !== (string) $_GET['following'] ? (int) $_GET['following'] : null;
        $this->followingBack = isset($_GET['following-back']) && '' !== (string) $_GET['following-back'] ? (int) $_GET['following-back'] : null;

    }

    public function getIndex()
    {

    }

    public function getHide()
    {
        $model = $this->model;

        $model::load();
        Hide::load();

        if(!is_array($this->id)) {

            $this->id = array($this->id);
        }

        $update = false;

        foreach($this->id as $id) {

            $idStr = '_' . $id;

            Hide::$data[$idStr] = (new Hide($id))->getData();

            if(array_key_exists($idStr, $model::$data)) {

                unset($model::$data[$idStr]);
                $update = true;
            }
        }

        if(true === $update) {

            $model::save();
        }

        Hide::save();

        header('Location:?controller=' . static::NAME);
        exit;
    }

    public function getDatatable()
    {
        $model = $this->model;

        call_user_func_array(array($this->model, 'load'), array(
            array(
                'following' => $this->following,
                'followingBack' => $this->followingBack,
                'language' => $this->language,
                'minFollowers' => $this->minFollowers,
                'minFriends' => $this->minFriends,
                'minTweets' => $this->minTweets,
                'minActivityDays' => $this->minActivityDays,
            )
        ));

        (new DatatableServerSide())->setData($model::$data, function($item) {

            $item['screen_name'] = '<a href="https://twitter.com/' . $item['screen_name'] . '" target="_blank"><img src="' . $item['profile_image_url_https'] . '"> ' . $item['screen_name'] . '</a>';
            $item['following'] = 1 === (int) $item['following'] ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>';
            $item['following_back'] = 1 === (int) $item['following_back'] ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>';
            $item['verified'] = 1 === (int) $item['verified'] ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>';
            $item['created_at'] = date('Y-m-d', strtotime($item['created_at']));
            $item['following_date'] = !is_null($item['following_date']) ? date('Y-m-d', strtotime($item['following_date'])) : '-';
            $item['following_back_date'] = !is_null($item['following_back_date']) ? date('Y-m-d', strtotime($item['following_back_date'])) : '-';
            $item['last_status'] = date('Y-m-d H:i:s', strtotime($item['last_status']));
            $item['actions'] = '<a href="?controller=' . static::NAME . '&action=hide&id=' . $item['id'] . '" class="btn btn-xs btn-default" title="Ignore"><i class="fa fa-eye-slash"></i></a>';

            return $item;

        })->render();
    }
}
