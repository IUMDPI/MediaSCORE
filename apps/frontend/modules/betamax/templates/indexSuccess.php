<h1>Betamaxs List</h1>

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
    <?php foreach ($betamaxs as $betamax): ?>
    <tr>
      <td><a href="<?php echo url_for('betamax/show?id='.$betamax->getId()) ?>"><?php echo $betamax->getId() ?></a></td>
      <td><?php echo $betamax->getQuantity() ?></td>
      <td><?php echo $betamax->getGeneration() ?></td>
      <td><?php echo $betamax->getYearRecorded() ?></td>
      <td><?php echo $betamax->getCopies() ?></td>
      <td><?php echo $betamax->getStockBrand() ?></td>
      <td><?php echo $betamax->getOffBrand() ?></td>
      <td><?php echo $betamax->getFungus() ?></td>
      <td><?php echo $betamax->getOtherContaminants() ?></td>
      <td><?php echo $betamax->getDuration() ?></td>
      <td><?php echo $betamax->getDurationType() ?></td>
      <td><?php echo $betamax->getType() ?></td>
      <td><?php echo $betamax->getMaterial() ?></td>
      <td><?php echo $betamax->getOxidationCorrosion() ?></td>
      <td><?php echo $betamax->getPackDeformation() ?></td>
      <td><?php echo $betamax->getNoiseReduction() ?></td>
      <td><?php echo $betamax->getTapeType() ?></td>
      <td><?php echo $betamax->getThinTape() ?></td>
      <td><?php echo $betamax->getSlowSpeed() ?></td>
      <td><?php echo $betamax->getSoundField() ?></td>
      <td><?php echo $betamax->getSoftBinderSyndrome() ?></td>
      <td><?php echo $betamax->getGauge() ?></td>
      <td><?php echo $betamax->getColor() ?></td>
      <td><?php echo $betamax->getColorFade() ?></td>
      <td><?php echo $betamax->getSoundtrackFormat() ?></td>
      <td><?php echo $betamax->getSubstrate() ?></td>
      <td><?php echo $betamax->getStrongOdor() ?></td>
      <td><?php echo $betamax->getVinegarOdor() ?></td>
      <td><?php echo $betamax->getADStripLevel() ?></td>
      <td><?php echo $betamax->getShrinkage() ?></td>
      <td><?php echo $betamax->getLevelOfShrinkage() ?></td>
      <td><?php echo $betamax->getRust() ?></td>
      <td><?php echo $betamax->getDiscoloration() ?></td>
      <td><?php echo $betamax->getSurfaceBlisteringBubbling() ?></td>
      <td><?php echo $betamax->getThinTape() ?></td>
      <td><?php echo $betamax->get1993OrEarlier() ?></td>
      <td><?php echo $betamax->getDataGradeTape() ?></td>
      <td><?php echo $betamax->getLongPlay32K96K() ?></td>
      <td><?php echo $betamax->getCorrosionRustOxidation() ?></td>
      <td><?php echo $betamax->getComposition() ?></td>
      <td><?php echo $betamax->getNonStandardBrand() ?></td>
      <td><?php echo $betamax->getTrackConfiguration() ?></td>
      <td><?php echo $betamax->getTapeThickness() ?></td>
      <td><?php echo $betamax->getSpeed() ?></td>
      <td><?php echo $betamax->getSoftBinderSyndrome() ?></td>
      <td><?php echo $betamax->getMaterialsBreakdown() ?></td>
      <td><?php echo $betamax->getPhysicalDamage() ?></td>
      <td><?php echo $betamax->getDelamination() ?></td>
      <td><?php echo $betamax->getPlasticizerExudation() ?></td>
      <td><?php echo $betamax->getRecordingLayer() ?></td>
      <td><?php echo $betamax->getRecordingSpeed() ?></td>
      <td><?php echo $betamax->getCylinderType() ?></td>
      <td><?php echo $betamax->getReflectiveLayer() ?></td>
      <td><?php echo $betamax->getDataLayer() ?></td>
      <td><?php echo $betamax->getOpticalDiscType() ?></td>
      <td><?php echo $betamax->getFormat() ?></td>
      <td><?php echo $betamax->getRecordingStandard() ?></td>
      <td><?php echo $betamax->getPublicationYear() ?></td>
      <td><?php echo $betamax->getCapacityLayers() ?></td>
      <td><?php echo $betamax->getCodec() ?></td>
      <td><?php echo $betamax->getDataRate() ?></td>
      <td><?php echo $betamax->getSheddingSoftBinder() ?></td>
      <td><?php echo $betamax->getFormatVersion() ?></td>
      <td><?php echo $betamax->getOxide() ?></td>
      <td><?php echo $betamax->getBinderSystem() ?></td>
      <td><?php echo $betamax->getReelSize() ?></td>
      <td><?php echo $betamax->getWhiteResidue() ?></td>
      <td><?php echo $betamax->getSize() ?></td>
      <td><?php echo $betamax->getFormatTypedVideoRecordingFormat() ?></td>
      <td><?php echo $betamax->getBitrate() ?></td>
      <td><?php echo $betamax->getScanning() ?></td>
      <td><?php echo $betamax->getCreatedAt() ?></td>
      <td><?php echo $betamax->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('betamax/new') ?>">New</a>
