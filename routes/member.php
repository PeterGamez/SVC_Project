<?php

use App\Class\App;

array_shift($agent_request);
// Chcek Login
if ($_SESSION['login'] == false) {
    // Login
    if ($agent_request[0] == 'register') {
        if (App::isGET()) {
            return member_views('register');
        } else if (App::isPOST()) {
            return member_controller('login.register');
        }
    } else if ($agent_request[0] == 'login') {
        if (isset($agent_request[1])) {
            // Callback
            if ($agent_request[1] == 'callback') {
                if (isset($agent_request[2]) and App::isPOST()) {
                    // Site Form
                    if ($agent_request[2] == 'form') {
                        return member_controller('login.form');
                    }
                    // Google API
                    else if ($agent_request[2] == 'google') {
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
else if (empty($agent_request[0]) and App::isGET()) {
    return member_views('index');
}
// Logout
else if ($agent_request[0] == 'logout' and App::isGET()) {
    return member_controller('login.logout');
}
// Profile
else if ($agent_request[0] == 'profile') {
    if (isset($agent_request[1])) {
        if ($agent_request[1] == 'password') {
            if (App::isGET()) {
                return member_views('profile.password');
            } else if (App::isPOST()) {
                return member_controller('profile.password');
            }
        }
    }
}
// Whitelist
else if ($agent_request[0] == 'whitelist') {
    if (isset($agent_request[1])) {
        if ($agent_request[1] == 'register' and $_SESSION['user_role'] <> 'seller') {
            if (App::isGET()) {
                return member_views('whitelist.register');
            } else if (App::isPOST()) {
                return member_controller('whitelist.register');
            }
        } else if ($agent_request[1] == 'setting' and $_SESSION['user_role'] == 'seller') {
            if (App::isGET()) {
                return member_views('whitelist.setting');
            } else if (App::isPOST()) {
                return member_controller('whitelist.setting');
            }
        } else if ($agent_request[1] == 'delete' and $_SESSION['user_role'] == 'seller' and App::isPOST()) {
            return member_controller('whitelist.delete');
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
                return member_controller('blacklist.report');
            }
        } else if ($agent_request[1] == 'myreport') {
            if (App::isGET()) {
                return member_views('blacklist.myreport');
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
