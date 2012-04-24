<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $collection->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $collection->getName() ?></td>
    </tr>
    <tr>
      <th>Inst:</th>
      <td><?php echo $collection->getInstId() ?></td>
    </tr>
    <tr>
      <th>Notes:</th>
      <td><?php echo $collection->getNotes() ?></td>
    </tr>
    <tr>
      <th>Creator:</th>
      <td><?php echo $collection->getCreatorId() ?></td>
    </tr>
    <tr>
      <th>Last editor:</th>
      <td><?php echo $collection->getLastEditorId() ?></td>
    </tr>
    <tr>
      <th>Type:</th>
      <td><?php echo $collection->getType() ?></td>
    </tr>
    <tr>
      <th>Resident structure description:</th>
      <td><?php echo $collection->getResidentStructureDescription() ?></td>
    </tr>
    <tr>
      <th>Storage location:</th>
      <td><?php echo $collection->getStorageLocationId() ?></td>
    </tr>
    <tr>
      <th>Unit personnel:</th>
      <td><?php echo $collection->getUnitPersonnel() ?></td>
    </tr>
    <tr>
      <th>Parent node:</th>
      <td><?php echo $collection->getParentNodeId() ?></td>
    </tr>
    <tr>
      <th>Status:</th>
      <td><?php echo $collection->getStatus() ?></td>
    </tr>
    <tr>
      <th>Location:</th>
      <td><?php echo $collection->getLocation() ?></td>
    </tr>
    <tr>
      <th>Format:</th>
      <td><?php echo $collection->getFormatId() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $collection->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $collection->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('collection/edit?id='.$collection->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('collection/index') ?>">List</a>
