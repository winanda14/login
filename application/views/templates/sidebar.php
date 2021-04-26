<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon ">
          <i class="fas fa-user-shield"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Dashboard</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider ">


    <!-- QUery Menu -->
    <?php
      $level_id = $this->session->userdata('level_id');
      $querymenu= "SELECT `user_menu`.`id`,`menu` FROM `user_menu` JOIN `user_access_menu`
                    ON `user_menu`.`id`= `user_access_menu`.`menu_id`
                    WHERE `user_access_menu`.`level_id`= $level_id
                    ORDER BY `user_access_menu`.`menu_id` ASC
                    ";
      $menu = $this->db->query($querymenu)->result_array();

     ?>




    <!-- Looping Menus -->
    <?php  foreach ($menu as $m ) : ?>
    <div class="sidebar-heading">
        <?= $m['menu'];  ?>
    </div>

    <?php
    $menuid= $m['id'];
    $querysubmenu= "SELECT * FROM `user_sub_menu` JOIN `user_menu`
                  ON `user_sub_menu`.`menu_id`= `user_menu`.`id`
                  WHERE `user_sub_menu`.`menu_id`= $menuid
                    AND `user_sub_menu`.`is_active`=1
                  ";
    $submenu= $this->db->query($querysubmenu)->result_array();
    ?>

      <?php foreach ($submenu as $sm) : ?>
      <?php if($title == $sm['title']) : ?>
      <li class="nav-item active">
        <?php else: ?>
      <li class="nav-item">
      <?php endif; ?>
        <!-- Nav Item - Dashboard -->
            <a class="nav-link" href="<?php echo base_url($sm['url']); ?>">
                <i class="<?= $sm['icon'];  ?>"></i>
                <span><?php echo $sm['title'];  ?></span></a>
      </li>
      <?php endforeach; ?>


    <hr class="sidebar-divider">
    <?php endforeach; ?>



    <!-- Divider -->


    <!-- Divider -->

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('auth/logout'); ?>">
            <i class="fas fa-fw fa-sign-out-alt"></i>
            <span>Logout </span></a>
    </li>



    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
