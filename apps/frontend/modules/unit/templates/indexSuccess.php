<div><span><a href="<?php echo url_for('storagelocation/index') ?>">Manage Storage Locations</a></span></div>
<div id="create-unit"><a href=" <?php echo url_for('unit/new') ?>">CREATE UNIT</a></div>
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
      <td><span><a href="<?php echo url_for('unit/edit?id='.$unit->getId()) ?>">edit</a></span>&nbsp;&#47;&nbsp;<span><a href="<?php echo url_for('unit/delete?id='.$unit->getId()) ?>">delete</a></span></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
