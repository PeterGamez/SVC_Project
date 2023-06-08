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
            if (isset($agent_request[3]) and $agent_request[3] == 'callback' and $agent_method == 'POST') {
                if ($agent_request[4] == 'form') {
                    return controller('login.form');
                } else if ($agent_request[4] == 'google') {
                    return controller('login.google');
                }
            } else {
                return admin_views('login');
            }
        }
    }
    if (!isset($agent_request[2])) {
        return admin_views('index');
    }
    // profile
    else if ($agent_request[2] == 'logout') {
        return controller('login.logout');
    }
    // setting
    else if ($agent_request[2] == 'account') {
        if (isset($agent_request[3])) {
            $request['id'] = $agent_request[3];
            return admin_views('account.view');
        }
        return admin_views('account.index');
    }
}
