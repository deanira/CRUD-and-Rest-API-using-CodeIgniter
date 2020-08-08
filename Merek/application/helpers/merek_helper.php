<?php

function cekLogin()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        $ci->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Anda harus login terlebih dahulu!
                    </div>');
        redirect('auth');
    } else {
        $role_id = $ci->session->userdata('role_id');
        $menu = $ci->uri->segment(1);

        $query = $ci->db->get_where('user_menu', ['menu' => $menu])->row_array();
        $menu_id = $query['id'];

        $userAccess = $ci->db->get_where('user_access_menu', ['role_id' => $role_id, 'menu_id' => $menu_id]);

        if ($userAccess->num_rows() < 1) {
            redirect('auth/blocked');
        }
    }
}

function cekAkses($role_id, $menu_id)
{
    $ci = get_instance();
    $result = $ci->db->get_where('user_access_menu', [
        'role_id' => $role_id,
        'menu_id' => $menu_id
    ]);

    if ($menu_id == 1) {
        if ($result->num_rows() > 0) {
            $checked = "checked = 'checked' disabled";
            return $checked;
        } else {
            $checked = "disabled";
            return $checked;
        }
    } else {
        if ($result->num_rows() > 0) {
            $checked = "checked = 'checked'";
            return $checked;
        }
    }
}
