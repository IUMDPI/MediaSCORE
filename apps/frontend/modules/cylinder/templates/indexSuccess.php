<h1>Cylinders List</h1>

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
    <?php foreach ($cylinders as $cylinder): ?>
    <tr>
      <td><a href="<?php echo url_for('cylinder/show?id='.$cylinder->getId()) ?>"><?php echo $cylinder->getId() ?></a></td>
      <td><?php echo $cylinder->getQuantity() ?></td>
      <td><?php echo $cylinder->getGeneration() ?></td>
      <td><?php echo $cylinder->getYearRecorded() ?></td>
      <td><?php echo $cylinder->getCopies() ?></td>
      <td><?php echo $cylinder->getStockBrand() ?></td>
      <td><?php echo $cylinder->getOffBrand() ?></td>
      <td><?php echo $cylinder->getFungus() ?></td>
      <td><?php echo $cylinder->getOtherContaminants() ?></td>
      <td><?php echo $cylinder->getDuration() ?></td>
      <td><?php echo $cylinder->getDurationType() ?></td>
      <td><?php echo $cylinder->getType() ?></td>
      <td><?php echo $cylinder->getMaterial() ?></td>
      <td><?php echo $cylinder->getOxidationCorrosion() ?></td>
      <td><?php echo $cylinder->getPackDeformation() ?></td>
      <td><?php echo $cylinder->getNoiseReduction() ?></td>
      <td><?php echo $cylinder->getTapeType() ?></td>
      <td><?php echo $cylinder->getThinTape() ?></td>
      <td><?php echo $cylinder->getSlowSpeed() ?></td>
      <td><?php echo $cylinder->getSoundField() ?></td>
      <td><?php echo $cylinder->getSoftBinderSyndrome() ?></td>
      <td><?php echo $cylinder->getGauge() ?></td>
      <td><?php echo $cylinder->getColor() ?></td>
      <td><?php echo $cylinder->getColorFade() ?></td>
      <td><?php echo $cylinder->getSoundtrackFormat() ?></td>
      <td><?php echo $cylinder->getSubstrate() ?></td>
      <td><?php echo $cylinder->getStrongOdor() ?></td>
      <td><?php echo $cylinder->getVinegarOdor() ?></td>
      <td><?php echo $cylinder->getADStripLevel() ?></td>
      <td><?php echo $cylinder->getShrinkage() ?></td>
      <td><?php echo $cylinder->getLevelOfShrinkage() ?></td>
      <td><?php echo $cylinder->getRust() ?></td>
      <td><?php echo $cylinder->getDiscoloration() ?></td>
      <td><?php echo $cylinder->getSurfaceBlisteringBubbling() ?></td>
      <td><?php echo $cylinder->getThinTape() ?></td>
      <td><?php echo $cylinder->get1993OrEarlier() ?></td>
      <td><?php echo $cylinder->getDataGradeTape() ?></td>
      <td><?php echo $cylinder->getLongPlay32K96K() ?></td>
      <td><?php echo $cylinder->getCorrosionRustOxidation() ?></td>
      <td><?php echo $cylinder->getComposition() ?></td>
      <td><?php echo $cylinder->getNonStandardBrand() ?></td>
      <td><?php echo $cylinder->getTrackConfiguration() ?></td>
      <td><?php echo $cylinder->getTapeThickness() ?></td>
      <td><?php echo $cylinder->getSpeed() ?></td>
      <td><?php echo $cylinder->getSoftBinderSyndrome() ?></td>
      <td><?php echo $cylinder->getMaterialsBreakdown() ?></td>
      <td><?php echo $cylinder->getPhysicalDamage() ?></td>
      <td><?php echo $cylinder->getDelamination() ?></td>
      <td><?php echo $cylinder->getPlasticizerExudation() ?></td>
      <td><?php echo $cylinder->getRecordingLayer() ?></td>
      <td><?php echo $cylinder->getRecordingSpeed() ?></td>
      <td><?php echo $cylinder->getCylinderType() ?></td>
      <td><?php echo $cylinder->getReflectiveLayer() ?></td>
      <td><?php echo $cylinder->getDataLayer() ?></td>
      <td><?php echo $cylinder->getOpticalDiscType() ?></td>
      <td><?php echo $cylinder->getFormat() ?></td>
      <td><?php echo $cylinder->getRecordingStandard() ?></td>
      <td><?php echo $cylinder->getPublicationYear() ?></td>
      <td><?php echo $cylinder->getCapacityLayers() ?></td>
      <td><?php echo $cylinder->getCodec() ?></td>
      <td><?php echo $cylinder->getDataRate() ?></td>
      <td><?php echo $cylinder->getSheddingSoftBinder() ?></td>
      <td><?php echo $cylinder->getFormatVersion() ?></td>
      <td><?php echo $cylinder->getOxide() ?></td>
      <td><?php echo $cylinder->getBinderSystem() ?></td>
      <td><?php echo $cylinder->getReelSize() ?></td>
      <td><?php echo $cylinder->getWhiteResidue() ?></td>
      <td><?php echo $cylinder->getSize() ?></td>
      <td><?php echo $cylinder->getFormatTypedVideoRecordingFormat() ?></td>
      <td><?php echo $cylinder->getBitrate() ?></td>
      <td><?php echo $cylinder->getScanning() ?></td>
      <td><?php echo $cylinder->getCreatedAt() ?></td>
      <td><?php echo $cylinder->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('cylinder/new') ?>">New</a>
