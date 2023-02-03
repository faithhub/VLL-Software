<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Messages;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        # code...
        try {
            //code...
            $data['title'] = "Messages";
            $messages = Messages::groupBy('user_id')->orderBy('created_at', 'ASC')->with(['user', 'admin', 'file'])->get();
            $messages_arr = [];

            foreach ($messages as $message) {
                $msg = Messages::where(['user_id' => $message->user->id])->latest()->first();
                $msg_count = Messages::where(['user_id' => $message->user->id, 'isChecked' => false])->get();

                $object = new \stdClass();
                $object->msg = $msg->msg ?? $msg->file_name;
                $object->message = $message;
                $object->msg_count = $msg_count->count();
                array_push($messages_arr, $object);
            }
            // dd($m);
            $data['messages'] = $messages_arr;
            $data['messages_count'] = Messages::where(['isChecked' => false])->count();
            return View('dashboard.admin.messages.index', $data);
        } catch (\Throwable $th) {
            dd($th->getMessage());
            //throw $th;
        }
    }
}