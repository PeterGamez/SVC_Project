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
    "lang" => "th",
    "admin_panel" => "/backend",

    "google" => [
        "id" => "704090470537-97c10g406cm14m2lntapii8aq0cg2nbk.apps.googleusercontent.com",
        "secret" => "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",
        "callback" => url('backend.login.google')
    ],
    "cloudflare" => [
        "turnstile" => [
            "key" => "0x4AAAAAAAFtsf6-QCIxSaQT",
            "secret" => "0x4AAAAAAAFtsflcTU2VLqYLAiVzOYBsSs0"
        ]
    ],
];

return $site;