<?php
require_once './app/autoload.php';

if (empty($agent_request[1])) {
    return visitor_views('index');
}
// Whitelist
else if ($agent_request[1] == 'whitelist') {
    if (isset($agent_request[2])) {
        $request['id'] = $agent_request[2];
        return visitor_views('whitelist.view');
    } else {
        return visitor_views('whitelist.index');
    }
}
// Blacklist
else if ($agent_request[1] == 'blacklist') {
    if (isset($agent_request[2])) {
        $request['id'] = $agent_request[2];
        return visitor_views('blacklist.view');
    } else {
        return visitor_views('blacklist.index');
    }
}
// Contact
else if ($agent_request[1] == 'contact') {
    return visitor_views('contact');
}
// Application
else if ($agent_request[1] == 'download') {
    if (empty($agent_request[2])) {
        return visitor_views('download');
    } else if ($agent_request[2] == 'android') {
        return Download::transfer(resource('application/android/release.apk', true), 'IntraCheck.apk');
    }
}
// Member Panel
else if (str_starts_with($agent_path, config('site.member_panel'))) {
    // Chcek Login
    if ($_SESSION['login'] == false) {
        // Login
        if ($agent_request[2] == 'login') {
            // Callback
            if (isset($agent_request[3]) and $agent_request[3] == 'callback' and isset($agent_request[4]) and $agent_method == 'POST') {
                // Site Form
                if ($agent_request[4] == 'form') {
                    return controller('login.form');
                }
                // Google API
                else if ($agent_request[4] == 'google') {
                    return controller('login.google');
                }
            }
            // Login
            return member_views('login');
        }
        // Redirect to Login
        $_SESSION['callback'] = url($agent_path);
        return redirect(member_url('login'));
    }
    // Dashboard
    else if (empty($agent_request[2])) {
        return member_views('index');
    }
    // Logout
    else if ($agent_request[2] == 'logout') {
        return controller('login.logout');
    }
    // Profile
    else if ($agent_request[2] == 'profile') {
        if ($agent_request[3] == 'password') {
            if ($agent_method == 'POST') {
                return controller('profile.password');
            } else {
                return member_views('profile.password');
            }
        }
    }
    // Whitelist
    else if ($agent_request[2] == 'whitelist') {
        if (isset($agent_request[3])) {
            if ($agent_request[3] == 'setting' and $agent_method == 'GET') {
                return member_views('whitelist.setting');
            } else if ($agent_request[3] == 'setting' and $agent_method == 'POST') {
                return controller('whitelist.setting');
            } else if ($agent_request[3] == 'register' and $agent_method == 'GET') {
                return member_views('whitelist.register');
            } else if ($agent_request[3] == 'register' and $agent_method == 'POST') {
                return controller('whitelist.register');
            }
        }
    }
    // Blacklist
    else if ($agent_request[2] == 'blacklist') {
        if (isset($agent_request[3])) {
            if ($agent_request[3] == 'report' and $agent_method == 'GET') {
                return member_views('blacklist.report');
            } else if ($agent_request[3] == 'report' and $agent_method == 'POST') {
                return controller('blacklist.report');
            } else if ($agent_request[3] == 'myreport') {
                return member_views('blacklist.myreport');
            }
        }
    }
    return member_views('404');
}
// Admin Panel
else if (str_starts_with($agent_path, config('site.admin_panel'))) {
    // Chcek Login
    if ($_SESSION['login'] == false) {
        // Redirect to Login
        $_SESSION['callback'] = url($agent_path);
        return redirect(member_url('login'));
    } else if (!in_array($_SESSION['user_role'], ['superadmin', 'admin', 'staff'])) {
        return redirect(url(config('site.member_panel')));
    }
    // Dashboard
    else if (empty($agent_request[2])) {
        return admin_views('index');
    }
    // Whitelist
    else if ($agent_request[2] == 'whitelist') {
        // index
        if (empty($agent_request[3])) {
            return admin_views('whitelist.index');
        }
        // add
        else if ($agent_request[3] == 'add' and $agent_method == 'GET') {
            return admin_views('whitelist.add');
        } else if ($agent_request[3] == 'add' and $agent_method == 'POST') {
            return controller('whitelist.add');
        }
        // check is number
        else if (is_numeric($agent_request[3])) {
            $request['id'] = $agent_request[3];
            // view
            if (empty($agent_request[4])) {
                return admin_views('whitelist.view');
            }
            // edit
            else if ($agent_request[4] == 'edit' and $agent_method == 'GET') {
                return admin_views('whitelist.edit');
            } else if ($agent_request[4] == 'edit' and $agent_method == 'POST') {
                return controller('whitelist.edit');
            }
            // delete
            else if ($agent_request[4] == 'delete' and $agent_method == 'GET') {
                return admin_views('whitelist.delete');
            } else if ($agent_request[4] == 'delete' and $agent_method == 'POST') {
                return controller('whitelist.delete');
            }
            // approve
            else if ($agent_request[4] == 'approve' and $agent_method == 'GET') {
                return admin_views('whitelist.approve');
            } else if ($agent_request[4] == 'approve' and $agent_method == 'POST') {
                return controller('whitelist.approve');
            }
        }
        // category
        else if ($agent_request[3] == 'category') {
            if (empty($agent_request[4])) {
                return admin_views('whitelist.category.index');
            }
            // add
            if ($agent_request[4] == 'add' and $agent_method == 'GET') {
                return admin_views('whitelist.category.add');
            } else if ($agent_request[4] == 'add' and $agent_method == 'POST') {
                return controller('whitelist.category.add');
            }
            // check is number
            else if (is_numeric($agent_request[4])) {
                $request['id'] = $agent_request[4];
                // edit
                if ($agent_request[5] == 'edit' and $agent_method == 'GET') {
                    return admin_views('whitelist.category.edit');
                } else if ($agent_request[5] == 'edit' and $agent_method == 'POST') {
                    return controller('whitelist.category.edit');
                }
                // delete
                else if ($agent_request[5] == 'delete' and $agent_method == 'GET') {
                    return controller('whitelist.category.delete');
                } else if ($agent_request[5] == 'delete' and $agent_method == 'POST') {
                    return controller('whitelist.category.delete');
                }
            }
        }
    }
    // Blacklist
    else if ($agent_request[2] == 'blacklist') {
        // index
        if (empty($agent_request[3])) {
            return admin_views('blacklist.index');
        }
        // add
        else if ($agent_request[3] == 'add' and $agent_method == 'GET') {
            return admin_views('blacklist.add');
        } else if ($agent_request[3] == 'add' and $agent_method == 'POST') {
            return controller('blacklist.add');
        }
        // check is number
        else if (is_numeric($agent_request[3])) {
            $request['id'] = $agent_request[3];
            // view
            if (empty($agent_request[4])) {
                return admin_views('blacklist.view');
            }
            // edit
            if ($agent_request[4] == 'edit' and $agent_method == 'GET') {
                return admin_views('blacklist.edit');
            } else if ($agent_request[4] == 'edit' and $agent_method == 'POST') {
                return controller('blacklist.edit');
            }
            // delete
            else if ($agent_request[4] == 'delete' and $agent_method == 'GET') {
                return admin_views('blacklist.delete');
            } else if ($agent_request[4] == 'delete' and $agent_method == 'POST') {
                return controller('blacklist.delete');
            }
        }
        // category
        else if ($agent_request[3] == 'category') {
            if (empty($agent_request[4])) {
                return admin_views('blacklist.category.index');
            }
            // add
            if ($agent_request[4] == 'add' and $agent_method == 'GET') {
                return admin_views('blacklist.category.add');
            } else if ($agent_request[4] == 'add' and $agent_method == 'POST') {
                return controller('blacklist.category.add');
            }
            // check is number
            else if (is_numeric($agent_request[4])) {
                $request['id'] = $agent_request[4];
                // edit
                if ($agent_request[5] == 'edit' and $agent_method == 'GET') {
                    return admin_views('blacklist.category.edit');
                } else if ($agent_request[5] == 'edit' and $agent_method == 'POST') {
                    return controller('blacklist.category.edit');
                }
                // delete
                else if ($agent_request[5] == 'delete' and $agent_method == 'GET') {
                    return controller('blacklist.category.delete');
                } else if ($agent_request[5] == 'delete' and $agent_method == 'POST') {
                    return controller('blacklist.category.delete');
                }
            }
        }
    }
    // Setting
    /// Account
    else if ($agent_request[2] == 'account' and in_array($_SESSION['user_role'], ['superadmin'])) {
        // index
        if (empty($agent_request[3])) {
            return admin_views('account.index');
        }
        // add
        else if ($agent_request[3] == 'add' and $agent_method == 'GET') {
            return admin_views('account.add');
        } else if ($agent_request[3] == 'add' and $agent_method == 'POST') {
            return controller('account.add');
        }
        // check is number
        else if (is_numeric($agent_request[3])) {
            $request['id'] = $agent_request[3];
            // view
            if (empty($agent_request[4])) {
                return admin_views('account.view');
            }
            // edit
            else if ($agent_request[4] == 'edit' and $agent_method == 'GET') {
                return admin_views('account.edit');
            } else if ($agent_request[4] == 'edit' and $agent_method == 'POST') {
                return controller('account.edit');
            }
            // password
            else if ($agent_request[4] == 'password' and $agent_method == 'GET') {
                return admin_views('account.password');
            } else if ($agent_request[4] == 'password' and $agent_method == 'POST') {
                return controller('account.password');
            }
            // delete
            else if ($agent_request[4] == 'delete' and $agent_method == 'GET') {
                return admin_views('account.delete');
            } else if ($agent_request[4] == 'delete' and $agent_method == 'POST') {
                return controller('account.delete');
            }
        }
    }
    /// Bank
    else if ($agent_request[2] == 'bank' and in_array($_SESSION['user_role'], ['superadmin', 'admin'])) {
        // index
        if (empty($agent_request[3])) {
            return admin_views('bank.index');
        }
        // add
        else if ($agent_request[3] == 'add' and $agent_method == 'GET') {
            return admin_views('bank.add');
        } else if ($agent_request[3] == 'add' and $agent_method == 'POST') {
            return controller('bank.add');
        }
        // check is number
        else if (is_numeric($agent_request[3])) {
            $request['id'] = $agent_request[3];
            // view
            if (empty($agent_request[4])) {
                return admin_views('bank.view');
            }
            // check is number
            else if (is_numeric($agent_request[4])) {
                $request['id'] = $agent_request[4];
                // edit
                if ($agent_request[5] == 'edit' and $agent_method == 'GET') {
                    return admin_views('bank.edit');
                } else if ($agent_request[5] == 'edit' and $agent_method == 'POST') {
                    return controller('bank.edit');
                }
                // delete
                else if ($agent_request[5] == 'delete' and $agent_method == 'GET') {
                    return admin_views('bank.delete');
                } else if ($agent_request[5] == 'delete' and $agent_method == 'POST') {
                    return controller('bank.delete');
                }
            }
        }
    }
    return admin_views('404');
}
return views('404');
