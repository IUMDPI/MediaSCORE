<h1>Collections List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Inst</th>
      <th>Notes</th>
      <th>Creator</th>
      <th>Last editor</th>
      <th>Type</th>
      <th>Resident structure description</th>
      <th>Storage location</th>
      <th>Unit personnel</th>
      <th>Parent node</th>
      <th>Status</th>
      <th>Location</th>
      <th>Format</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($collections as $collection): ?>
    <tr>
      <td><a href="<?php echo url_for('collection/show?id='.$collection->getId()) ?>"><?php echo $collection->getId() ?></a></td>
      <td><?php echo $collection->getName() ?></td>
      <td><?php echo $collection->getInstId() ?></td>
      <td><?php echo $collection->getNotes() ?></td>
      <td><?php echo $collection->getCreatorId() ?></td>
      <td><?php echo $collection->getLastEditorId() ?></td>
      <td><?php echo $collection->getType() ?></td>
      <td><?php echo $collection->getResidentStructureDescription() ?></td>
      <td><?php echo $collection->getStorageLocationId() ?></td>
      <td><?php echo $collection->getUnitPersonnel() ?></td>
      <td><?php echo $collection->getParentNodeId() ?></td>
      <td><?php echo $collection->getStatus() ?></td>
      <td><?php echo $collection->getLocation() ?></td>
      <td><?php echo $collection->getFormatId() ?></td>
      <td><?php echo $collection->getCreatedAt() ?></td>
      <td><?php echo $collection->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('collection/new') ?>">New</a>
