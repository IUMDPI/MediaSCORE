<h1>Analog audio cassettes List</h1>

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
      <th>Pack deformation</th>
      <th>Noise reduction</th>
      <th>Tape type</th>
      <th>Thin tape</th>
      <th>Slow speed</th>
      <th>Sound field</th>
      <th>Soft binder syndrome</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($analog_audio_cassettes as $analog_audio_cassette): ?>
    <tr>
      <td><a href="<?php echo url_for('analogaudiocassette/show?id='.$analog_audio_cassette->getId()) ?>"><?php echo $analog_audio_cassette->getId() ?></a></td>
      <td><?php echo $analog_audio_cassette->getQuantity() ?></td>
      <td><?php echo $analog_audio_cassette->getGeneration() ?></td>
      <td><?php echo $analog_audio_cassette->getYearRecorded() ?></td>
      <td><?php echo $analog_audio_cassette->getCopies() ?></td>
      <td><?php echo $analog_audio_cassette->getStockBrand() ?></td>
      <td><?php echo $analog_audio_cassette->getOffBrand() ?></td>
      <td><?php echo $analog_audio_cassette->getFungus() ?></td>
      <td><?php echo $analog_audio_cassette->getOtherContaminants() ?></td>
      <td><?php echo $analog_audio_cassette->getDuration() ?></td>
      <td><?php echo $analog_audio_cassette->getDurationType() ?></td>
      <td><?php echo $analog_audio_cassette->getPackDeformation() ?></td>
      <td><?php echo $analog_audio_cassette->getNoiseReduction() ?></td>
      <td><?php echo $analog_audio_cassette->getTapeType() ?></td>
      <td><?php echo $analog_audio_cassette->getThinTape() ?></td>
      <td><?php echo $analog_audio_cassette->getSlowSpeed() ?></td>
      <td><?php echo $analog_audio_cassette->getSoundField() ?></td>
      <td><?php echo $analog_audio_cassette->getSoftBinderSyndrome() ?></td>
      <td><?php echo $analog_audio_cassette->getCreatedAt() ?></td>
      <td><?php echo $analog_audio_cassette->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('analogaudiocassette/new') ?>">New</a>
