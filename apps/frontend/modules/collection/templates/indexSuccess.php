<a class="button" href="<?php echo url_for('collection/new?u='.$unitID) ?>">Create Collection</a>
<div class="breadcrumb small"><a href="<?php echo url_for('unit/index') ?>">All Units</a>&nbsp;&gt;&nbsp;<?php echo $unitName ?></div>

<table>
  <thead>
    <tr>
      <th>Collection</th>
      <th>Created</th>
      <th>Created By</th>
      <th>Updated On</th>
      <th>Updated By</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($collections as $collection): ?>
    <tr>
      <td><a href="<?php echo url_for('assetgroup/index?c='.$collection->getId()) ?>"><?php echo $collection->getName() ?></a></td>
      <td><?php echo $collection->getCreatedAt() ?></td>
      <td><?php echo $collection->getCreatorId() ?></td>
      <td><?php echo $collection->getUpdatedAt() ?></td>
      <td><?php echo $collection->getLastEditorId() ?></td>
      <td class="invisible">

<div class="options">
<a href="<?php echo url_for('collection/edit?id='.$collection->getId()).'/u/'.$collection->getParentNodeId() ?>"><img src="/images/wireframes/row-settings-icon.png" alt="Settings" /></a><a href="<?php echo url_for('collection/delete?id='.$collection->getId()).'/u/'.$collection->getParentNodeId() ?>"><img src="/images/wireframes/row-delete-icon.png" alt="Delete" /></a>
</div>

</td>

    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

