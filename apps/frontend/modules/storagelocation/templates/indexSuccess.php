

<!-- 05/05/12: include_javascripts() did not produce this in response to AJAX requests
<script type="text/javascript" src="/symfony/mediascore1.0a/js/jquery_evaluator_history_index.js"></script>
-->

<?php echo include_javascripts() ?>

<?php
	/*
	For the following modules:
		storagelocation
		sfGuardUser
		person
	*/
	slot(	'settingsMenu',
		sprintf('<ul id="settings-navigation">
			<li class=""><a class="menu-link" href="%s">Users</a></li>
			<li class=""><a class="menu-link" href="%s">Unit Personnel</a></li>
			<li class=""><a class="menu-link" href="%s">Storage Locations</a></li>
			<li class="">%s</li></ul>',
		url_for('sfGuardUser/index'),
		url_for('person/index'),
		url_for('storagelocation/index'),
		link_to2('Edit Profile','sf_guard_user_edit',$sf_user->getGuardUser(),array('class' => 'menu-link'))))
?>

<div id="settings-container">

<?php echo get_slot('settingsMenu') ?>
<a class="button" href="<?php echo url_for('storagelocation/new') ?>">Create Storage Location</a>

<table>
  <thead>
    <tr>
      <th>Storage Location</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($storage_locations as $storage_location): ?>
    <tr>
      <td><?php echo $storage_location->getName() ?></td>

<td class="invisible">
	<div class="options">
	<a href="<?php echo url_for('storagelocation/edit?id='.$storage_location->getId()) ?>"><img src="/images/wireframes/row-settings-icon.png" alt="Settings" /></a>
	<a href="<?php echo url_for('storagelocation/delete?id='.$storage_location->getId()) ?>"><img src="/images/wireframes/row-delete-icon.png" alt="Delete" /></a>
	</div>
</td>
</tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>
</div>

