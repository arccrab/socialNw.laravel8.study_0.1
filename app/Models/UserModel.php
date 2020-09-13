<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

class UserModel extends Model {

    public static function getUserInfo ($id) {
        $id = (int)$id;

        $data = Redis::hget('user:' . $id, 'username');

        return $data;
    }

    public static function getUserPosts ($id) {
        $id = (int)$id;
        $post_arr = [];

        $post_id_arr = Redis::lrange('posts:' . $id, 0, -1);

        foreach ($post_id_arr as $post_id) {
            $post = Redis::hgetall('post:'.$post_id);
            $post['time'] = date('H:i, F j, Y', $post['time']);
            $post_arr[] = $post;
        }

        return $post_arr;
    }

    public static function setPost ($data) {
        $data['user_id'] = (int)$data['user_id'];

        $post_id = Redis::get('next_post_id');

        Redis::hset('post:'.$post_id, 'user_id', $data['user_id']);
        Redis::hset('post:'.$post_id, 'time', $data['time']);
        Redis::hset('post:'.$post_id, 'body', $data['body']);
        Redis::lpush('posts:'.$data['user_id'], $post_id);
        Redis::incr('next_post_id');

        return true;
    }

}
