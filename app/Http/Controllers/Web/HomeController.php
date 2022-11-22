<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    //

    public function index()
    {
        # code...
        $data['materials'] = array(
            (object) [
                'id' => 7879,
                'title' => 'Constitutional Law',
                'link' => '#',
                'img' => asset('materials/img/001.png')
            ],
            (object) [
                'id' => 7880,
                'title' => 'Introduction to Business Laws',
                'link' => '#',
                'img' => asset('materials/img/002.png')
            ],
            (object) [
                'id' => 7881,
                'title' => 'Constitutional Law',
                'link' => '#',
                'img' => asset('materials/img/003.png')
            ],
            (object) [
                'id' => 7882,
                'title' => 'Constitutional Law',
                'link' => '#',
                'img' => asset('materials/img/004.png')
            ],
            (object) [
                'id' => 7883,
                'title' => 'Introduction to Business Laws',
                'link' => '#',
                'img' => asset('materials/img/005.png')
            ],
            (object) [
                'id' => 7884,
                'title' => 'Constitutional Law',
                'link' => '#',
                'img' => asset('materials/img/006.png')
            ]
        );
        $data['title'] = "Home";
        $data['banner'] = true;
        return View('web.index', $data);
    }

    public function privacy()
    {
        # code...
        $data['title'] = "Privacy Policy";
        $data['contents'] = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar in eu feugiat consequat tellus adipiscing morbi ultrices. Venenatis, sed nec fermentum, odio volutpat bibendum. Augue dictum duis nam faucibus nunc vel etiam. Lacus, nunc maecenas arcu morbi mauris eu purus amet. Nisi habitasse in cursus sit. Amet sem senectus adipiscing ac. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar in eu feugiat consequat tellus adipiscing morbi ultrices. Venenatis, sed nec fermentum, odio volutpat bibendum. Augue dictum duis nam faucibus nunc vel etiam. Lacus, nunc maecenas arcu morbi mauris eu purus amet. Nisi habitasse in cursus sit. Amet sem senectus adipiscing ac. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar in eu feugiat consequat tellus adipiscing morbi ultrices. Venenatis, sed nec fermentum, odio volutpat bibendum. Augue dictum duis nam faucibus nunc vel etiam. Lacus, nunc maecenas arcu morbi mauris eu purus amet. Nisi habitasse in cursus sit. Amet sem senectus adipiscing ac. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pulvinar in eu feugiat consequat tellus adipiscing morbi ultrices. Venenatis, sed nec fermentum, odio volutpat bibendum. Augue dictum duis nam faucibus nunc vel etiam. Lacus, nunc maecenas arcu morbi mauris eu purus amet. Nisi habitasse in cursus sit. Amet sem senectus adipiscing ac.";
        return View('web.privacy', $data);
    }
}