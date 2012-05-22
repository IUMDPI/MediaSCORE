<?php use_helper('I18N', 'Date') ?>
<?php include_partial('sfGuardUser/assets') ?>

<div id="sf_admin_container">
	<?php echo get_slot('settingsMenu') ?>

  <h1><?php echo __(null, array(), 'messages') ?></h1>

  <?php include_partial('sfGuardUser/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('sfGuardUser/list_header', array('pager' => $pager)) ?>
  </div>

<a class="button" href="<?php echo url_for('sfGuardUser/new') ?>">Create User</a>

  <div id="sf_admin_bar">
  </div>

  <div id="sf_admin_content">
    <form action="<?php echo url_for('sf_guard_user_collection', array('action' => 'batch')) ?>" method="post">
    <?php include_partial('sfGuardUser/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>
    </form>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('sfGuardUser/list_footer', array('pager' => $pager)) ?>
  </div>
</div>
