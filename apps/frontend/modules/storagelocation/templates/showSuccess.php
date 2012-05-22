<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $storage_location->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $storage_location->getName() ?></td>
    </tr>
    <tr>
      <th>Env rating:</th>
      <td><?php echo $storage_location->getEnvRating() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $storage_location->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $storage_location->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('storagelocation/edit?id='.$storage_location->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('storagelocation/index') ?>">List</a>
