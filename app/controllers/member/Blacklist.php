<?php

namespace App\Controllers\Member;

use App\Class\Alert;
use App\Class\App;
use App\Class\Discord;
use App\Models\Blacklist as ModelsBlacklist;
use App\Models\BlacklistImage;
use Intervention\Image\ImageManager;

require_once __ROOT__ . '/vendor/autoload.php';

class Blacklist
{
    public static function report()
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

            $newData = [
                'name' => $name,
                'reason' => $reason,
                'website' => $website,
                'id_firstname' => $id_firstname,
                'id_lastname' => $id_lastname,
                'id_number' => $id_number,
                'bank_id' => $bank_id,
                'bank_number' => $bank_number,
                'item_name' => $item_name,
                'item_balance' => $item_balance,
                'item_date' => $item_date
            ];

            if ($_FILES['id_image']['tmp_name']) {
                $id_image = $_FILES['id_image'];
                $file = $id_image['tmp_name'];

                $data = Discord::postImage(config('discord.blacklist.id_image'), ["file" => curl_file_create($file, 'png', App::RandomHex(4) . '.png')]);
                $image_url = $data['attachments'][0]['url'];

                $newData['id_image'] = $image_url;
            }

            $insert_id = ModelsBlacklist::create($newData);

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

            $path = member_url('blacklist.myreport');
            echo Alert::alerts('ส่งรายงานสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
        } else {
            redirect(member_url('blacklist.report'));
        }
    }
}
