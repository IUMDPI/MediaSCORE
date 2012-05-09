<div id="create-asset-group"><a href="<?php echo url_for('assetgroup/new?c='.$collectionID) ?>">CREATE ASSET GROUP</a></div>
<span><a href="<?php echo url_for('unit') ?>">All Units</a></span>&nbsp;&gt;&nbsp;<span><a href="<?php echo url_for('collection/index?u='.$unitID) ?>"><?php echo $unitName ?></a></span>&nbsp;&gt;&nbsp;<span><?php echo $collectionName ?></span>
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
      <td><?php echo $asset_group->getCreator()->getFullName() ?></td>
      <td><?php echo $asset_group->getUpdatedAt() ?></td>
      <td><?php echo $asset_group->getEditor()->getFullName() ?></td>
      <td><span>delete</span></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

