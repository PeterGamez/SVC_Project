<?php

namespace App\Class;

class Alert
{
    public static function alert(string $title, string $icon, string $timer, string $willClose): string
    {
        return "<body><script>
            Swal.fire({
                title: '$title',
                icon: '$icon',
                timer: $timer,
                willClose: () => {
                    $willClose
                }
            })
        </script></body>";
    }
    public static function alerts(string $title, string $icon, string $timer, string $willClose): string
    {
        return "<head>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.7.23/sweetalert2.all.min.js'></script>
        </head>
        <body>
            <script>
                Swal.fire({
                    title: '" . $title . "',
                    icon: '" . $icon . "',
                    timer: " . $timer . ",
                    willClose: () => {
                        " . $willClose . "
                    }
                })
            </script>
        </body>";
    }

    public static function error(): string
    {
        return self::alert('เกิดข้อผิดพลาด', 'error', 1500, 'history.back()');
    }
}
