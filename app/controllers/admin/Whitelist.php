<?php

namespace App\Controllers\Admin;

use App\Class\Alert;
use App\Class\App;
use App\Class\Discord;
use App\Models\Whitelist as ModelsWhitelist;

class Whitelist
{
    public static function add()
    {
        if ($_POST['name']) {
            $tag = $_POST['tag'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $banner = $_FILES['banner'];
            $account_id = $_POST['account_id'];
            $website = $_POST['website'];
            $id_firstname = $_POST['id_firstname'];
            $id_lastname = $_POST['id_lastname'];
            $id_number = $_POST['id_number'];
            $id_image = $_FILES['id_image'];

            if (ModelsWhitelist::count(['account_id' => $account_id]) > 0) {
                echo Alert::alerts('บัญชีเจ้าของกิจการนี้ มีอยู่ในระบบแล้ว', 'error', 1500, 'window.history.back()');
                exit;
            }

            $data = Discord::postImage(config('discord.whitelist.banner'), ["file" => curl_file_create($banner['tmp_name'], 'png', App::RandomHex(4) . '.png')]);
            $banner_url = $data['attachments'][0]['url'];

            $data = Discord::postImage(config('discord.whitelist.id_image'), ["file" => curl_file_create($id_image['tmp_name'], 'png', App::RandomHex(4) . '.png')]);
            $id_image = $data['attachments'][0]['url'];

            ModelsWhitelist::create([
                'tag' => $tag,
                'name' => $name,
                'description' => $description,
                'account_id' => $account_id,
                'banner' => $banner_url,
                'website' => $website,
                'id_firstname' => $id_firstname,
                'id_lastname' => $id_lastname,
                'id_number' => $id_number,
                'id_image' => $id_image
            ]);

            $path = admin_url('whitelist');
            echo Alert::alerts('เพิ่มกิจการสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
        } else {
            redirect(admin_url('whitelist.add'));
        }
    }

    public static function delete()
    {
        if ($_POST['id']) {
            $id = $_POST['id'];

            if (ModelsWhitelist::count(['id' => $id]) == 0) {
                echo Alert::alerts('ไม่พบกิจการนี้ในระบบ', 'error', 1500, 'window.history.back()');
                exit;
            }

            ModelsWhitelist::delete(['id' => $id]);

            $path = admin_url('whitelist');
            echo Alert::alerts('ลบกิจการสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
        } else {
            redirect(admin_url('whitelist'));
        }
    }

    public static function edit()
    {
        if ($_POST['id']) {
            $id = $_POST['id'];
            $tag = $_POST['tag'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $account_id = $_POST['account_id'];
            $website = $_POST['website'];
            $id_firstname = $_POST['id_firstname'];
            $id_lastname = $_POST['id_lastname'];
            $id_number = $_POST['id_number'];


            if (ModelsWhitelist::count(['id' => $id]) == 0) {
                echo Alert::alerts('ไม่พบกิจการนี้ในระบบ', 'error', 1500, 'window.history.back()');
                exit;
            }
            if (ModelsWhitelist::count(['account_id' => $account_id]) > 0) {
                echo Alert::alerts('บัญชีเจ้าของกิจการนี้ มีอยู่ในระบบแล้ว', 'error', 1500, 'window.history.back()');
                exit;
            }

            $newData = [
                'tag' => $tag,
                'name' => $name,
                'description' => $description,
                'account_id' => $account_id,
                'website' => $website,
                'id_firstname' => $id_firstname,
                'id_lastname' => $id_lastname,
                'id_number' => $id_number
            ];

            if ($_FILES['banner']['tmp_name']) {
                $banner = $_FILES['banner'];
                $data = Discord::postImage(config('discord.whitelist.banner'), ["file" => curl_file_create($banner['tmp_name'], 'png', App::RandomHex(4) . '.png')]);
                $banner_url = $data['attachments'][0]['url'];
                $newData['banner'] = $banner_url;
            }

            if ($_FILES['id_image']['tmp_name']) {
                $id_image = $_FILES['id_image'];
                $data = Discord::postImage(config('discord.whitelist.id_image'), ["file" => curl_file_create($id_image['tmp_name'], 'png', App::RandomHex(4) . '.png')]);
                $image_url = $data['attachments'][0]['url'];
                $newData['id_image'] = $image_url;
            }
            ModelsWhitelist::update(['id' => $id], $newData);

            $path = admin_url("whitelist.$id");
            echo Alert::alerts('แก้ไขกิจการสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
        } else {
            redirect(admin_url('whitelist'));
        }
    }
}
