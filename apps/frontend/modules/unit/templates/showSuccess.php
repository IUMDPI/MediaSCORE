<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $unit->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $unit->getName() ?></td>
    </tr>
    <tr>
      <th>Inst:</th>
      <td><?php echo $unit->getInstId() ?></td>
    </tr>
    <tr>
      <th>Notes:</th>
      <td><?php echo $unit->getNotes() ?></td>
    </tr>
    <tr>
      <th>Creator:</th>
      <td><?php echo $unit->getCreatorId() ?></td>
    </tr>
    <tr>
      <th>Last editor:</th>
      <td><?php echo $unit->getLastEditorId() ?></td>
    </tr>
    <tr>
      <th>Type:</th>
      <td><?php echo $unit->getType() ?></td>
    </tr>
    <tr>
      <th>Resident structure description:</th>
      <td><?php echo $unit->getResidentStructureDescription() ?></td>
    </tr>
    <tr>
      <th>Storage location:</th>
      <td><?php echo $unit->getStorageLocationId() ?></td>
    </tr>
    <tr>
      <th>Unit personnel:</th>
      <td><?php echo $unit->getUnitPersonnel() ?></td>
    </tr>
    <tr>
      <th>Parent node:</th>
      <td><?php echo $unit->getParentNodeId() ?></td>
    </tr>
    <tr>
      <th>Status:</th>
      <td><?php echo $unit->getStatus() ?></td>
    </tr>
    <tr>
      <th>Location:</th>
      <td><?php echo $unit->getLocation() ?></td>
    </tr>
    <tr>
      <th>Format:</th>
      <td><?php echo $unit->getFormatId() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $unit->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $unit->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('unit/edit?id='.$unit->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('unit/index') ?>">List</a>
