<?php

namespace App\Controllers\Admin;

use App\Class\Alert;
use App\Models\Approve as ModelsApprove;

class Approve
{
    public static function add()
    {
        if ($_POST['name']) {
            $name = $_POST['name'];
            $color = $_POST['color'];
            $icon = $_POST['icon'];
            $whitelist = $_POST['whitelist'];
            $blacklist = $_POST['blacklist'];

            ModelsApprove::create([
                'name' => $name,
                'color' => $color,
                'icon' => $icon,
                'whitelist' => $whitelist,
                'blacklist' => $blacklist
            ]);

            $path = admin_url('approve');
            echo Alert::alerts('เพื่มสถานะสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
        } else {
            redirect(admin_url('approve.add'));
        }
    }

    public static function delete()
    {
        if ($_POST['id']) {
            $id = $_POST['id'];

            if (ModelsApprove::count(['id' => $id]) == 0) {
                echo Alert::alerts('ไม่พบสถานะนี้ในระบบ', 'error', 1500, 'window.history.back()');
                exit;
            }

            ModelsApprove::delete(['id' => $id]);

            $path = admin_url('approve');
            echo Alert::alerts('ลบสถานะสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
        } else {
            redirect(admin_url('approve'));
        }
    }

    public static function edit()
    {
        if ($_POST['id']) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $color = $_POST['color'];
            $icon = $_POST['icon'];
            $whitelist = $_POST['whitelist'];
            $blacklist = $_POST['blacklist'];

            if (ModelsApprove::count(['id' => $id]) == 0) {
                echo Alert::alerts('ไม่พบสถานะนี้ในระบบ', 'error', 1500, 'window.history.back()');
                exit;
            }

            ModelsApprove::update([
                'id' => $id
            ], [
                'name' => $name,
                'color' => $color,
                'icon' => $icon,
                'whitelist' => $whitelist,
                'blacklist' => $blacklist
            ]);

            $path = admin_url("approve.$id.edit");
            echo Alert::alerts('แก้ไขสถานะสำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
        } else {
            redirect(admin_url('approve'));
        }
    }
}
