<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    //

    public function index()
    {
        # code...
        $data['title'] = "Home";
        $data['banner'] = true;
        $data['materials'] = Material::with(['type', 'cover'])->where('status', 'active')->inRandomOrder()->limit(9)->get();
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