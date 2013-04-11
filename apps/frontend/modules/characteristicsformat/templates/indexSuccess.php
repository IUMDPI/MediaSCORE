<h1>Characteristics formats List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Format</th>
      <th>Format c name</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($characteristics_formats as $characteristics_format): ?>
    <tr>
      <td><a href="<?php echo url_for('characteristicsformat/edit?id='.$characteristics_format->getId()) ?>"><?php echo $characteristics_format->getId() ?></a></td>
      <td><?php echo $characteristics_format->getFormatId() ?></td>
      <td><?php echo $characteristics_format->getFormatCName() ?></td>
      <td><?php echo $characteristics_format->getCreatedAt() ?></td>
      <td><?php echo $characteristics_format->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('characteristicsformat/new') ?>">New</a>
