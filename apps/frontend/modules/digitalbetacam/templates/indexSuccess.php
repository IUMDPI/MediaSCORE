<h1>Digital betacams List</h1>

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
    <?php foreach ($digital_betacams as $digital_betacam): ?>
    <tr>
      <td><a href="<?php echo url_for('digitalbetacam/show?id='.$digital_betacam->getId()) ?>"><?php echo $digital_betacam->getId() ?></a></td>
      <td><?php echo $digital_betacam->getQuantity() ?></td>
      <td><?php echo $digital_betacam->getGeneration() ?></td>
      <td><?php echo $digital_betacam->getYearRecorded() ?></td>
      <td><?php echo $digital_betacam->getCopies() ?></td>
      <td><?php echo $digital_betacam->getStockBrand() ?></td>
      <td><?php echo $digital_betacam->getOffBrand() ?></td>
      <td><?php echo $digital_betacam->getFungus() ?></td>
      <td><?php echo $digital_betacam->getOtherContaminants() ?></td>
      <td><?php echo $digital_betacam->getDuration() ?></td>
      <td><?php echo $digital_betacam->getDurationType() ?></td>
      <td><?php echo $digital_betacam->getType() ?></td>
      <td><?php echo $digital_betacam->getMaterial() ?></td>
      <td><?php echo $digital_betacam->getOxidationCorrosion() ?></td>
      <td><?php echo $digital_betacam->getPackDeformation() ?></td>
      <td><?php echo $digital_betacam->getNoiseReduction() ?></td>
      <td><?php echo $digital_betacam->getTapeType() ?></td>
      <td><?php echo $digital_betacam->getThinTape() ?></td>
      <td><?php echo $digital_betacam->getSlowSpeed() ?></td>
      <td><?php echo $digital_betacam->getSoundField() ?></td>
      <td><?php echo $digital_betacam->getSoftBinderSyndrome() ?></td>
      <td><?php echo $digital_betacam->getGauge() ?></td>
      <td><?php echo $digital_betacam->getColor() ?></td>
      <td><?php echo $digital_betacam->getColorFade() ?></td>
      <td><?php echo $digital_betacam->getSoundtrackFormat() ?></td>
      <td><?php echo $digital_betacam->getSubstrate() ?></td>
      <td><?php echo $digital_betacam->getStrongOdor() ?></td>
      <td><?php echo $digital_betacam->getVinegarOdor() ?></td>
      <td><?php echo $digital_betacam->getADStripLevel() ?></td>
      <td><?php echo $digital_betacam->getShrinkage() ?></td>
      <td><?php echo $digital_betacam->getLevelOfShrinkage() ?></td>
      <td><?php echo $digital_betacam->getRust() ?></td>
      <td><?php echo $digital_betacam->getDiscoloration() ?></td>
      <td><?php echo $digital_betacam->getSurfaceBlisteringBubbling() ?></td>
      <td><?php echo $digital_betacam->getThinTape() ?></td>
      <td><?php echo $digital_betacam->get1993OrEarlier() ?></td>
      <td><?php echo $digital_betacam->getDataGradeTape() ?></td>
      <td><?php echo $digital_betacam->getLongPlay32K96K() ?></td>
      <td><?php echo $digital_betacam->getCorrosionRustOxidation() ?></td>
      <td><?php echo $digital_betacam->getComposition() ?></td>
      <td><?php echo $digital_betacam->getNonStandardBrand() ?></td>
      <td><?php echo $digital_betacam->getTrackConfiguration() ?></td>
      <td><?php echo $digital_betacam->getTapeThickness() ?></td>
      <td><?php echo $digital_betacam->getSpeed() ?></td>
      <td><?php echo $digital_betacam->getSoftBinderSyndrome() ?></td>
      <td><?php echo $digital_betacam->getMaterialsBreakdown() ?></td>
      <td><?php echo $digital_betacam->getPhysicalDamage() ?></td>
      <td><?php echo $digital_betacam->getDelamination() ?></td>
      <td><?php echo $digital_betacam->getPlasticizerExudation() ?></td>
      <td><?php echo $digital_betacam->getRecordingLayer() ?></td>
      <td><?php echo $digital_betacam->getRecordingSpeed() ?></td>
      <td><?php echo $digital_betacam->getCylinderType() ?></td>
      <td><?php echo $digital_betacam->getReflectiveLayer() ?></td>
      <td><?php echo $digital_betacam->getDataLayer() ?></td>
      <td><?php echo $digital_betacam->getOpticalDiscType() ?></td>
      <td><?php echo $digital_betacam->getFormat() ?></td>
      <td><?php echo $digital_betacam->getRecordingStandard() ?></td>
      <td><?php echo $digital_betacam->getPublicationYear() ?></td>
      <td><?php echo $digital_betacam->getCapacityLayers() ?></td>
      <td><?php echo $digital_betacam->getCodec() ?></td>
      <td><?php echo $digital_betacam->getDataRate() ?></td>
      <td><?php echo $digital_betacam->getSheddingSoftBinder() ?></td>
      <td><?php echo $digital_betacam->getFormatVersion() ?></td>
      <td><?php echo $digital_betacam->getOxide() ?></td>
      <td><?php echo $digital_betacam->getBinderSystem() ?></td>
      <td><?php echo $digital_betacam->getReelSize() ?></td>
      <td><?php echo $digital_betacam->getWhiteResidue() ?></td>
      <td><?php echo $digital_betacam->getSize() ?></td>
      <td><?php echo $digital_betacam->getFormatTypedVideoRecordingFormat() ?></td>
      <td><?php echo $digital_betacam->getBitrate() ?></td>
      <td><?php echo $digital_betacam->getScanning() ?></td>
      <td><?php echo $digital_betacam->getCreatedAt() ?></td>
      <td><?php echo $digital_betacam->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('digitalbetacam/new') ?>">New</a>
