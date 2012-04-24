<h1>Umatics List</h1>

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
      <th>Material</th>
      <th>Oxidation corrosion</th>
      <th>Pack deformation</th>
      <th>Noise reduction</th>
      <th>Tape type</th>
      <th>Thin tape</th>
      <th>Slow speed</th>
      <th>Sound field</th>
      <th>Soft binder syndrome</th>
      <th>Gauge</th>
      <th>Color</th>
      <th>Color fade</th>
      <th>Soundtrack format</th>
      <th>Substrate</th>
      <th>Strong odor</th>
      <th>Vinegar odor</th>
      <th>Ad strip level</th>
      <th>Shrinkage</th>
      <th>Level of shrinkage</th>
      <th>Rust</th>
      <th>Discoloration</th>
      <th>Surface blistering bubbling</th>
      <th>Thin tape</th>
      <th>1993 or earlier</th>
      <th>Data grade tape</th>
      <th>Long play32 k96 k</th>
      <th>Corrosion rust oxidation</th>
      <th>Composition</th>
      <th>Non standard brand</th>
      <th>Track configuration</th>
      <th>Tape thickness</th>
      <th>Speed</th>
      <th>Soft binder syndrome</th>
      <th>Materials breakdown</th>
      <th>Physical damage</th>
      <th>Delamination</th>
      <th>Plasticizer exudation</th>
      <th>Recording layer</th>
      <th>Recording speed</th>
      <th>Cylinder type</th>
      <th>Reflective layer</th>
      <th>Data layer</th>
      <th>Optical disc type</th>
      <th>Format</th>
      <th>Recording standard</th>
      <th>Publication year</th>
      <th>Capacity layers</th>
      <th>Codec</th>
      <th>Data rate</th>
      <th>Shedding soft binder</th>
      <th>Format version</th>
      <th>Oxide</th>
      <th>Binder system</th>
      <th>Reel size</th>
      <th>White residue</th>
      <th>Size</th>
      <th>Format typed video recording format</th>
      <th>Bitrate</th>
      <th>Scanning</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($umatics as $umatic): ?>
    <tr>
      <td><a href="<?php echo url_for('umatic/show?id='.$umatic->getId()) ?>"><?php echo $umatic->getId() ?></a></td>
      <td><?php echo $umatic->getQuantity() ?></td>
      <td><?php echo $umatic->getGeneration() ?></td>
      <td><?php echo $umatic->getYearRecorded() ?></td>
      <td><?php echo $umatic->getCopies() ?></td>
      <td><?php echo $umatic->getStockBrand() ?></td>
      <td><?php echo $umatic->getOffBrand() ?></td>
      <td><?php echo $umatic->getFungus() ?></td>
      <td><?php echo $umatic->getOtherContaminants() ?></td>
      <td><?php echo $umatic->getDuration() ?></td>
      <td><?php echo $umatic->getDurationType() ?></td>
      <td><?php echo $umatic->getType() ?></td>
      <td><?php echo $umatic->getMaterial() ?></td>
      <td><?php echo $umatic->getOxidationCorrosion() ?></td>
      <td><?php echo $umatic->getPackDeformation() ?></td>
      <td><?php echo $umatic->getNoiseReduction() ?></td>
      <td><?php echo $umatic->getTapeType() ?></td>
      <td><?php echo $umatic->getThinTape() ?></td>
      <td><?php echo $umatic->getSlowSpeed() ?></td>
      <td><?php echo $umatic->getSoundField() ?></td>
      <td><?php echo $umatic->getSoftBinderSyndrome() ?></td>
      <td><?php echo $umatic->getGauge() ?></td>
      <td><?php echo $umatic->getColor() ?></td>
      <td><?php echo $umatic->getColorFade() ?></td>
      <td><?php echo $umatic->getSoundtrackFormat() ?></td>
      <td><?php echo $umatic->getSubstrate() ?></td>
      <td><?php echo $umatic->getStrongOdor() ?></td>
      <td><?php echo $umatic->getVinegarOdor() ?></td>
      <td><?php echo $umatic->getADStripLevel() ?></td>
      <td><?php echo $umatic->getShrinkage() ?></td>
      <td><?php echo $umatic->getLevelOfShrinkage() ?></td>
      <td><?php echo $umatic->getRust() ?></td>
      <td><?php echo $umatic->getDiscoloration() ?></td>
      <td><?php echo $umatic->getSurfaceBlisteringBubbling() ?></td>
      <td><?php echo $umatic->getThinTape() ?></td>
      <td><?php echo $umatic->get1993OrEarlier() ?></td>
      <td><?php echo $umatic->getDataGradeTape() ?></td>
      <td><?php echo $umatic->getLongPlay32K96K() ?></td>
      <td><?php echo $umatic->getCorrosionRustOxidation() ?></td>
      <td><?php echo $umatic->getComposition() ?></td>
      <td><?php echo $umatic->getNonStandardBrand() ?></td>
      <td><?php echo $umatic->getTrackConfiguration() ?></td>
      <td><?php echo $umatic->getTapeThickness() ?></td>
      <td><?php echo $umatic->getSpeed() ?></td>
      <td><?php echo $umatic->getSoftBinderSyndrome() ?></td>
      <td><?php echo $umatic->getMaterialsBreakdown() ?></td>
      <td><?php echo $umatic->getPhysicalDamage() ?></td>
      <td><?php echo $umatic->getDelamination() ?></td>
      <td><?php echo $umatic->getPlasticizerExudation() ?></td>
      <td><?php echo $umatic->getRecordingLayer() ?></td>
      <td><?php echo $umatic->getRecordingSpeed() ?></td>
      <td><?php echo $umatic->getCylinderType() ?></td>
      <td><?php echo $umatic->getReflectiveLayer() ?></td>
      <td><?php echo $umatic->getDataLayer() ?></td>
      <td><?php echo $umatic->getOpticalDiscType() ?></td>
      <td><?php echo $umatic->getFormat() ?></td>
      <td><?php echo $umatic->getRecordingStandard() ?></td>
      <td><?php echo $umatic->getPublicationYear() ?></td>
      <td><?php echo $umatic->getCapacityLayers() ?></td>
      <td><?php echo $umatic->getCodec() ?></td>
      <td><?php echo $umatic->getDataRate() ?></td>
      <td><?php echo $umatic->getSheddingSoftBinder() ?></td>
      <td><?php echo $umatic->getFormatVersion() ?></td>
      <td><?php echo $umatic->getOxide() ?></td>
      <td><?php echo $umatic->getBinderSystem() ?></td>
      <td><?php echo $umatic->getReelSize() ?></td>
      <td><?php echo $umatic->getWhiteResidue() ?></td>
      <td><?php echo $umatic->getSize() ?></td>
      <td><?php echo $umatic->getFormatTypedVideoRecordingFormat() ?></td>
      <td><?php echo $umatic->getBitrate() ?></td>
      <td><?php echo $umatic->getScanning() ?></td>
      <td><?php echo $umatic->getCreatedAt() ?></td>
      <td><?php echo $umatic->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('umatic/new') ?>">New</a>
