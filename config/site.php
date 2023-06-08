<?php
$site = [
    "name" => "Intra Check",
    "description" => "INTRA CHECK เว็บแอปพลิเคชั่นรวบรวมการกระทำผิด และการตรวจสอบในองค์กร",
    "logo" => [
        "64" => resource('images/logo-64.png', true),
        "128" => resource('images/logo-128.png', true),
        "256" => resource('images/logo-256.png', true),
        "ico" => resource('images/logo.ico', true),
    ],
    "admin_panel" => "/backend",

    "google" => [
        "id" => "704090470537-j17c60vgubje74mb0bqgdk8bvm27lq58.apps.googleusercontent.com",
        "secret" => "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",
        "callback" => url('backend.login.google.callback')
    ],
    "cloudflare" => [
        "turnstile" => [
            "key" => "0x4AAAAAAAFtsf6-QCIxSaQT",
            "secret" => "0x4AAAAAAAFtsflcTU2VLqYLAiVzOYBsSs0"
        ]
    ],
];

return $site;