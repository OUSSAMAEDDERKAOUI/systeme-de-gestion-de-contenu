<?php

function isAuth($role)
{
    if (isset($_SESSION['user_id']) && isset($_SESSION['user_role'])) {
        return $_SESSION['user_role'] == $role;
    } else if ($role == 'autre') {
        return true;
    }

    return false;
}
?>