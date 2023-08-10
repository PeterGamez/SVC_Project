<?php

use App\Class\App;
use App\Class\Download;

// Visitor
if (empty($agent_request[1]) and App::isGET()) {
    return visitor_views('index');
}
// Whitelist
else if ($agent_request[1] == 'whitelist' and App::isGET()) {
    if (isset($agent_request[2])) {
        $request['tag'] = $agent_request[2];
        return visitor_views('whitelist.view');
    } else {
        return visitor_views('whitelist.index');
    }
}
// Blacklist
else if ($agent_request[1] == 'blacklist' and App::isGET()) {
    if (isset($agent_request[2])) {
        $request['id'] = $agent_request[2];
        return visitor_views('blacklist.view');
    } else {
        return visitor_views('blacklist.index');
    }
}
// Contact
else if ($agent_request[1] == 'contact' and App::isGET()) {
    return visitor_views('contact');
}
// Application
else if ($agent_request[1] == 'download' and App::isGET()) {
    if (empty($agent_request[2])) {
    } else if ($agent_request[2] == 'android') {
        return Download::transfer('resource/application/android/release.apk', 'IntraCheck.apk');
    }
}
// Privacy Policy
else if ($agent_request[1] == 'privacy' and App::isGET()) {
    return visitor_views('privacy');
}
// Terms of Service
else if ($agent_request[1] == 'tos' and App::isGET()) {
    return visitor_views('tos');
}
// Member Panel
else if (str_starts_with($agent_path, config('site.member_panel'))) {
    // Chcek Login
    if ($_SESSION['login'] == false) {
        // Login
        if ($agent_request[2] == 'register') {
            if (App::isGET()) {
                return member_views('register');
            } else if (App::isPOST()) {
                return member_controller('login.register');
            }
        } else if ($agent_request[2] == 'login') {
            if (isset($agent_request[3])) {
                // Callback
                if ($agent_request[3] == 'callback') {
                    if (isset($agent_request[4]) and App::isPOST()) {
                        // Site Form
                        if ($agent_request[4] == 'form') {
                            return member_controller('login.form');
                        }
                        // Google API
                        else if ($agent_request[4] == 'google') {
                            return member_controller('login.google');
                        }
                    }
                }
            }
            // Login Page
            else if (App::isGET()) {
                return member_views('login');
            }
        }
        // Redirect to Login
        $_SESSION['callback'] = url($agent_path);
        return redirect(member_url('login'));
    }
    // Dashboard
    else if (empty($agent_request[2]) and App::isGET()) {
        return member_views('index');
    }
    // Logout
    else if ($agent_request[2] == 'logout' and App::isGET()) {
        return member_controller('login.logout');
    }
    // Profile
    else if ($agent_request[2] == 'profile') {
        if (isset($agent_request[3])) {
            if ($agent_request[3] == 'password') {
                if (App::isGET()) {
                    return member_views('profile.password');
                } else if (App::isPOST()) {
                    return member_controller('profile.password');
                }
            }
        }
    }
    // Whitelist
    else if ($agent_request[2] == 'whitelist') {
        if (isset($agent_request[3])) {
            if ($agent_request[3] == 'setting') {
                if (App::isGET()) {
                    return member_views('whitelist.setting');
                } else if (App::isPOST()) {
                    return member_controller('whitelist.setting');
                }
            } else if ($agent_request[3] == 'register') {
                if (App::isGET()) {
                    return member_views('whitelist.register');
                } else if (App::isPOST()) {
                    return member_controller('whitelist.register');
                }
            }
        }
    }
    // Blacklist
    else if ($agent_request[2] == 'blacklist') {
        if (isset($agent_request[3])) {
            if ($agent_request[3] == 'report') {
                if (App::isGET()) {
                    return member_views('blacklist.report');
                } else if (App::isPOST()) {
                    return member_controller('blacklist.report');
                }
            } else if ($agent_request[3] == 'myreport') {
                if (App::isGET()) {
                    return member_views('blacklist.myreport');
                }
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
        return redirect(member_url());
    }
    // Dashboard
    else if (empty($agent_request[2]) and App::isGET()) {
        return admin_views('index');
    }
    // Whitelist
    else if ($agent_request[2] == 'whitelist') {
        // index
        if (empty($agent_request[3]) and App::isGET()) {
            return admin_views('whitelist.index');
        }
        // add
        else if ($agent_request[3] == 'add' and App::isGET()) {
            return admin_views('whitelist.add');
        } else if ($agent_request[3] == 'add' and App::isPOST()) {
            return admin_controller('whitelist.add');
        }
        // check is number
        else if (is_numeric($agent_request[3])) {
            $request['id'] = $agent_request[3];
            // view
            if (empty($agent_request[4]) and App::isGET()) {
                return admin_views('whitelist.view');
            }
            // edit
            else if ($agent_request[4] == 'edit' and App::isGET()) {
                return admin_views('whitelist.edit');
            } else if ($agent_request[4] == 'edit' and App::isPOST()) {
                return admin_controller('whitelist.edit');
            }
            // delete
            else if ($agent_request[4] == 'delete' and App::isGET()) {
                return admin_views('whitelist.delete');
            } else if ($agent_request[4] == 'delete' and App::isPOST()) {
                return admin_controller('whitelist.delete');
            }
            // approve
            else if ($agent_request[4] == 'approve' and App::isGET()) {
                return admin_views('whitelist.approve');
            } else if ($agent_request[4] == 'approve' and App::isPOST()) {
                return admin_controller('whitelist.approve');
            }
        }
    }
    // Blacklist
    else if ($agent_request[2] == 'blacklist') {
        // index
        if (empty($agent_request[3]) and App::isGET()) {
            return admin_views('blacklist.index');
        }
        // add
        else if ($agent_request[3] == 'add' and App::isGET()) {
            return admin_views('blacklist.add');
        } else if ($agent_request[3] == 'add' and App::isPOST()) {
            return admin_controller('blacklist.add');
        }
        // check is number
        else if (is_numeric($agent_request[3])) {
            $request['id'] = $agent_request[3];
            // view
            if (empty($agent_request[4]) and App::isGET()) {
                return admin_views('blacklist.view');
            }
            // edit
            if ($agent_request[4] == 'edit' and App::isGET()) {
                return admin_views('blacklist.edit');
            } else if ($agent_request[4] == 'edit' and App::isPOST()) {
                return admin_controller('blacklist.edit');
            }
            // delete
            else if ($agent_request[4] == 'delete' and App::isGET()) {
                return admin_views('blacklist.delete');
            } else if ($agent_request[4] == 'delete' and App::isPOST()) {
                return admin_controller('blacklist.delete');
            }
            // approve
            else if ($agent_request[4] == 'approve' and App::isGET()) {
                return admin_views('blacklist.approve');
            } else if ($agent_request[4] == 'approve' and App::isPOST()) {
                return admin_controller('blacklist.approve');
            }
        }
        // category
        else if ($agent_request[3] == 'category') {
            if (empty($agent_request[4]) and App::isGET()) {
                return admin_views('blacklist.category.index');
            }
            // add
            if ($agent_request[4] == 'add' and App::isGET()) {
                return admin_views('blacklist.category.add');
            } else if ($agent_request[4] == 'add' and App::isPOST()) {
                return admin_controller('blacklist.category.add');
            }
            // check is number
            else if (is_numeric($agent_request[4])) {
                $request['id'] = $agent_request[4];
                // edit
                if ($agent_request[5] == 'edit' and App::isGET()) {
                    return admin_views('blacklist.category.edit');
                } else if ($agent_request[5] == 'edit' and App::isPOST()) {
                    return admin_controller('blacklist.category.edit');
                }
                // delete
                else if ($agent_request[5] == 'delete' and App::isGET()) {
                    return admin_views('blacklist.category.delete');
                } else if ($agent_request[5] == 'delete' and App::isPOST()) {
                    return admin_controller('blacklist.category.delete');
                }
            }
        }
    }
    // Setting
    /// Account
    else if ($agent_request[2] == 'account' and in_array($_SESSION['user_role'], ['superadmin'])) {
        // index
        if (empty($agent_request[3]) and App::isGET()) {
            return admin_views('account.index');
        }
        // add
        else if ($agent_request[3] == 'add' and App::isGET()) {
            return admin_views('account.add');
        } else if ($agent_request[3] == 'add' and App::isPOST()) {
            return admin_controller('account.add');
        }
        // check is number
        else if (is_numeric($agent_request[3])) {
            $request['id'] = $agent_request[3];
            // view
            if (empty($agent_request[4]) and App::isGET()) {
                return admin_views('account.view');
            }
            // edit
            else if ($agent_request[4] == 'edit' and App::isGET()) {
                return admin_views('account.edit');
            } else if ($agent_request[4] == 'edit' and App::isPOST()) {
                return admin_controller('account.edit');
            }
            // password
            else if ($agent_request[4] == 'password' and App::isGET()) {
                return admin_views('account.password');
            } else if ($agent_request[4] == 'password' and App::isPOST()) {
                return admin_controller('account.password');
            }
            // delete
            else if ($agent_request[4] == 'delete' and App::isGET()) {
                return admin_views('account.delete');
            } else if ($agent_request[4] == 'delete' and App::isPOST()) {
                return admin_controller('account.delete');
            }
        }
    }
    /// Bank
    else if ($agent_request[2] == 'bank' and in_array($_SESSION['user_role'], ['superadmin', 'admin'])) {
        // index
        if (empty($agent_request[3]) and App::isGET()) {
            return admin_views('bank.index');
        }
        // add
        else if ($agent_request[3] == 'add' and App::isGET()) {
            return admin_views('bank.add');
        } else if ($agent_request[3] == 'add' and App::isPOST()) {
            return admin_controller('bank.add');
        }
        // check is number
        else if (is_numeric($agent_request[3])) {
            $request['id'] = $agent_request[3];
            // view
            if (empty($agent_request[3]) and App::isGET()) {
                return admin_views('bank.view');
            }
            // check is number
            else if (is_numeric($agent_request[3])) {
                $request['id'] = $agent_request[3];
                // edit
                if ($agent_request[4] == 'edit' and App::isGET()) {
                    return admin_views('bank.edit');
                } else if ($agent_request[4] == 'edit' and App::isPOST()) {
                    return admin_controller('bank.edit');
                }
                // delete
                else if ($agent_request[4] == 'delete' and App::isGET()) {
                    return admin_views('bank.delete');
                } else if ($agent_request[4] == 'delete' and App::isPOST()) {
                    return admin_controller('bank.delete');
                }
            }
        }
    }
    /// Approve
    else if ($agent_request[2] == 'approve' and in_array($_SESSION['user_role'], ['superadmin', 'admin'])) {
        // index
        if (empty($agent_request[3])) {
            return admin_views('approve.index');
        }
        // add
        else if ($agent_request[3] == 'add' and App::isGET()) {
            return admin_views('approve.add');
        } else if ($agent_request[3] == 'add' and App::isPOST()) {
            return admin_controller('approve.add');
        }
        // check is number
        else if (is_numeric($agent_request[3])) {
            $request['id'] = $agent_request[3];
            // view
            if (empty($agent_request[4]) and App::isGET()) {
                return admin_views('approve.view');
            }
            // edit
            else if ($agent_request[4] == 'edit' and App::isGET()) {
                return admin_views('approve.edit');
            } else if ($agent_request[4] == 'edit' and App::isPOST()) {
                return admin_controller('approve.edit');
            }
            // delete
            else if ($agent_request[4] == 'delete' and App::isGET()) {
                return admin_views('approve.delete');
            } else if ($agent_request[4] == 'delete' and App::isPOST()) {
                return admin_controller('approve.delete');
            }
        }
    }
    // not found
    return admin_views('404');
}
// verify email
else if (str_starts_with($agent_path, '/verify-email')) {
    return member_controller('login.verify-email');
}
// not found
return visitor_views('404');
