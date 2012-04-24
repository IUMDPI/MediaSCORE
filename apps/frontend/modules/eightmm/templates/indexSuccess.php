<h1>Eight m ms List</h1>

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
    <?php foreach ($eight_m_ms as $eight_mm): ?>
    <tr>
      <td><a href="<?php echo url_for('eightmm/show?id='.$eight_mm->getId()) ?>"><?php echo $eight_mm->getId() ?></a></td>
      <td><?php echo $eight_mm->getQuantity() ?></td>
      <td><?php echo $eight_mm->getGeneration() ?></td>
      <td><?php echo $eight_mm->getYearRecorded() ?></td>
      <td><?php echo $eight_mm->getCopies() ?></td>
      <td><?php echo $eight_mm->getStockBrand() ?></td>
      <td><?php echo $eight_mm->getOffBrand() ?></td>
      <td><?php echo $eight_mm->getFungus() ?></td>
      <td><?php echo $eight_mm->getOtherContaminants() ?></td>
      <td><?php echo $eight_mm->getDuration() ?></td>
      <td><?php echo $eight_mm->getDurationType() ?></td>
      <td><?php echo $eight_mm->getType() ?></td>
      <td><?php echo $eight_mm->getMaterial() ?></td>
      <td><?php echo $eight_mm->getOxidationCorrosion() ?></td>
      <td><?php echo $eight_mm->getPackDeformation() ?></td>
      <td><?php echo $eight_mm->getNoiseReduction() ?></td>
      <td><?php echo $eight_mm->getTapeType() ?></td>
      <td><?php echo $eight_mm->getThinTape() ?></td>
      <td><?php echo $eight_mm->getSlowSpeed() ?></td>
      <td><?php echo $eight_mm->getSoundField() ?></td>
      <td><?php echo $eight_mm->getSoftBinderSyndrome() ?></td>
      <td><?php echo $eight_mm->getGauge() ?></td>
      <td><?php echo $eight_mm->getColor() ?></td>
      <td><?php echo $eight_mm->getColorFade() ?></td>
      <td><?php echo $eight_mm->getSoundtrackFormat() ?></td>
      <td><?php echo $eight_mm->getSubstrate() ?></td>
      <td><?php echo $eight_mm->getStrongOdor() ?></td>
      <td><?php echo $eight_mm->getVinegarOdor() ?></td>
      <td><?php echo $eight_mm->getADStripLevel() ?></td>
      <td><?php echo $eight_mm->getShrinkage() ?></td>
      <td><?php echo $eight_mm->getLevelOfShrinkage() ?></td>
      <td><?php echo $eight_mm->getRust() ?></td>
      <td><?php echo $eight_mm->getDiscoloration() ?></td>
      <td><?php echo $eight_mm->getSurfaceBlisteringBubbling() ?></td>
      <td><?php echo $eight_mm->getThinTape() ?></td>
      <td><?php echo $eight_mm->get1993OrEarlier() ?></td>
      <td><?php echo $eight_mm->getDataGradeTape() ?></td>
      <td><?php echo $eight_mm->getLongPlay32K96K() ?></td>
      <td><?php echo $eight_mm->getCorrosionRustOxidation() ?></td>
      <td><?php echo $eight_mm->getComposition() ?></td>
      <td><?php echo $eight_mm->getNonStandardBrand() ?></td>
      <td><?php echo $eight_mm->getTrackConfiguration() ?></td>
      <td><?php echo $eight_mm->getTapeThickness() ?></td>
      <td><?php echo $eight_mm->getSpeed() ?></td>
      <td><?php echo $eight_mm->getSoftBinderSyndrome() ?></td>
      <td><?php echo $eight_mm->getMaterialsBreakdown() ?></td>
      <td><?php echo $eight_mm->getPhysicalDamage() ?></td>
      <td><?php echo $eight_mm->getDelamination() ?></td>
      <td><?php echo $eight_mm->getPlasticizerExudation() ?></td>
      <td><?php echo $eight_mm->getRecordingLayer() ?></td>
      <td><?php echo $eight_mm->getRecordingSpeed() ?></td>
      <td><?php echo $eight_mm->getCylinderType() ?></td>
      <td><?php echo $eight_mm->getReflectiveLayer() ?></td>
      <td><?php echo $eight_mm->getDataLayer() ?></td>
      <td><?php echo $eight_mm->getOpticalDiscType() ?></td>
      <td><?php echo $eight_mm->getFormat() ?></td>
      <td><?php echo $eight_mm->getRecordingStandard() ?></td>
      <td><?php echo $eight_mm->getPublicationYear() ?></td>
      <td><?php echo $eight_mm->getCapacityLayers() ?></td>
      <td><?php echo $eight_mm->getCodec() ?></td>
      <td><?php echo $eight_mm->getDataRate() ?></td>
      <td><?php echo $eight_mm->getSheddingSoftBinder() ?></td>
      <td><?php echo $eight_mm->getFormatVersion() ?></td>
      <td><?php echo $eight_mm->getOxide() ?></td>
      <td><?php echo $eight_mm->getBinderSystem() ?></td>
      <td><?php echo $eight_mm->getReelSize() ?></td>
      <td><?php echo $eight_mm->getWhiteResidue() ?></td>
      <td><?php echo $eight_mm->getSize() ?></td>
      <td><?php echo $eight_mm->getFormatTypedVideoRecordingFormat() ?></td>
      <td><?php echo $eight_mm->getBitrate() ?></td>
      <td><?php echo $eight_mm->getScanning() ?></td>
      <td><?php echo $eight_mm->getCreatedAt() ?></td>
      <td><?php echo $eight_mm->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('eightmm/new') ?>">New</a>
