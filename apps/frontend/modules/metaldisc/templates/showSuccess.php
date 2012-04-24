<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $metal_disc->getId() ?></td>
    </tr>
    <tr>
      <th>Quantity:</th>
      <td><?php echo $metal_disc->getQuantity() ?></td>
    </tr>
    <tr>
      <th>Generation:</th>
      <td><?php echo $metal_disc->getGeneration() ?></td>
    </tr>
    <tr>
      <th>Year recorded:</th>
      <td><?php echo $metal_disc->getYearRecorded() ?></td>
    </tr>
    <tr>
      <th>Copies:</th>
      <td><?php echo $metal_disc->getCopies() ?></td>
    </tr>
    <tr>
      <th>Stock brand:</th>
      <td><?php echo $metal_disc->getStockBrand() ?></td>
    </tr>
    <tr>
      <th>Off brand:</th>
      <td><?php echo $metal_disc->getOffBrand() ?></td>
    </tr>
    <tr>
      <th>Fungus:</th>
      <td><?php echo $metal_disc->getFungus() ?></td>
    </tr>
    <tr>
      <th>Other contaminants:</th>
      <td><?php echo $metal_disc->getOtherContaminants() ?></td>
    </tr>
    <tr>
      <th>Duration:</th>
      <td><?php echo $metal_disc->getDuration() ?></td>
    </tr>
    <tr>
      <th>Duration type:</th>
      <td><?php echo $metal_disc->getDurationType() ?></td>
    </tr>
    <tr>
      <th>Material:</th>
      <td><?php echo $metal_disc->getMaterial() ?></td>
    </tr>
    <tr>
      <th>Oxidation corrosion:</th>
      <td><?php echo $metal_disc->getOxidationCorrosion() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $metal_disc->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $metal_disc->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('metaldisc/edit?id='.$metal_disc->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('metaldisc/index') ?>">List</a>
