<h1>Collections List</h1>

<div id="create-collection">CREATE COLLECTION</div>

<span><a href="<?php echo url_for('unit/index') ?>">All Units</a></span>&nbsp;&gt;&nbsp;<span><?php echo $unitName ?></span>
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
      <td><span><a href="<?php echo url_for('collection/edit?id='.$collection->getId()).'/u/'.$collection->getParentNodeId() ?>">edit</a></span>&nbsp;&#47;&nbsp;<span><a href="<?php echo url_for('collection/delete?id='.$collection->getId()).'/u/'.$collection->getParentNodeId() ?>">delete</a></span></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

