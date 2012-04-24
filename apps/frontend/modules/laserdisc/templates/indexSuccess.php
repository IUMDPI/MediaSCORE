<h1>Laserdiscs List</h1>

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
    <?php foreach ($laserdiscs as $laserdisc): ?>
    <tr>
      <td><a href="<?php echo url_for('laserdisc/show?id='.$laserdisc->getId()) ?>"><?php echo $laserdisc->getId() ?></a></td>
      <td><?php echo $laserdisc->getQuantity() ?></td>
      <td><?php echo $laserdisc->getGeneration() ?></td>
      <td><?php echo $laserdisc->getYearRecorded() ?></td>
      <td><?php echo $laserdisc->getCopies() ?></td>
      <td><?php echo $laserdisc->getStockBrand() ?></td>
      <td><?php echo $laserdisc->getOffBrand() ?></td>
      <td><?php echo $laserdisc->getFungus() ?></td>
      <td><?php echo $laserdisc->getOtherContaminants() ?></td>
      <td><?php echo $laserdisc->getDuration() ?></td>
      <td><?php echo $laserdisc->getDurationType() ?></td>
      <td><?php echo $laserdisc->getType() ?></td>
      <td><?php echo $laserdisc->getMaterial() ?></td>
      <td><?php echo $laserdisc->getOxidationCorrosion() ?></td>
      <td><?php echo $laserdisc->getPackDeformation() ?></td>
      <td><?php echo $laserdisc->getNoiseReduction() ?></td>
      <td><?php echo $laserdisc->getTapeType() ?></td>
      <td><?php echo $laserdisc->getThinTape() ?></td>
      <td><?php echo $laserdisc->getSlowSpeed() ?></td>
      <td><?php echo $laserdisc->getSoundField() ?></td>
      <td><?php echo $laserdisc->getSoftBinderSyndrome() ?></td>
      <td><?php echo $laserdisc->getGauge() ?></td>
      <td><?php echo $laserdisc->getColor() ?></td>
      <td><?php echo $laserdisc->getColorFade() ?></td>
      <td><?php echo $laserdisc->getSoundtrackFormat() ?></td>
      <td><?php echo $laserdisc->getSubstrate() ?></td>
      <td><?php echo $laserdisc->getStrongOdor() ?></td>
      <td><?php echo $laserdisc->getVinegarOdor() ?></td>
      <td><?php echo $laserdisc->getADStripLevel() ?></td>
      <td><?php echo $laserdisc->getShrinkage() ?></td>
      <td><?php echo $laserdisc->getLevelOfShrinkage() ?></td>
      <td><?php echo $laserdisc->getRust() ?></td>
      <td><?php echo $laserdisc->getDiscoloration() ?></td>
      <td><?php echo $laserdisc->getSurfaceBlisteringBubbling() ?></td>
      <td><?php echo $laserdisc->getThinTape() ?></td>
      <td><?php echo $laserdisc->get1993OrEarlier() ?></td>
      <td><?php echo $laserdisc->getDataGradeTape() ?></td>
      <td><?php echo $laserdisc->getLongPlay32K96K() ?></td>
      <td><?php echo $laserdisc->getCorrosionRustOxidation() ?></td>
      <td><?php echo $laserdisc->getComposition() ?></td>
      <td><?php echo $laserdisc->getNonStandardBrand() ?></td>
      <td><?php echo $laserdisc->getTrackConfiguration() ?></td>
      <td><?php echo $laserdisc->getTapeThickness() ?></td>
      <td><?php echo $laserdisc->getSpeed() ?></td>
      <td><?php echo $laserdisc->getSoftBinderSyndrome() ?></td>
      <td><?php echo $laserdisc->getMaterialsBreakdown() ?></td>
      <td><?php echo $laserdisc->getPhysicalDamage() ?></td>
      <td><?php echo $laserdisc->getDelamination() ?></td>
      <td><?php echo $laserdisc->getPlasticizerExudation() ?></td>
      <td><?php echo $laserdisc->getRecordingLayer() ?></td>
      <td><?php echo $laserdisc->getRecordingSpeed() ?></td>
      <td><?php echo $laserdisc->getCylinderType() ?></td>
      <td><?php echo $laserdisc->getReflectiveLayer() ?></td>
      <td><?php echo $laserdisc->getDataLayer() ?></td>
      <td><?php echo $laserdisc->getOpticalDiscType() ?></td>
      <td><?php echo $laserdisc->getFormat() ?></td>
      <td><?php echo $laserdisc->getRecordingStandard() ?></td>
      <td><?php echo $laserdisc->getPublicationYear() ?></td>
      <td><?php echo $laserdisc->getCapacityLayers() ?></td>
      <td><?php echo $laserdisc->getCodec() ?></td>
      <td><?php echo $laserdisc->getDataRate() ?></td>
      <td><?php echo $laserdisc->getSheddingSoftBinder() ?></td>
      <td><?php echo $laserdisc->getFormatVersion() ?></td>
      <td><?php echo $laserdisc->getOxide() ?></td>
      <td><?php echo $laserdisc->getBinderSystem() ?></td>
      <td><?php echo $laserdisc->getReelSize() ?></td>
      <td><?php echo $laserdisc->getWhiteResidue() ?></td>
      <td><?php echo $laserdisc->getSize() ?></td>
      <td><?php echo $laserdisc->getFormatTypedVideoRecordingFormat() ?></td>
      <td><?php echo $laserdisc->getBitrate() ?></td>
      <td><?php echo $laserdisc->getScanning() ?></td>
      <td><?php echo $laserdisc->getCreatedAt() ?></td>
      <td><?php echo $laserdisc->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('laserdisc/new') ?>">New</a>
