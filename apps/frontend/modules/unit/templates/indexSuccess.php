<h1>Units List</h1>

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
    <?php foreach ($units as $unit): ?>
    <tr>
      <td><a href="<?php echo url_for('unit/show?id='.$unit->getId()) ?>"><?php echo $unit->getId() ?></a></td>
      <td><?php echo $unit->getName() ?></td>
      <td><?php echo $unit->getInstId() ?></td>
      <td><?php echo $unit->getNotes() ?></td>
      <td><?php echo $unit->getCreatorId() ?></td>
      <td><?php echo $unit->getLastEditorId() ?></td>
      <td><?php echo $unit->getType() ?></td>
      <td><?php echo $unit->getResidentStructureDescription() ?></td>
      <td><?php echo $unit->getStorageLocationId() ?></td>
      <td><?php echo $unit->getUnitPersonnel() ?></td>
      <td><?php echo $unit->getParentNodeId() ?></td>
      <td><?php echo $unit->getStatus() ?></td>
      <td><?php echo $unit->getLocation() ?></td>
      <td><?php echo $unit->getFormatId() ?></td>
      <td><?php echo $unit->getCreatedAt() ?></td>
      <td><?php echo $unit->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('unit/new') ?>">New</a>
