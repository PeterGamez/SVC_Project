<?php

namespace App\Controllers\Admin;

use App\Class\Alert;
use App\Class\App;
use App\Class\Discord;
use App\Models\Bank as ModelsBank;

class Bank
{
    public static function add()
    {
        if ($_POST['name']) {
            $name = $_POST['name'];
            $file = $_FILES['image']['tmp_name'];

            $data = Discord::postImage(config('discord.bank.image'), ["file" => curl_file_create($file, 'png', App::RandomHex(4) . '.png')]);
            $image_url = $data['attachments'][0]['url'];

            ModelsBank::create([
                'name' => $name,
                'image' => $image_url
            ]);

            $path = admin_url('bank');
            echo Alert::alerts('เพื่มธนาคารสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
        } else {
            redirect(admin_url('bank.add'));
        }
    }

    public static function delete()
    {
        if ($_POST['id']) {
            $id = $_POST['id'];

            if (ModelsBank::count(['id' => $id]) == 0) {
                echo Alert::alerts('ไม่พบธนาคารนี้ในระบบ', 'error', 1500, 'window.history.back()');
                exit;
            }

            ModelsBank::delete(['id' => $id]);

            $path = admin_url('bank');
            echo Alert::alerts('ลบธนาคารสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
        } else {
            redirect(admin_url('bank'));
        }
    }

    public static function edit()
    {
        if ($_POST['id']) {
            $id = $_POST['id'];
            $name = $_POST['name'];

            if (ModelsBank::count(['id' => $id]) == 0) {
                echo Alert::alerts('ไม่พบกิจการนี้ในระบบ', 'error', 1500, 'window.history.back()');
                exit;
            }

            $newData = ['name' => $name];

            if ($_FILES['image']['tmp_name']) {
                $file = $_FILES['image']['tmp_name'];

                $data = Discord::postImage(config('discord.bank.image'), ["file" => curl_file_create($file, 'png', App::RandomHex(4) . '.png')]);
                $image_url = $data['attachments'][0]['url'];
                $newData['image'] = $image_url;
            }
            ModelsBank::update(['id' => $id], $newData);

            $path = admin_url("bank.$id.edit");
            echo Alert::alerts('แก้ไขกิจการสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
        } else {
            redirect(admin_url('bank'));
        }
    }
}
