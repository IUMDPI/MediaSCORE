<h1>Audiotape format types List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Quantity</th>
      <th>Generation</th>
      <th>Year recorded</th>
      <th>Copies</th>
      <th>Stock brand</th>
      <th>Off brand</th>
      <th>Fungus</th>
      <th>Other contaminants</th>
      <th>Duration</th>
      <th>Duration type</th>
      <th>Type</th>
      <th>Pack deformation</th>
      <th>Noise reduction</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($audiotape_format_types as $audiotape_format_type): ?>
    <tr>
      <td><a href="<?php echo url_for('audiotapeformattype/show?id='.$audiotape_format_type->getId()) ?>"><?php echo $audiotape_format_type->getId() ?></a></td>
      <td><?php echo $audiotape_format_type->getQuantity() ?></td>
      <td><?php echo $audiotape_format_type->getGeneration() ?></td>
      <td><?php echo $audiotape_format_type->getYearRecorded() ?></td>
      <td><?php echo $audiotape_format_type->getCopies() ?></td>
      <td><?php echo $audiotape_format_type->getStockBrand() ?></td>
      <td><?php echo $audiotape_format_type->getOffBrand() ?></td>
      <td><?php echo $audiotape_format_type->getFungus() ?></td>
      <td><?php echo $audiotape_format_type->getOtherContaminants() ?></td>
      <td><?php echo $audiotape_format_type->getDuration() ?></td>
      <td><?php echo $audiotape_format_type->getDurationType() ?></td>
      <td><?php echo $audiotape_format_type->getType() ?></td>
      <td><?php echo $audiotape_format_type->getPackDeformation() ?></td>
      <td><?php echo $audiotape_format_type->getNoiseReduction() ?></td>
      <td><?php echo $audiotape_format_type->getCreatedAt() ?></td>
      <td><?php echo $audiotape_format_type->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('audiotapeformattype/new') ?>">New</a>
