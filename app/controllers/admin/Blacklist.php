<?php

namespace App\Controllers\Admin;


use App\Class\Alert;
use App\Class\App;
use App\Class\Discord;
use App\Models\Blacklist as ModelsBlacklist;
use App\Models\BlacklistImage;
use Intervention\Image\ImageManager;

require_once __ROOT__ . '/vendor/autoload.php';

class Blacklist
{
    public static function add()
    {
        if ($_POST['name']) {
            $name = $_POST['name'];
            $reason = $_POST['reason'];
            $website = $_POST['website'];
            $id_firstname = $_POST['id_firstname'];
            $id_lastname = $_POST['id_lastname'];
            $id_number = $_POST['id_number'];
            $bank_id = $_POST['bank_id'];
            $bank_number = $_POST['bank_number'];
            $item_name = $_POST['item_name'];
            $item_balance = $_POST['item_balance'];
            $item_date = $_POST['item_date'];

            $id_image = $_FILES['id_image'];
            $file = $id_image['tmp_name'];

            $data = Discord::postImage(config('discord.blacklist.id_image'), ["file" => curl_file_create($file, 'png', App::RandomHex(4) . '.png')]);
            $image_url = $data['attachments'][0]['url'];

            $insert_id = ModelsBlacklist::create([
                'name' => $name,
                'reason' => $reason,
                'website' => $website,
                'id_firstname' => $id_firstname,
                'id_lastname' => $id_lastname,
                'id_number' => $id_number,
                'id_image' => $image_url,
                'bank_id' => $bank_id,
                'bank_number' => $bank_number,
                'item_name' => $item_name,
                'item_balance' => $item_balance,
                'item_date' => $item_date
            ]);

            if ($_FILES['blacklist_image']['tmp_name']) {
                $blacklist_image = $_FILES['blacklist_image'];

                $watermarkpath = __ROOT__ . '/storage/images/watermark.png';
                $manager = new ImageManager(['driver' => 'imagick']);
                $watermark = $manager->make($watermarkpath);

                $file_count = count($blacklist_image['name']);
                for ($i = 0; $i < $file_count; $i++) {
                    $file = $blacklist_image['tmp_name'][$i];

                    $manager = new ImageManager(['driver' => 'imagick']);
                    $image = $manager->make($file);
                    $image->insert($watermark, 'center');

                    $image->save($file);

                    $data = Discord::postImage(config('discord.blacklist.proof'), ["file" => curl_file_create($file, 'png', App::RandomHex(4) . '.png')]);
                    $image_url = $data['attachments'][0]['url'];
                    BlacklistImage::create([
                        'blacklist_id' => $insert_id,
                        'image' => $image_url
                    ]);
                }
            }

            $path = admin_url('blacklist');
            echo Alert::alerts('เพิ่มกิจการสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
        } else {
            redirect(admin_url('blacklist.add'));
        }
    }

    public static function delete()
    {
        if ($_POST['id']) {
            $id = $_POST['id'];

            if (ModelsBlacklist::count(['id' => $id]) == 0) {
                echo Alert::alerts('ไม่พบกิจการนี้ในระบบ', 'error', 1500, 'window.history.back()');
                exit;
            }

            ModelsBlacklist::delete(['id' => $id]);

            $path = admin_url('blacklist');
            echo Alert::alerts('ลบกิจการสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
        } else {
            redirect(admin_url('blacklist'));
        }
    }

    public static function edit()
    {
        if ($_POST['id']) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $reason = $_POST['reason'];
            $website = $_POST['website'];
            $id_firstname = $_POST['id_firstname'];
            $id_lastname = $_POST['id_lastname'];
            $id_number = $_POST['id_number'];
            $id_image = $_FILES['id_image'];
            $bank_id = $_POST['bank_id'];
            $bank_number = $_POST['bank_number'];
            $item_name = $_POST['item_name'];
            $item_balance = $_POST['item_balance'];
            $item_date = $_POST['item_date'];

            if (ModelsBlacklist::count(['id' => $id]) == 0) {
                echo Alert::alerts('ไม่พบกิจการนี้ในระบบ', 'error', 1500, 'window.history.back()');
                exit;
            }

            ModelsBlacklist::update(['id' => $id], [
                'name' => $name,
                'reason' => $reason,
                'website' => $website,
                'id_firstname' => $id_firstname,
                'id_lastname' => $id_lastname,
                'id_number' => $id_number,
                'id_image' => $id_image,
                'bank_id' => $bank_id,
                'bank_number' => $bank_number,
                'item_name' => $item_name,
                'item_balance' => $item_balance,
                'item_date' => $item_date
            ]);

            $path = admin_url("blacklist.$id");
            echo Alert::alerts('แก้ไขกิจการสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
        } else {
            redirect(admin_url('blacklist'));
        }
    }

    public static function approve()
    {
        if ($_POST['id']) {
            $id = $_POST['id'];
            $approve_id = $_POST['approve_id'];
            $approve_reason = $_POST['approve_reason'];

            if (ModelsBlacklist::count(['id' => $id]) == 0) {
                echo Alert::alerts('ไม่พบกิจการนี้ในระบบ', 'error', 1500, 'window.history.back()');
                exit;
            }

            ModelsBlacklist::update(['id' => $id], [
                'approve_id' => $approve_id,
                'approve_reason' => $approve_reason,
                'approve_by' => $_SESSION['user_id'],
                'approve_at' => date('Y-m-d H:i:s')
            ]);
            $path = admin_url("blacklist.$id");
            echo Alert::alerts('แก้ไขกิจการสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
        } else {
            redirect(admin_url('blacklist'));
        }
    }
}
