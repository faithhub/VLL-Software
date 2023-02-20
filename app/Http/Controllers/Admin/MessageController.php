<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Messages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    public function index()
    {
        # code...
        try {
            //code...
            $current_msg_user_new = Session::get('current_msg_user_new');
            // dd($current_msg_user_new);
            $data['title'] = "Messages";
            $messages = Messages::groupBy('user_id')->orderBy('created_at', 'ASC')->with(['user', 'admin', 'file'])->get();
            $messages_arr = [];
            if ($current_msg_user_new) {
                $data['current_user'] = Messages::where(['user_id' => $current_msg_user_new])->with('user')->orderBy('created_at', 'ASC')->first();
                $data['current_user_messages'] = Messages::where(['user_id' => $current_msg_user_new])->with(['user', 'admin'])->orderBy('created_at', 'ASC')->get();
            }

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

    public function current_msg_user(Request $request)
    {
        # code...
        $object = new \stdClass();
        $object->status = false;
        if ($request->current_msg_user_new) {
            Session::put('current_msg_user_new', $request->current_msg_user_new);
            $object->status = true;
            return $object;
        }
        return $object;
    }

    public function send_msg(Request $request)
    {
        # code...
        $object = new \stdClass();
        $object->status = false;
        $object->msg = $request->msg;
        if ($_POST) {
            $type = $request->type;
            $user_id = $request->user_id;
            $msg_file = null;
            $isMedia = false;
            if ($request->hasFile('save_file')) {
                $msg_file = $request->file('save_file');
                $msg_org_name = $request->file('save_file')->getClientOriginalName();
                $msg_file_name = 'MSGFile' . time() . '.' . $msg_file->getClientOriginalExtension();
                Storage::disk('msg_file')->put($msg_file_name, file_get_contents($msg_file));
                $isMedia = true;
                $save_cover = File::create([
                    'name' => $msg_file_name,
                    'url' => 'storage/message_file/' . $msg_file_name
                ]);
            }

            Messages::create([
                'admin_id' => Auth::user()->id,
                'user_id' => $user_id,
                'type' => 'admin',
                'msg' => $request->msg ?? null,
                'file_name' => $msg_org_name ?? null,
                'isMedia' => $isMedia,
                'media_id' => $save_cover->id ?? null
            ]);
            // $data = [
            //     // 'msg_file' => $msg_file,
            //     // 'msg_org_name' => $msg_org_name,
            //     // 'msg_file_name' => $msg_file_name,
            //     'isMedia' => $isMedia,
            // ];

            $object->status = true;
        }

        return $object;
    }
}