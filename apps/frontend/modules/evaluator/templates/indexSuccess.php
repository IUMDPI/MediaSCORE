<h1>Evaluators List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>First name</th>
      <th>Last name</th>
      <th>Password</th>
      <th>Email</th>
      <th>Phone</th>
      <th>Role</th>
      <th>Type</th>
      <th>Contact info</th>
      <th>Unit</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($evaluators as $evaluator): ?>
    <tr>
      <td><a href="<?php echo url_for('evaluator/show?id='.$evaluator->getId()) ?>"><?php echo $evaluator->getId() ?></a></td>
      <td><?php echo $evaluator->getFirstName() ?></td>
      <td><?php echo $evaluator->getLastName() ?></td>
      <td><?php echo $evaluator->getPassword() ?></td>
      <td><?php echo $evaluator->getEmail() ?></td>
      <td><?php echo $evaluator->getPhone() ?></td>
      <td><?php echo $evaluator->getRole() ?></td>
      <td><?php echo $evaluator->getType() ?></td>
      <td><?php echo $evaluator->getContactInfo() ?></td>
      <td><?php echo $evaluator->getUnitId() ?></td>
      <td><?php echo $evaluator->getCreatedAt() ?></td>
      <td><?php echo $evaluator->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('evaluator/new') ?>">New</a>
