<?php

namespace App\Controllers\Admin;

use App\Class\Alert;
use App\Models\BlacklistCategory as ModelsBlacklistCategory;

class BlacklistCategory
{
    public static function add()
    {
        if ($_POST['name']) {
            $name = $_POST['name'];

            if (ModelsBlacklistCategory::count(['name' => $name]) > 0) {
                echo Alert::alerts('มีหมวดหมู่นี้อยู่แล้ว', 'error', 1500, 'window.history.back()');
                exit;
            }
            ModelsBlacklistCategory::create([
                'name' => $name
            ]);

            $path = admin_url('blacklist.category');
            echo Alert::alerts('เพิ่มหมวดหมู่สำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
        } else {
            redirect(admin_url('blacklist.category.add'));
        }
    }

    public static function delete()
    {
        if ($_POST['id']) {
            $id = $_POST['id'];

            if (ModelsBlacklistCategory::count(['id' => $id]) == 0) {
                echo Alert::alerts('ไม่พบหมวดหมู่นี้ในระบบ', 'error', 1500, 'window.history.back()');
                exit;
            }
            ModelsBlacklistCategory::delete(['id' => $id]);

            $path = admin_url('blacklist.category');
            echo Alert::alerts('ลบหมวดหมู่สำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
        } else {
            redirect(admin_url('blacklist.category'));
        }
    }

    public static function edit()
    {
        if ($_POST['id']) {
            $id = $_POST['id'];
            $name = $_POST['name'];

            if (ModelsBlacklistCategory::count(['id' => $id]) == 0) {
                echo Alert::alerts('ไม่พบหมวดหมู่นี้ในระบบ', 'danger', 1500, 'window.history.back()');
                exit;
            }
            ModelsBlacklistCategory::update(['id' => $id], ['name' => $name]);

            $path = admin_url('blacklist.category');
            echo Alert::alerts('แก้ไขหมวดหมู่สำเร็จ', 'success', 1500, 'window.location.href="' . $path . '"');
        } else {
            redirect(admin_url('blacklist.category'));
        }
    }
}
