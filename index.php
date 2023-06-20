<?php
require_once './app/autoload.php';

if (empty($agent_request[1])) {
    return visitor_views('index');
}
// Whitelist
else if ($agent_request[1] == 'whitelist') {
    if (isset($agent_request[1])) {
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
// Login
else if ($agent_request[1] == 'login') {
    if (isset($agent_request[2]) and $agent_method == 'POST') {
        if ($agent_request[2] == 'form') {
            return controller('login.form');
        } else if ($agent_request[2] == 'google') {
            return controller('login.google');
        }
    } else {
        return visitor_views('login');
    }
}
// Logout
else if ($agent_request[1] == 'logout') {
    return controller('login.logout');
}
// Member Panel
else if (str_starts_with($agent_path, config('site.member_panel'))) {
    // chcek login
    if ($_SESSION['login'] == false) {
        $_SESSION['callback'] = url($agent_path);
        return redirect(member_url('/login'));
    }
}
// Admin Panel
else if (str_starts_with($agent_path, config('site.admin_panel'))) {
    // chcek login
    if ($_SESSION['login'] == false) {
        $_SESSION['callback'] = url($agent_path);
        return redirect(member_url('/login'));
    }
    // dashboard
    if (empty($agent_request[2])) {
        return admin_views('index');
    }
    // profile
    else if ($agent_request[2] == 'profile') {
        if ($agent_request[3] == 'password') {
            if ($agent_method == 'POST') {
                return controller('profile.password');
            } else {
                return admin_views('profile.password');
            }
        }
    }
    // whitelist
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
    // blacklist
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
    // setting
    else if ($agent_request[2] == 'account') {
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
            } else if ($agent_request[4] == 'edit' and $agent_method == 'POST') {
                return controller('account.password');
            }
            // delete
            else if ($agent_request[4] == 'delete' and $agent_method == 'GET') {
                return admin_views('account.delete');
            } else if ($agent_request[4] == 'delete' and $agent_method == 'POST') {
                return controller('account.delete');
            }
        }
    } else if ($agent_request[2] == 'bank') {
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
