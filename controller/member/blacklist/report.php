<?php

use App\Class\Alert;
use App\Class\App;
use App\Class\Discord;
use App\Models\Blacklist;
use App\Models\BlacklistImage;
use Intervention\Image\ImageManagerStatic as Image;

require_once './vendor/intervention/image/src/Intervention/Image/ImageManagerStatic';

if ($_POST['name']) {
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

    $data = Discord::postImage(config('discord.blacklist.id_image'), ["file" => curl_file_create($file, 'png', App::RandomHex(4) . '.png')]);
    $image_url = $data['attachments'][0]['url'];

    $insert_id = Blacklist::create([
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

    if (isset($_FILES['blacklist_image'])) {
        $blacklist_image = $_FILES['blacklist_image'];

        $watermarkpath = realpath('./resource/images/watermark.png');
        $watermark = Image::make($watermarkpath);
        $watermark->resize($watermark->width() * 0.5, $watermark->height() * 0.5);

        $file_count = count($blacklist_image['name']);
        for ($i = 0; $i < $file_count; $i++) {
            $file = $blacklist_image['tmp_name'][$i];
            $file_name = $blacklist_image['name'][$i];
            $file_type = $blacklist_image['type'][$i];
            $file_size = $blacklist_image['size'][$i];

            $image = Image::make($file);
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
    $path = member_url('report');
    echo Alert::alerts('ส่งรายงานสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
} else {
    redirect(member_url('report'));
}
