<?php

use App\Class\App;
use App\Controller\Member\Login;
use App\Controllers\Member\Account;
use App\Controllers\Member\Blacklist;
use App\Controllers\Member\Whitelist;

array_shift($agent_request);
// Chcek Login
if ($_SESSION['login'] == false) {
    // Login
    if ($agent_request[0] == 'register') {
        if (App::isGET()) {
            return member_views('register');
        } else if (App::isPOST()) {
            return Login::register();
        }
    } else if ($agent_request[0] == 'login') {
        if (isset($agent_request[1])) {
            // Callback
            if ($agent_request[1] == 'callback') {
                if (isset($agent_request[2]) and App::isPOST()) {
                    // Site Form
                    if ($agent_request[2] == 'form') {
                        return Login::form();
                    }
                    // Google API
                    else if ($agent_request[2] == 'google') {
                        return Login::google();
                    }
                    // Register Google
                    else if ($agent_request[2] == 'register-email') {
                        return Login::register_email();
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
else if (empty($agent_request[0]) and App::isGET()) {
    return member_views('index');
}
// Logout
else if ($agent_request[0] == 'logout' and App::isGET()) {
    return Login::logout();
}
// Profile
else if ($agent_request[0] == 'profile') {
    if (isset($agent_request[1])) {
        if ($agent_request[1] == 'password') {
            if (App::isGET()) {
                return member_views('profile.password');
            } else if (App::isPOST()) {
                return Account::password();
            }
        }
    }
}
// Whitelist
else if ($agent_request[0] == 'whitelist') {
    if (isset($agent_request[1])) {
        if ($agent_request[1] == 'register' and $_SESSION['user_role'] != 'seller') {
            if (App::isGET()) {
                return member_views('whitelist.register');
            } else if (App::isPOST()) {
                return Whitelist::register();
            }
        } else if ($agent_request[1] == 'setting' and $_SESSION['user_role'] == 'seller') {
            if (App::isGET()) {
                return member_views('whitelist.setting');
            } else if (App::isPOST()) {
                return Whitelist::setting();
            }
        } else if ($agent_request[1] == 'delete' and $_SESSION['user_role'] == 'seller' and App::isPOST()) {
            return Whitelist::delete();
        }
    }
}
// Blacklist
else if ($agent_request[0] == 'blacklist') {
    if (isset($agent_request[1])) {
        if ($agent_request[1] == 'report') {
            if (App::isGET()) {
                return member_views('blacklist.report');
            } else if (App::isPOST()) {
                return Blacklist::report();
            }
        } else if ($agent_request[1] == 'myreport') {
            if (App::isGET()) {
                return member_views('blacklist.myreport');
            }
        } else if (is_numeric($agent_request[1])) {
            $request['id'] = $agent_request[1];
            if (App::isGET()) {
                return member_views('blacklist.view');
            }
        }
    }
}
// not found
if (isset($_SESSION['callback'])) {
    unset($_SESSION['callback']);
    return redirect(member_url());
}
return member_views('404');
