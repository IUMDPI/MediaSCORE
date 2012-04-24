<h1>Format types List</h1>

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
    <?php foreach ($format_types as $format_type): ?>
    <tr>
      <td><a href="<?php echo url_for('formattype/show?id='.$format_type->getId()) ?>"><?php echo $format_type->getId() ?></a></td>
      <td><?php echo $format_type->getQuantity() ?></td>
      <td><?php echo $format_type->getGeneration() ?></td>
      <td><?php echo $format_type->getYearRecorded() ?></td>
      <td><?php echo $format_type->getCopies() ?></td>
      <td><?php echo $format_type->getStockBrand() ?></td>
      <td><?php echo $format_type->getOffBrand() ?></td>
      <td><?php echo $format_type->getFungus() ?></td>
      <td><?php echo $format_type->getOtherContaminants() ?></td>
      <td><?php echo $format_type->getDuration() ?></td>
      <td><?php echo $format_type->getDurationType() ?></td>
      <td><?php echo $format_type->getType() ?></td>
      <td><?php echo $format_type->getMaterial() ?></td>
      <td><?php echo $format_type->getOxidationCorrosion() ?></td>
      <td><?php echo $format_type->getPackDeformation() ?></td>
      <td><?php echo $format_type->getNoiseReduction() ?></td>
      <td><?php echo $format_type->getTapeType() ?></td>
      <td><?php echo $format_type->getThinTape() ?></td>
      <td><?php echo $format_type->getSlowSpeed() ?></td>
      <td><?php echo $format_type->getSoundField() ?></td>
      <td><?php echo $format_type->getSoftBinderSyndrome() ?></td>
      <td><?php echo $format_type->getGauge() ?></td>
      <td><?php echo $format_type->getColor() ?></td>
      <td><?php echo $format_type->getColorFade() ?></td>
      <td><?php echo $format_type->getSoundtrackFormat() ?></td>
      <td><?php echo $format_type->getSubstrate() ?></td>
      <td><?php echo $format_type->getStrongOdor() ?></td>
      <td><?php echo $format_type->getVinegarOdor() ?></td>
      <td><?php echo $format_type->getADStripLevel() ?></td>
      <td><?php echo $format_type->getShrinkage() ?></td>
      <td><?php echo $format_type->getLevelOfShrinkage() ?></td>
      <td><?php echo $format_type->getRust() ?></td>
      <td><?php echo $format_type->getDiscoloration() ?></td>
      <td><?php echo $format_type->getSurfaceBlisteringBubbling() ?></td>
      <td><?php echo $format_type->getThinTape() ?></td>
      <td><?php echo $format_type->get1993OrEarlier() ?></td>
      <td><?php echo $format_type->getDataGradeTape() ?></td>
      <td><?php echo $format_type->getLongPlay32K96K() ?></td>
      <td><?php echo $format_type->getCorrosionRustOxidation() ?></td>
      <td><?php echo $format_type->getComposition() ?></td>
      <td><?php echo $format_type->getNonStandardBrand() ?></td>
      <td><?php echo $format_type->getTrackConfiguration() ?></td>
      <td><?php echo $format_type->getTapeThickness() ?></td>
      <td><?php echo $format_type->getSpeed() ?></td>
      <td><?php echo $format_type->getSoftBinderSyndrome() ?></td>
      <td><?php echo $format_type->getMaterialsBreakdown() ?></td>
      <td><?php echo $format_type->getPhysicalDamage() ?></td>
      <td><?php echo $format_type->getDelamination() ?></td>
      <td><?php echo $format_type->getPlasticizerExudation() ?></td>
      <td><?php echo $format_type->getRecordingLayer() ?></td>
      <td><?php echo $format_type->getRecordingSpeed() ?></td>
      <td><?php echo $format_type->getCylinderType() ?></td>
      <td><?php echo $format_type->getReflectiveLayer() ?></td>
      <td><?php echo $format_type->getDataLayer() ?></td>
      <td><?php echo $format_type->getOpticalDiscType() ?></td>
      <td><?php echo $format_type->getFormat() ?></td>
      <td><?php echo $format_type->getRecordingStandard() ?></td>
      <td><?php echo $format_type->getPublicationYear() ?></td>
      <td><?php echo $format_type->getCapacityLayers() ?></td>
      <td><?php echo $format_type->getCodec() ?></td>
      <td><?php echo $format_type->getDataRate() ?></td>
      <td><?php echo $format_type->getSheddingSoftBinder() ?></td>
      <td><?php echo $format_type->getFormatVersion() ?></td>
      <td><?php echo $format_type->getOxide() ?></td>
      <td><?php echo $format_type->getBinderSystem() ?></td>
      <td><?php echo $format_type->getReelSize() ?></td>
      <td><?php echo $format_type->getWhiteResidue() ?></td>
      <td><?php echo $format_type->getSize() ?></td>
      <td><?php echo $format_type->getFormatTypedVideoRecordingFormat() ?></td>
      <td><?php echo $format_type->getBitrate() ?></td>
      <td><?php echo $format_type->getScanning() ?></td>
      <td><?php echo $format_type->getCreatedAt() ?></td>
      <td><?php echo $format_type->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('formattype/new') ?>">New</a>
