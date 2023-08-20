<?php

use App\Class\App;
use App\Class\Download;

array_shift($agent_request);

// Visitor
if (empty($agent_request[0]) and App::isGET()) {
    return visitor_views('index');
}
// Whitelist
if ($agent_request[0] == 'whitelist' and App::isGET()) {
    if (isset($agent_request[1])) {
        $request['tag'] = $agent_request[1];
        return visitor_views('whitelist.view');
    } else {
        return visitor_views('whitelist.index');
    }
}
// Blacklist
if ($agent_request[0] == 'blacklist' and App::isGET()) {
    if (isset($agent_request[1])) {
        $request['id'] = $agent_request[1];
        return visitor_views('blacklist.view');
    } else {
        return visitor_views('blacklist.index');
    }
}
// Contact
if ($agent_request[0] == 'contact' and App::isGET()) {
    return visitor_views('contact');
}
// Application
if ($agent_request[0] == 'download' and App::isGET()) {
    if (empty($agent_request[1])) {
    } else if ($agent_request[1] == 'android') {
        return Download::transfer('resource/application/android/release.apk', 'IntraCheck.apk');
    }
}
// Privacy Policy
if ($agent_request[0] == 'privacy' and App::isGET()) {
    return visitor_views('privacy');
}
// Terms of Service
if ($agent_request[0] == 'tos' and App::isGET()) {
    return visitor_views('tos');
}

// register email
if (str_starts_with($agent_path, '/register-email')) {
    return member_views('register-email');
}

// verify email
if (str_starts_with($agent_path, '/verify-email')) {
    return member_controller('login.verify-email');
}

// API
if (str_starts_with($agent_path, '/api')) {
    require_once __ROOT__ . '/routes/api.php';
    exit;
}

// Member Panel
if (str_starts_with($agent_path, config('site.member_panel'))) {
    require_once __ROOT__ . '/routes/member.php';
    exit;
}

// Admin Panel
if (str_starts_with($agent_path, config('site.admin_panel'))) {
    require_once __ROOT__ . '/routes/admin.php';
    exit;
}

// not found
return visitor_views('404');
