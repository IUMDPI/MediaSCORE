<h1>Betacams List</h1>

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
    <?php foreach ($betacams as $betacam): ?>
    <tr>
      <td><a href="<?php echo url_for('betacam/show?id='.$betacam->getId()) ?>"><?php echo $betacam->getId() ?></a></td>
      <td><?php echo $betacam->getQuantity() ?></td>
      <td><?php echo $betacam->getGeneration() ?></td>
      <td><?php echo $betacam->getYearRecorded() ?></td>
      <td><?php echo $betacam->getCopies() ?></td>
      <td><?php echo $betacam->getStockBrand() ?></td>
      <td><?php echo $betacam->getOffBrand() ?></td>
      <td><?php echo $betacam->getFungus() ?></td>
      <td><?php echo $betacam->getOtherContaminants() ?></td>
      <td><?php echo $betacam->getDuration() ?></td>
      <td><?php echo $betacam->getDurationType() ?></td>
      <td><?php echo $betacam->getType() ?></td>
      <td><?php echo $betacam->getMaterial() ?></td>
      <td><?php echo $betacam->getOxidationCorrosion() ?></td>
      <td><?php echo $betacam->getPackDeformation() ?></td>
      <td><?php echo $betacam->getNoiseReduction() ?></td>
      <td><?php echo $betacam->getTapeType() ?></td>
      <td><?php echo $betacam->getThinTape() ?></td>
      <td><?php echo $betacam->getSlowSpeed() ?></td>
      <td><?php echo $betacam->getSoundField() ?></td>
      <td><?php echo $betacam->getSoftBinderSyndrome() ?></td>
      <td><?php echo $betacam->getGauge() ?></td>
      <td><?php echo $betacam->getColor() ?></td>
      <td><?php echo $betacam->getColorFade() ?></td>
      <td><?php echo $betacam->getSoundtrackFormat() ?></td>
      <td><?php echo $betacam->getSubstrate() ?></td>
      <td><?php echo $betacam->getStrongOdor() ?></td>
      <td><?php echo $betacam->getVinegarOdor() ?></td>
      <td><?php echo $betacam->getADStripLevel() ?></td>
      <td><?php echo $betacam->getShrinkage() ?></td>
      <td><?php echo $betacam->getLevelOfShrinkage() ?></td>
      <td><?php echo $betacam->getRust() ?></td>
      <td><?php echo $betacam->getDiscoloration() ?></td>
      <td><?php echo $betacam->getSurfaceBlisteringBubbling() ?></td>
      <td><?php echo $betacam->getThinTape() ?></td>
      <td><?php echo $betacam->get1993OrEarlier() ?></td>
      <td><?php echo $betacam->getDataGradeTape() ?></td>
      <td><?php echo $betacam->getLongPlay32K96K() ?></td>
      <td><?php echo $betacam->getCorrosionRustOxidation() ?></td>
      <td><?php echo $betacam->getComposition() ?></td>
      <td><?php echo $betacam->getNonStandardBrand() ?></td>
      <td><?php echo $betacam->getTrackConfiguration() ?></td>
      <td><?php echo $betacam->getTapeThickness() ?></td>
      <td><?php echo $betacam->getSpeed() ?></td>
      <td><?php echo $betacam->getSoftBinderSyndrome() ?></td>
      <td><?php echo $betacam->getMaterialsBreakdown() ?></td>
      <td><?php echo $betacam->getPhysicalDamage() ?></td>
      <td><?php echo $betacam->getDelamination() ?></td>
      <td><?php echo $betacam->getPlasticizerExudation() ?></td>
      <td><?php echo $betacam->getRecordingLayer() ?></td>
      <td><?php echo $betacam->getRecordingSpeed() ?></td>
      <td><?php echo $betacam->getCylinderType() ?></td>
      <td><?php echo $betacam->getReflectiveLayer() ?></td>
      <td><?php echo $betacam->getDataLayer() ?></td>
      <td><?php echo $betacam->getOpticalDiscType() ?></td>
      <td><?php echo $betacam->getFormat() ?></td>
      <td><?php echo $betacam->getRecordingStandard() ?></td>
      <td><?php echo $betacam->getPublicationYear() ?></td>
      <td><?php echo $betacam->getCapacityLayers() ?></td>
      <td><?php echo $betacam->getCodec() ?></td>
      <td><?php echo $betacam->getDataRate() ?></td>
      <td><?php echo $betacam->getSheddingSoftBinder() ?></td>
      <td><?php echo $betacam->getFormatVersion() ?></td>
      <td><?php echo $betacam->getOxide() ?></td>
      <td><?php echo $betacam->getBinderSystem() ?></td>
      <td><?php echo $betacam->getReelSize() ?></td>
      <td><?php echo $betacam->getWhiteResidue() ?></td>
      <td><?php echo $betacam->getSize() ?></td>
      <td><?php echo $betacam->getFormatTypedVideoRecordingFormat() ?></td>
      <td><?php echo $betacam->getBitrate() ?></td>
      <td><?php echo $betacam->getScanning() ?></td>
      <td><?php echo $betacam->getCreatedAt() ?></td>
      <td><?php echo $betacam->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('betacam/new') ?>">New</a>
