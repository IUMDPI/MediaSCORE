<h1>Characteristics constraintss List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Constraint name</th>
      <th>Constraint value</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($characteristics_constraintss as $characteristics_constraints): ?>
    <tr>
      <td><a href="<?php echo url_for('characteristicsconstraints/edit?id='.$characteristics_constraints->getId()) ?>"><?php echo $characteristics_constraints->getId() ?></a></td>
      <td><?php echo $characteristics_constraints->getConstraintName() ?></td>
      <td><?php echo $characteristics_constraints->getConstraintValue() ?></td>
      <td><?php echo $characteristics_constraints->getCreatedAt() ?></td>
      <td><?php echo $characteristics_constraints->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('characteristicsconstraints/new') ?>">New</a>
