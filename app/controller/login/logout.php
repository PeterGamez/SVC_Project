<?php
session_destroy();

redirect(config('site.admin_panel') . '/login');