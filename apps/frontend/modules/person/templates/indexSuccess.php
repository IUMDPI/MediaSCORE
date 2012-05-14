
<?php echo get_slot('settingsMenu') ?>

<div id="settings-container">
<table>
  <thead>
    <tr>
      <th>First name</th>
      <th>Last name</th>
      <th>Email</th>
      <th>Units</th>
	<th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($persons as $person): ?>
    <tr>
      <td><?php echo $person->getFirstName() ?></td>
      <td><?php echo $person->getLastName() ?></td>
      <td><?php echo $person->getEmail() ?></td>
	<td>
	<?php foreach( $person->getUnits() as $unit ): ?>
		<div><span><?php echo $unit->getName() ?></span></div>
	<?php endforeach ?>
	</td>
<td class="invisible">
	<div class="options">
	<a href="<?php echo url_for('person/edit?id='.$person->getId()) ?>"><img src="/images/wireframes/row-settings-icon.png" alt="Settings" /></a>
	<a href="<?php echo url_for('person/delete?id='.$person->getId()) ?>"><img src="/images/wireframes/row-delete-icon.png" alt="Delete" /></a>
	</div>
</td>
	</tr>
<?php endforeach ?>
  </tbody>
</table>
</div>

