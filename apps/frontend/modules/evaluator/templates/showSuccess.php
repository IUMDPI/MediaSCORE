<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $evaluator->getId() ?></td>
    </tr>
    <tr>
      <th>First name:</th>
      <td><?php echo $evaluator->getFirstName() ?></td>
    </tr>
    <tr>
      <th>Last name:</th>
      <td><?php echo $evaluator->getLastName() ?></td>
    </tr>
    <tr>
      <th>Password:</th>
      <td><?php echo $evaluator->getPassword() ?></td>
    </tr>
    <tr>
      <th>Email:</th>
      <td><?php echo $evaluator->getEmail() ?></td>
    </tr>
    <tr>
      <th>Phone:</th>
      <td><?php echo $evaluator->getPhone() ?></td>
    </tr>
    <tr>
      <th>Role:</th>
      <td><?php echo $evaluator->getRole() ?></td>
    </tr>
    <tr>
      <th>Type:</th>
      <td><?php echo $evaluator->getType() ?></td>
    </tr>
    <tr>
      <th>Contact info:</th>
      <td><?php echo $evaluator->getContactInfo() ?></td>
    </tr>
    <tr>
      <th>Unit:</th>
      <td><?php echo $evaluator->getUnitId() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $evaluator->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $evaluator->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('evaluator/edit?id='.$evaluator->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('evaluator/index') ?>">List</a>
