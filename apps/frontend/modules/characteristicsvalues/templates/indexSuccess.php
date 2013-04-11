<h1>Characteristics valuess List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>C name</th>
      <th>C score</th>
      <th>Format</th>
      <th>Constraint</th>
      <th>Parent characteristic</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($characteristics_valuess as $characteristics_values): ?>
    <tr>
      <td><a href="<?php echo url_for('characteristicsvalues/edit?id='.$characteristics_values->getId()) ?>"><?php echo $characteristics_values->getId() ?></a></td>
      <td><?php echo $characteristics_values->getCName() ?></td>
      <td><?php echo $characteristics_values->getCScore() ?></td>
      <td><?php echo $characteristics_values->getFormatId() ?></td>
      <td><?php echo $characteristics_values->getConstraintId() ?></td>
      <td><?php echo $characteristics_values->getParentCharacteristicId() ?></td>
      <td><?php echo $characteristics_values->getCreatedAt() ?></td>
      <td><?php echo $characteristics_values->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('characteristicsvalues/new') ?>">New</a>
