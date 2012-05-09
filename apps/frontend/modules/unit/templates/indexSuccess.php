
<a class="button" href="<?php echo url_for('unit/new') ?>">Create Unit</a>

<table>
  <thead>
    <tr>
      <th>Unit</th>
      <th>Created</th>
      <th>Created By</th>
      <th>Updated On</th>
      <th>Updated By</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($units as $unit): ?>
    <tr>
      <td><a href="<?php echo url_for('collection/index?u='.$unit->getId()) ?>"><?php echo $unit->getName() ?></a></td>
      <td><?php echo $unit->getCreatedAt() ?></td>
      <td>
<?php
$evaluatorName = $unit->getCreator()->getFullName();
if($evaluatorName == ' ')
	echo 'Administrator';
else
	echo $evaluatorName;
?>
</td>
      <td><?php echo $unit->getUpdatedAt() ?></td>
      <td>
<?php
$lastEditorName = $unit->getEditor()->getFullName();
if($lastEditorName == ' ')
	echo 'Administrator';
else
	echo $lastEditorName;
?>
</td>

<td class="invisible">
	<div class="options">
	<a href="<?php echo url_for('unit/edit?id='.$unit->getId()) ?>"><img src="/images/wireframes/row-settings-icon.png" alt="Settings" /></a>
	<a href="<?php echo url_for('unit/delete?id='.$unit->getId()) ?>"><img src="/images/wireframes/row-delete-icon.png" alt="Delete" /></a>
	</div>
</td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
