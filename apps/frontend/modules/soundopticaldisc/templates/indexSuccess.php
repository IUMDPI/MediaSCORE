<h1>Sound optical discs List</h1>

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
    <?php foreach ($sound_optical_discs as $sound_optical_disc): ?>
    <tr>
      <td><a href="<?php echo url_for('soundopticaldisc/show?id='.$sound_optical_disc->getId()) ?>"><?php echo $sound_optical_disc->getId() ?></a></td>
      <td><?php echo $sound_optical_disc->getQuantity() ?></td>
      <td><?php echo $sound_optical_disc->getGeneration() ?></td>
      <td><?php echo $sound_optical_disc->getYearRecorded() ?></td>
      <td><?php echo $sound_optical_disc->getCopies() ?></td>
      <td><?php echo $sound_optical_disc->getStockBrand() ?></td>
      <td><?php echo $sound_optical_disc->getOffBrand() ?></td>
      <td><?php echo $sound_optical_disc->getFungus() ?></td>
      <td><?php echo $sound_optical_disc->getOtherContaminants() ?></td>
      <td><?php echo $sound_optical_disc->getDuration() ?></td>
      <td><?php echo $sound_optical_disc->getDurationType() ?></td>
      <td><?php echo $sound_optical_disc->getType() ?></td>
      <td><?php echo $sound_optical_disc->getMaterial() ?></td>
      <td><?php echo $sound_optical_disc->getOxidationCorrosion() ?></td>
      <td><?php echo $sound_optical_disc->getPackDeformation() ?></td>
      <td><?php echo $sound_optical_disc->getNoiseReduction() ?></td>
      <td><?php echo $sound_optical_disc->getTapeType() ?></td>
      <td><?php echo $sound_optical_disc->getThinTape() ?></td>
      <td><?php echo $sound_optical_disc->getSlowSpeed() ?></td>
      <td><?php echo $sound_optical_disc->getSoundField() ?></td>
      <td><?php echo $sound_optical_disc->getSoftBinderSyndrome() ?></td>
      <td><?php echo $sound_optical_disc->getGauge() ?></td>
      <td><?php echo $sound_optical_disc->getColor() ?></td>
      <td><?php echo $sound_optical_disc->getColorFade() ?></td>
      <td><?php echo $sound_optical_disc->getSoundtrackFormat() ?></td>
      <td><?php echo $sound_optical_disc->getSubstrate() ?></td>
      <td><?php echo $sound_optical_disc->getStrongOdor() ?></td>
      <td><?php echo $sound_optical_disc->getVinegarOdor() ?></td>
      <td><?php echo $sound_optical_disc->getADStripLevel() ?></td>
      <td><?php echo $sound_optical_disc->getShrinkage() ?></td>
      <td><?php echo $sound_optical_disc->getLevelOfShrinkage() ?></td>
      <td><?php echo $sound_optical_disc->getRust() ?></td>
      <td><?php echo $sound_optical_disc->getDiscoloration() ?></td>
      <td><?php echo $sound_optical_disc->getSurfaceBlisteringBubbling() ?></td>
      <td><?php echo $sound_optical_disc->getThinTape() ?></td>
      <td><?php echo $sound_optical_disc->get1993OrEarlier() ?></td>
      <td><?php echo $sound_optical_disc->getDataGradeTape() ?></td>
      <td><?php echo $sound_optical_disc->getLongPlay32K96K() ?></td>
      <td><?php echo $sound_optical_disc->getCorrosionRustOxidation() ?></td>
      <td><?php echo $sound_optical_disc->getComposition() ?></td>
      <td><?php echo $sound_optical_disc->getNonStandardBrand() ?></td>
      <td><?php echo $sound_optical_disc->getTrackConfiguration() ?></td>
      <td><?php echo $sound_optical_disc->getTapeThickness() ?></td>
      <td><?php echo $sound_optical_disc->getSpeed() ?></td>
      <td><?php echo $sound_optical_disc->getSoftBinderSyndrome() ?></td>
      <td><?php echo $sound_optical_disc->getMaterialsBreakdown() ?></td>
      <td><?php echo $sound_optical_disc->getPhysicalDamage() ?></td>
      <td><?php echo $sound_optical_disc->getDelamination() ?></td>
      <td><?php echo $sound_optical_disc->getPlasticizerExudation() ?></td>
      <td><?php echo $sound_optical_disc->getRecordingLayer() ?></td>
      <td><?php echo $sound_optical_disc->getRecordingSpeed() ?></td>
      <td><?php echo $sound_optical_disc->getCylinderType() ?></td>
      <td><?php echo $sound_optical_disc->getReflectiveLayer() ?></td>
      <td><?php echo $sound_optical_disc->getDataLayer() ?></td>
      <td><?php echo $sound_optical_disc->getOpticalDiscType() ?></td>
      <td><?php echo $sound_optical_disc->getFormat() ?></td>
      <td><?php echo $sound_optical_disc->getRecordingStandard() ?></td>
      <td><?php echo $sound_optical_disc->getPublicationYear() ?></td>
      <td><?php echo $sound_optical_disc->getCapacityLayers() ?></td>
      <td><?php echo $sound_optical_disc->getCodec() ?></td>
      <td><?php echo $sound_optical_disc->getDataRate() ?></td>
      <td><?php echo $sound_optical_disc->getSheddingSoftBinder() ?></td>
      <td><?php echo $sound_optical_disc->getFormatVersion() ?></td>
      <td><?php echo $sound_optical_disc->getOxide() ?></td>
      <td><?php echo $sound_optical_disc->getBinderSystem() ?></td>
      <td><?php echo $sound_optical_disc->getReelSize() ?></td>
      <td><?php echo $sound_optical_disc->getWhiteResidue() ?></td>
      <td><?php echo $sound_optical_disc->getSize() ?></td>
      <td><?php echo $sound_optical_disc->getFormatTypedVideoRecordingFormat() ?></td>
      <td><?php echo $sound_optical_disc->getBitrate() ?></td>
      <td><?php echo $sound_optical_disc->getScanning() ?></td>
      <td><?php echo $sound_optical_disc->getCreatedAt() ?></td>
      <td><?php echo $sound_optical_disc->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('soundopticaldisc/new') ?>">New</a>
