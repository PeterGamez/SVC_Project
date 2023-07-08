<?php
if (isset($_GET['token'])) {
    $token = $_GET['token'];
} else {
    redirect(url('login'));
}
