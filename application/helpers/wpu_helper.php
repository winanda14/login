<?php

function is_logged_in(){
  $ci = get_instance();
  if (!$ci->session->userdata('email')){
    redirect('auth');
  }else{
    $level_id = $ci->session->userdata('level_id');
    $menu = $ci->uri->segment(1);

    $queryMenu = $ci->db->get_where('user_menu',['menu' => $menu])->row_array
    ();
    $menu_id = $queryMenu['id'];

    $userAccess = $ci->db->get_where('user_access_menu', [
                  'menu_id'  => $menu_id,
                  'level_id' => $level_id

    ]);

    if ($userAccess->num_rows()  < 1) {
          redirect('auth/blocked');
    }

  }

}
