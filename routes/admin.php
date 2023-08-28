<?php

use App\Class\App;
use App\Controllers\Admin\Account;
use App\Controllers\Admin\Approve;
use App\Controllers\Admin\Bank;
use App\Controllers\Admin\Blacklist;
use App\Controllers\Admin\BlacklistCategory;
use App\Controllers\Admin\Whitelist;
use App\Controllers\Admin\WhitelistWaiting;

array_shift($agent_request);
// Chcek Login
if ($_SESSION['login'] == false) {
    // Redirect to Login
    $_SESSION['callback'] = url($agent_path);
    return redirect(member_url('login'));
} else if (!in_array($_SESSION['user_role'], ['superadmin', 'admin', 'staff'])) {
    return redirect(member_url());
}
// Dashboard
else if (empty($agent_request[0]) and App::isGET()) {
    return admin_views('index');
}
// Whitelist
else if ($agent_request[0] == 'whitelist') {
    // index
    if (empty($agent_request[1]) and App::isGET()) {
        return admin_views('whitelist.index');
    }
    // waiting
    else if ($agent_request[1] == 'waiting') {
        // index
        if (empty($agent_request[2]) and App::isGET()) {
            return admin_views('whitelist.waiting.index');
        }
        // check is number
        else if (is_numeric($agent_request[2])) {
            $request['id'] = $agent_request[2];
            // view
            if (empty($agent_request[3]) and App::isGET()) {
                return admin_views('whitelist.waiting.view');
            }
            // approve
            else if ($agent_request[3] == 'approve') {
                if (App::isGET()) {
                    return admin_views('whitelist.waiting.approve');
                } else if (App::isPOST()) {
                    return WhitelistWaiting::approve();
                }
            }
        }
    }
    // add
    else if ($agent_request[1] == 'add' and in_array($_SESSION['user_role'], ['superadmin', 'admin'])) {
        if (App::isGET()) {
            return admin_views('whitelist.add');
        } else if (App::isPOST()) {
            return Whitelist::add();
        }
    }
    // check is number
    else if (is_numeric($agent_request[1])) {
        $request['id'] = $agent_request[1];
        // view
        if (empty($agent_request[2]) and App::isGET()) {
            return admin_views('whitelist.view');
        }
        // edit
        else if ($agent_request[2] == 'edit'  and in_array($_SESSION['user_role'], ['superadmin', 'admin'])) {
            if (App::isGET()) {
                return admin_views('whitelist.edit');
            } else if (App::isPOST()) {
                return Whitelist::edit();
            }
        }
        // delete
        else if ($agent_request[2] == 'delete' and in_array($_SESSION['user_role'], ['superadmin', 'admin'])) {
            if (App::isGET()) {
                return admin_views('whitelist.delete');
            } else if (App::isPOST()) {
                return Whitelist::delete();
            }
        }
    }
}
// Blacklist
else if ($agent_request[0] == 'blacklist') {
    // index
    if (empty($agent_request[1]) and App::isGET()) {
        return admin_views('blacklist.index');
    }
    // add
    else if ($agent_request[1] == 'add' and in_array($_SESSION['user_role'], ['superadmin', 'admin'])) {
        if (App::isGET()) {
            return admin_views('blacklist.add');
        } else if (App::isPOST()) {
            return Blacklist::add();
        }
    }
    // check is number
    else if (is_numeric($agent_request[1])) {
        $request['id'] = $agent_request[1];
        // view
        if (empty($agent_request[2]) and App::isGET()) {
            return admin_views('blacklist.view');
        }
        // edit
        if ($agent_request[2] == 'edit' and in_array($_SESSION['user_role'], ['superadmin', 'admin'])) {
            if (App::isGET()) {
                return admin_views('blacklist.edit');
            } else if (App::isPOST()) {
                return Blacklist::edit();
            }
        }
        // delete
        else if ($agent_request[2] == 'delete' and in_array($_SESSION['user_role'], ['superadmin', 'admin'])) {
            if (App::isGET()) {
                return admin_views('blacklist.delete');
            } else if (App::isPOST()) {
                return Blacklist::delete();
            }
        }
        // approve
        else if ($agent_request[2] == 'approve') {
            if (App::isGET()) {
                return admin_views('blacklist.approve');
            } else if (App::isPOST()) {
                return Blacklist::approve();
            }
        }
    }
    // category
    else if ($agent_request[1] == 'category' and in_array($_SESSION['user_role'], ['superadmin', 'admin'])) {
        if (empty($agent_request[2]) and App::isGET()) {
            return admin_views('blacklist.category.index');
        }
        // add
        if ($agent_request[2] == 'add') {
            if (App::isGET()) {
                return admin_views('blacklist.category.add');
            } else if (App::isPOST()) {
                return BlacklistCategory::add();
            }
        }
        // check is number
        else if (is_numeric($agent_request[2])) {
            $request['id'] = $agent_request[2];
            // edit
            if ($agent_request[3] == 'edit') {
                if (App::isGET()) {
                    return admin_views('blacklist.category.edit');
                } else if (App::isPOST()) {
                    return BlacklistCategory::edit();
                }
            }
            // delete
            else if ($agent_request[3] == 'delete') {
                if (App::isGET()) {
                    return admin_views('blacklist.category.delete');
                } else if (App::isPOST()) {
                    return BlacklistCategory::delete();
                }
            }
        }
    }
}
// Setting
/// Account
else if ($agent_request[0] == 'account' and in_array($_SESSION['user_role'], ['superadmin'])) {
    // index
    if (empty($agent_request[1]) and App::isGET()) {
        return admin_views('account.index');
    }
    // add
    else if ($agent_request[1] == 'add') {
        if (App::isGET()) {
            return admin_views('account.add');
        } else if (App::isPOST()) {
            return Account::add();
        }
    }
    // check is number
    else if (is_numeric($agent_request[1])) {
        $request['id'] = $agent_request[1];
        // view
        if (empty($agent_request[2]) and App::isGET()) {
            return admin_views('account.view');
        }
        // edit
        else if ($agent_request[2] == 'edit') {
            if (App::isGET()) {
                return admin_views('account.edit');
            } else if (App::isPOST()) {
                return Account::edit();
            }
        }
        // password
        else if ($agent_request[2] == 'password') {
            if (App::isGET()) {
                return admin_views('account.password');
            } else if (App::isPOST()) {
                return Account::password();
            }
        }
        // delete
        else if ($agent_request[2] == 'delete') {
            if (App::isGET()) {
                return admin_views('account.delete');
            } else if (App::isPOST()) {
                return Account::delete();
            }
        }
    }
}
/// Bank
else if ($agent_request[0] == 'bank' and in_array($_SESSION['user_role'], ['superadmin', 'admin'])) {
    // index
    if (empty($agent_request[1]) and App::isGET()) {
        return admin_views('bank.index');
    }
    // add
    else if ($agent_request[1] == 'add') {
        if (App::isGET()) {
            return admin_views('bank.add');
        } else if (App::isPOST()) {
            return Bank::add();
        }
    }
    // check is number
    else if (is_numeric($agent_request[1])) {
        $request['id'] = $agent_request[1];
        // view
        if (empty($agent_request[1]) and App::isGET()) {
            return admin_views('bank.view');
        }
        // check is number
        else if (is_numeric($agent_request[1])) {
            $request['id'] = $agent_request[1];
            // edit
            if ($agent_request[2] == 'edit') {
                if (App::isGET()) {
                    return admin_views('bank.edit');
                } else if (App::isPOST()) {
                    return Bank::edit();
                }
            }
            // delete
            else if ($agent_request[2] == 'delete') {
                if (App::isGET()) {
                    return admin_views('bank.delete');
                } else if (App::isPOST()) {
                    return Bank::delete();
                }
            }
        }
    }
}
/// Approve
else if ($agent_request[0] == 'approve' and in_array($_SESSION['user_role'], ['superadmin', 'admin'])) {
    // index
    if (empty($agent_request[1])) {
        return admin_views('approve.index');
    }
    // add
    else if ($agent_request[1] == 'add') {
        if (App::isGET()) {
            return admin_views('approve.add');
        } else if (App::isPOST()) {
            return Approve::add();
        }
    }
    // check is number
    else if (is_numeric($agent_request[1])) {
        $request['id'] = $agent_request[1];
        // view
        if (empty($agent_request[2]) and App::isGET()) {
            return admin_views('approve.view');
        }
        // edit
        else if ($agent_request[2] == 'edit') {
            if (App::isGET()) {
                return admin_views('approve.edit');
            } else if (App::isPOST()) {
                return Approve::edit();
            }
        }
        // delete
        else if ($agent_request[2] == 'delete') {
            if (App::isGET()) {
                return admin_views('approve.delete');
            } else if (App::isPOST()) {
                return Approve::delete();
            }
        }
    }
}
// not found
if (isset($_SESSION['callback'])) {
    unset($_SESSION['callback']);
    return redirect(admin_url());
}
return admin_views('404');
