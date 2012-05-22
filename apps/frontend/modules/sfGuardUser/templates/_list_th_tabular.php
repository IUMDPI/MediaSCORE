<?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_first_name">
  <?php if ('first_name' == $sort[0]): ?>
    <?php echo link_to(__('First Name', array(), 'messages'), '@sf_guard_user', array('query_string' => 'sort=first_name&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('First Name', array(), 'messages'), '@sf_guard_user', array('query_string' => 'sort=first_name&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>

<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_last_name">
  <?php if ('last_name' == $sort[0]): ?>
    <?php echo link_to(__('Last Name', array(), 'messages'), '@sf_guard_user', array('query_string' => 'sort=last_name&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Last Name', array(), 'messages'), '@sf_guard_user', array('query_string' => 'sort=last_name&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>

<?php include_slot('sf_admin.current_header') ?><?php slot('sf_admin.current_header') ?>
<th class="sf_admin_text sf_admin_list_th_email_address">
  <?php if ('email_address' == $sort[0]): ?>
    <?php echo link_to(__('Email', array(), 'messages'), '@sf_guard_user', array('query_string' => 'sort=email_address&sort_type='.($sort[1] == 'asc' ? 'desc' : 'asc'))) ?>
    <?php echo image_tag(sfConfig::get('sf_admin_module_web_dir').'/images/'.$sort[1].'.png', array('alt' => __($sort[1], array(), 'sf_admin'), 'title' => __($sort[1], array(), 'sf_admin'))) ?>
  <?php else: ?>
    <?php echo link_to(__('Email', array(), 'messages'), '@sf_guard_user', array('query_string' => 'sort=email_address&sort_type=asc')) ?>
  <?php endif; ?>
</th>
<?php end_slot(); ?>

<?php include_slot('sf_admin.current_header') ?>

