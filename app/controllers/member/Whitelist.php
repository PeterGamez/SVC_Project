<?php

namespace App\Controllers\Member;

use App\Class\Alert;
use App\Class\App;
use App\Class\Discord;
use App\Models\Whitelist as ModelsWhitelist;
use App\Models\WhitelistWaiting;

class Whitelist
{
    public static function delete()
    {
        $data = ModelsWhitelist::find()->where('account_id', $_SESSION['user_id'])->getOne();
        if (!$data) {
            echo Alert::alerts('ไม่พบข้อมูล', 'error', 1500, 'window.history.back()');
            exit;
        }

        WhitelistWaiting::create([
            'name' => $data['name'],
            'description' => $data['description'],
            'account_id' => $data['account_id'],
            'banner' => $data['banner'],
            'website' => $data['website'],
            'id_firstname' => $data['id_firstname'],
            'id_lastname' => $data['id_lastname'],
            'id_number' => $data['id_number'],
            'id_image' => $data['id_image'],
            'approve_id' => 5
        ]);

        echo Alert::alerts('แจ้งลบข้อมูลสำเร็จ', 'success', 1500, 'window.location.href="' . member_url() . '"');
    }

    public static function register()
    {
        if ($_POST['name']) {
            $name = $_POST['name'];
            $description = $_POST['description'];
            $banner = $_FILES['banner'];
            $website = $_POST['website'];
            $id_firstname = $_POST['id_firstname'];
            $id_lastname = $_POST['id_lastname'];
            $id_number = $_POST['id_number'];
            $id_image = $_FILES['id_image'];

            if (ModelsWhitelist::count(['account_id' => $_SESSION['user_id']]) > 0) {
                echo Alert::alerts('บัญชีเจ้าของกิจการนี้ มีอยู่ในระบบแล้ว', 'error', 1500, 'window.history.back()');
                exit;
            }

            $data = Discord::postImage(config('discord.whitelist.banner'), ["file" => curl_file_create($banner['tmp_name'], 'png', App::RandomHex(4) . '.png')]);
            $banner_url = $data['attachments'][0]['url'];

            $data = Discord::postImage(config('discord.whitelist.id_image'), ["file" => curl_file_create($id_image['tmp_name'], 'png', App::RandomHex(4) . '.png')]);
            $image_url = $data['attachments'][0]['url'];

            WhitelistWaiting::create([
                'name' => $name,
                'description' => $description,
                'account_id' => $_SESSION['user_id'],
                'banner' => $banner_url,
                'website' => $website,
                'id_firstname' => $id_firstname,
                'id_lastname' => $id_lastname,
                'id_number' => $id_number,
                'id_image' => $image_url
            ]);

            $path = member_url('whitelist.register');
            echo Alert::alerts('ลงทะเบีบนกิจการสำเสร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
        } else {
            redirect(member_url('whitelist.register'));
        }
    }

    public static function setting()
    {
        if ($_POST['id']) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $website = $_POST['website'];

            $data = ModelsWhitelist::find()->where('id', $id)->getOne();
            if (!$data) {
                echo Alert::alerts('ไม่พบกิจการนี้ในระบบ', 'error', 1500, 'window.history.back()');
                exit;
            }

            $newData = [
                'tag' => $data['tag'],
                'name' => $name,
                'description' => $description,
                'account_id' => $_SESSION['user_id'],
                'website' => $website,
                'id_firstname' => $data['id_firstname'],
                'id_lastname' => $data['id_lastname'],
                'id_number' => $data['id_number'],
                'id_image' => $data['image_url'],
                'approve_id' => 4
            ];

            if ($_FILES['banner']['tmp_name']) {
                $banner = $_FILES['banner'];
                $data = Discord::postImage(config('discord.whitelist.banner'), ["file" => curl_file_create($banner['tmp_name'], 'png', App::RandomHex(4) . '.png')]);
                $banner_url = $data['attachments'][0]['url'];
                $newData['banner'] = $banner_url;
            }

            WhitelistWaiting::create($newData);

            $path = member_url('whitelist.setting');
            echo Alert::alerts('แก้ไขกิจการสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
        } else {
            redirect(member_url('whitelist.setting'));
        }
    }
}
