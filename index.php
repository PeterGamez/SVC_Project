<?php
require_once './app/autoload.php';

if ($agent_path == '/') {
    return views('index');
} else if ($agent_path == '/whitelist') {
    return views('whitelist');
} else if ($agent_path == '/blacklist') {
    return views('blacklist');
} else if ($agent_path == '/contact') {
    return views('contact');
}
if (str_starts_with($agent_path, config('site.admin_panel'))) {
    if ($_SESSION['login'] == false) {
        if ($agent_request[2] == 'login') {
            if (isset($agent_request[3]) and $agent_method == 'POST') {
                if ($agent_request[3] == 'form') {
                    return controller('login.form');
                } else if ($agent_request[3] == 'google') {
                    return controller('login.google');
                }
            }
        } else {
            $_SESSION['callback'] = url($agent_path);
        }
        return admin_views('login');
    }
    if (!isset($agent_request[2])) {
        return admin_views('index');
    }
    // profile
    else if ($agent_request[2] == 'password') {
        return admin_views('password');
    } else if ($agent_request[2] == 'logout') {
        return controller('login.logout');
    }
    // whitelist
    else if ($agent_request[2] == 'whitelist') {
        // index
        if (!isset($agent_request[3])) {
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
            if (!isset($agent_request[4])) {
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
        }
        // category
        else if ($agent_request[3] == 'category') {
            if (!isset($agent_request[4])) {
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
        if (!isset($agent_request[3])) {
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
            if (!isset($agent_request[4])) {
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
            if (!isset($agent_request[4])) {
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
        if (!isset($agent_request[3])) {
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
            if (!isset($agent_request[4])) {
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
    }
    return admin_views('404');
}
return views('404');
