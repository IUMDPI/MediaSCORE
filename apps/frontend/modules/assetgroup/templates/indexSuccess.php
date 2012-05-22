<a class="button" href="<?php echo url_for('assetgroup/new?c='.$collectionID) ?>">Create Asset Group</a>

<div class="breadcrumb small"><a href="<?php echo url_for('unit/index') ?>">All Units</a>&nbsp;&gt;&nbsp;<a href="<?php echo url_for('collection/index?u='.$unitID) ?>"><?php echo $unitName ?></a>&nbsp;&gt;&nbsp;<?php echo $collectionName ?></div>

<table>
  <thead>
    <tr>
      <th>Asset Groups</th>
      <th>Created</th>
      <th>Created By</th>
      <th>Updated On</th>
      <th>Updated By</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
<?php /*print_r($persons)->toArray()*/ ?>
    <?php foreach ($asset_groups as $asset_group): ?>
    <tr>
      <td><a href="<?php echo url_for('assetgroup/edit?id='.$asset_group->getId().'&c='.$collectionID) ?>"><?php echo $asset_group->getName() ?></a></td>
      <td><?php echo $asset_group->getCreatedAt() ?></td>
      <td><?php echo $asset_group->getCreator()->getName() ?></td>
      <td><?php echo $asset_group->getUpdatedAt() ?></td>
      <td><?php echo $asset_group->getEditor()->getName() ?></td>
      <td class="invisible">
	<div class="options">
	<a href="<?php echo url_for('assetgroup/delete?id='.$asset_group->getId()) ?>"><img src="/images/wireframes/row-delete-icon.png" alt="Delete" /></a>
	</div>
	</td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

