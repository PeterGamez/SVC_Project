<?php

use App\Class\Api;

function config($key): ?string
{
    $configKeys = explode('.', $key);
    $filename = array_shift($configKeys);
    $config = include(__ROOT__ . '/config/' . $filename . '.php');

    foreach ($configKeys as $nestedKey) {
        if (isset($config[$nestedKey])) {
            $config = $config[$nestedKey];
        } else {
            $config = null;
        }
    }

    return $config;
}

function resource($key, $url = false)
{
    global $site, $request;

    $resourcePath = __ROOT__ . '/public/resource/' . $key;
    if (file_exists($resourcePath)) {
        if ($url == true) {
            $value = explode('.', $key);
            $key = $value[0];
            array_shift($value);
            $ext = implode('.', $value);

            return url('resource/' . $key, $ext);
        } else {
            include $resourcePath;
            return;
        }
    }
    return null;
}

function url($path = '', $ext = ''): string
{
    $protocol = $_SERVER['REQUEST_SCHEME'] . '://';
    if (!$path) $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    else {
        $path = str_replace('.', '/', $path);
        if ($path[0] != '/') $path = '/' . $path;
    }
    $url = $protocol . $_SERVER['HTTP_HOST'] . $path;
    if ($ext) $url .= '.' . $ext;
    return $url;
}

function sub_url($sub, $path = '', $ext = ''): string
{
    return url($sub . '/' . $path, $ext);
}

function admin_url($path = null, $ext = ''): string
{
    if (empty($path)) return url(config('site.admin_panel'));
    return url(config('site.admin_panel') . '/' . $path, $ext);
}

function member_url($path = null, $ext = ''): string
{
    if (empty($path)) return url(config('site.member_panel'));
    return url(config('site.member_panel') . '/' . $path, $ext);
}

function url_back(): string
{
    if ($_SERVER['HTTP_REFERER']) return $_SERVER['HTTP_REFERER'];
    else return url();
}

function redirect($path): void
{
    header('Location: ' . $path);
    exit;
}

function views($filename)
{
    global $site, $request;

    $filename = str_replace('.', '/', $filename);
    $viewPath = __ROOT__ . '/views/' . $filename . '.php';
    if (file_exists($viewPath)) {
        include $viewPath;
        return;
    }
    return null;
}

function admin_views($path = ''): ?string
{
    global $site, $request;

    return views('admin/' . $path);
}

function member_views($path = ''): ?string
{
    global $site, $request;

    return views('member/' . $path);
}

function visitor_views($path = ''): ?string
{
    global $site, $request;

    return views('visitor/' . $path);
}

function api($method, $filename): void
{
    global $request;

    if (str_contains($method, '|')) {
        $methods = explode('|', $method);
        if (!in_array($_SERVER['REQUEST_METHOD'], $methods)) {
            echo Api::error_405();
            exit;
        }
    } else {
        if ($method != $_SERVER['REQUEST_METHOD']) {
            echo Api::error_405();
            exit;
        }
    }

    $filename = str_replace('.', '/', $filename);
    $viewPath = __ROOT__ . '/api/' . $filename . '.php';
    if (file_exists($viewPath)) {
        include $viewPath;
        return;
    }
}

function loaddir($path)
{
    $folders = scandir($path); // ไฟล์ทั้งหมดในโฟลเดอร์
    foreach ($folders as $key => $value) {
        if ($value == '.' || $value == '..') continue; 
        if (is_dir($path . '/' . $value)) {
            $files = scandir($path . '/' . $value); // ไฟล์ทั้งหมดในโฟลเดอร์
            foreach ($files as $key => $file) {
                if ($file == '.' || $file == '..') continue;
                if (substr($file, -4) == '.php') { // เฉพาะไฟล์ .php
                    require_once $path . '/' . $value . '/' . $file;
                }
            }
        } else {
            if (substr($value, -4) == '.php') { // เฉพาะไฟล์ .php
                require_once $path . '/' . $value;
            }
        }
    }
}
