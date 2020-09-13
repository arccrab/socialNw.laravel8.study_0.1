<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Models\UserModel;

class UserController extends Controller {

    public function index(Request $request, $id) {

        $user = ['username' => UserModel::getUserInfo($id), 'id' => $id];
        $posts = UserModel::getUserPosts($id);


        return view('app.profile', ['posts' => $posts, 'user' => $user]);
    }

    public function posts(Request $request, $id) {
        $posts = UserModel::getUserPosts($id);

        return view('app.profile', ['posts' => $posts]);
    }

    public function createPost (Request $request) {

        $post_r = $request->all();

        $post_info = [
            'body' => $post_r['body'],
            'time' => time(),
            'user_id' => $post_r['user_id']
        ];

        UserModel::setPost($post_info);
        return redirect()->route('profile', ['id' => $post_r['user_id']]);
    }

}
