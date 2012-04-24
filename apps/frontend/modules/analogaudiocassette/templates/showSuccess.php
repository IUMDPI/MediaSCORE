<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $analog_audio_cassette->getId() ?></td>
    </tr>
    <tr>
      <th>Quantity:</th>
      <td><?php echo $analog_audio_cassette->getQuantity() ?></td>
    </tr>
    <tr>
      <th>Generation:</th>
      <td><?php echo $analog_audio_cassette->getGeneration() ?></td>
    </tr>
    <tr>
      <th>Year recorded:</th>
      <td><?php echo $analog_audio_cassette->getYearRecorded() ?></td>
    </tr>
    <tr>
      <th>Copies:</th>
      <td><?php echo $analog_audio_cassette->getCopies() ?></td>
    </tr>
    <tr>
      <th>Stock brand:</th>
      <td><?php echo $analog_audio_cassette->getStockBrand() ?></td>
    </tr>
    <tr>
      <th>Off brand:</th>
      <td><?php echo $analog_audio_cassette->getOffBrand() ?></td>
    </tr>
    <tr>
      <th>Fungus:</th>
      <td><?php echo $analog_audio_cassette->getFungus() ?></td>
    </tr>
    <tr>
      <th>Other contaminants:</th>
      <td><?php echo $analog_audio_cassette->getOtherContaminants() ?></td>
    </tr>
    <tr>
      <th>Duration:</th>
      <td><?php echo $analog_audio_cassette->getDuration() ?></td>
    </tr>
    <tr>
      <th>Duration type:</th>
      <td><?php echo $analog_audio_cassette->getDurationType() ?></td>
    </tr>
    <tr>
      <th>Pack deformation:</th>
      <td><?php echo $analog_audio_cassette->getPackDeformation() ?></td>
    </tr>
    <tr>
      <th>Noise reduction:</th>
      <td><?php echo $analog_audio_cassette->getNoiseReduction() ?></td>
    </tr>
    <tr>
      <th>Tape type:</th>
      <td><?php echo $analog_audio_cassette->getTapeType() ?></td>
    </tr>
    <tr>
      <th>Thin tape:</th>
      <td><?php echo $analog_audio_cassette->getThinTape() ?></td>
    </tr>
    <tr>
      <th>Slow speed:</th>
      <td><?php echo $analog_audio_cassette->getSlowSpeed() ?></td>
    </tr>
    <tr>
      <th>Sound field:</th>
      <td><?php echo $analog_audio_cassette->getSoundField() ?></td>
    </tr>
    <tr>
      <th>Soft binder syndrome:</th>
      <td><?php echo $analog_audio_cassette->getSoftBinderSyndrome() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $analog_audio_cassette->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $analog_audio_cassette->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('analogaudiocassette/edit?id='.$analog_audio_cassette->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('analogaudiocassette/index') ?>">List</a>
