<h1>Asset groups List</h1>

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
    <?php foreach ($asset_groups as $asset_group): ?>
    <tr>
      <td><a href="<?php echo url_for('assetgroup/show?id='.$asset_group->getId()) ?>"><?php echo $asset_group->getId() ?></a></td>
      <td><?php echo $asset_group->getName() ?></td>
      <td><?php echo $asset_group->getInstId() ?></td>
      <td><?php echo $asset_group->getNotes() ?></td>
      <td><?php echo $asset_group->getCreatorId() ?></td>
      <td><?php echo $asset_group->getLastEditorId() ?></td>
      <td><?php echo $asset_group->getType() ?></td>
      <td><?php echo $asset_group->getResidentStructureDescription() ?></td>
      <td><?php echo $asset_group->getStorageLocationId() ?></td>
      <td><?php echo $asset_group->getUnitPersonnel() ?></td>
      <td><?php echo $asset_group->getParentNodeId() ?></td>
      <td><?php echo $asset_group->getStatus() ?></td>
      <td><?php echo $asset_group->getLocation() ?></td>
      <td><?php echo $asset_group->getFormatId() ?></td>
      <td><?php echo $asset_group->getCreatedAt() ?></td>
      <td><?php echo $asset_group->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('assetgroup/new') ?>">New</a>
