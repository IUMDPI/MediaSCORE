<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $audiotape_format_type->getId() ?></td>
    </tr>
    <tr>
      <th>Quantity:</th>
      <td><?php echo $audiotape_format_type->getQuantity() ?></td>
    </tr>
    <tr>
      <th>Generation:</th>
      <td><?php echo $audiotape_format_type->getGeneration() ?></td>
    </tr>
    <tr>
      <th>Year recorded:</th>
      <td><?php echo $audiotape_format_type->getYearRecorded() ?></td>
    </tr>
    <tr>
      <th>Copies:</th>
      <td><?php echo $audiotape_format_type->getCopies() ?></td>
    </tr>
    <tr>
      <th>Stock brand:</th>
      <td><?php echo $audiotape_format_type->getStockBrand() ?></td>
    </tr>
    <tr>
      <th>Off brand:</th>
      <td><?php echo $audiotape_format_type->getOffBrand() ?></td>
    </tr>
    <tr>
      <th>Fungus:</th>
      <td><?php echo $audiotape_format_type->getFungus() ?></td>
    </tr>
    <tr>
      <th>Other contaminants:</th>
      <td><?php echo $audiotape_format_type->getOtherContaminants() ?></td>
    </tr>
    <tr>
      <th>Duration:</th>
      <td><?php echo $audiotape_format_type->getDuration() ?></td>
    </tr>
    <tr>
      <th>Duration type:</th>
      <td><?php echo $audiotape_format_type->getDurationType() ?></td>
    </tr>
    <tr>
      <th>Type:</th>
      <td><?php echo $audiotape_format_type->getType() ?></td>
    </tr>
    <tr>
      <th>Pack deformation:</th>
      <td><?php echo $audiotape_format_type->getPackDeformation() ?></td>
    </tr>
    <tr>
      <th>Noise reduction:</th>
      <td><?php echo $audiotape_format_type->getNoiseReduction() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $audiotape_format_type->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $audiotape_format_type->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('audiotapeformattype/edit?id='.$audiotape_format_type->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('audiotapeformattype/index') ?>">List</a>
