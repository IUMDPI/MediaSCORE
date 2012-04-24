<h1>Metal discs List</h1>

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
      <th>Material</th>
      <th>Oxidation corrosion</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($metal_discs as $metal_disc): ?>
    <tr>
      <td><a href="<?php echo url_for('metaldisc/show?id='.$metal_disc->getId()) ?>"><?php echo $metal_disc->getId() ?></a></td>
      <td><?php echo $metal_disc->getQuantity() ?></td>
      <td><?php echo $metal_disc->getGeneration() ?></td>
      <td><?php echo $metal_disc->getYearRecorded() ?></td>
      <td><?php echo $metal_disc->getCopies() ?></td>
      <td><?php echo $metal_disc->getStockBrand() ?></td>
      <td><?php echo $metal_disc->getOffBrand() ?></td>
      <td><?php echo $metal_disc->getFungus() ?></td>
      <td><?php echo $metal_disc->getOtherContaminants() ?></td>
      <td><?php echo $metal_disc->getDuration() ?></td>
      <td><?php echo $metal_disc->getDurationType() ?></td>
      <td><?php echo $metal_disc->getMaterial() ?></td>
      <td><?php echo $metal_disc->getOxidationCorrosion() ?></td>
      <td><?php echo $metal_disc->getCreatedAt() ?></td>
      <td><?php echo $metal_disc->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('metaldisc/new') ?>">New</a>
