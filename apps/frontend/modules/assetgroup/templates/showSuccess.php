<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $asset_group->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $asset_group->getName() ?></td>
    </tr>
    <tr>
      <th>Inst:</th>
      <td><?php echo $asset_group->getInstId() ?></td>
    </tr>
    <tr>
      <th>Notes:</th>
      <td><?php echo $asset_group->getNotes() ?></td>
    </tr>
    <tr>
      <th>Creator:</th>
      <td><?php echo $asset_group->getCreatorId() ?></td>
    </tr>
    <tr>
      <th>Last editor:</th>
      <td><?php echo $asset_group->getLastEditorId() ?></td>
    </tr>
    <tr>
      <th>Type:</th>
      <td><?php echo $asset_group->getType() ?></td>
    </tr>
    <tr>
      <th>Resident structure description:</th>
      <td><?php echo $asset_group->getResidentStructureDescription() ?></td>
    </tr>
    <tr>
      <th>Storage location:</th>
      <td><?php echo $asset_group->getStorageLocationId() ?></td>
    </tr>
    <tr>
      <th>Unit personnel:</th>
      <td><?php echo $asset_group->getUnitPersonnel() ?></td>
    </tr>
    <tr>
      <th>Parent node:</th>
      <td><?php echo $asset_group->getParentNodeId() ?></td>
    </tr>
    <tr>
      <th>Status:</th>
      <td><?php echo $asset_group->getStatus() ?></td>
    </tr>
    <tr>
      <th>Location:</th>
      <td><?php echo $asset_group->getLocation() ?></td>
    </tr>
    <tr>
      <th>Format:</th>
      <td><?php echo $asset_group->getFormatId() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $asset_group->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $asset_group->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('assetgroup/edit?id='.$asset_group->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('assetgroup/index') ?>">List</a>
