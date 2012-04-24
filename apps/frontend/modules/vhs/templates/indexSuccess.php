<h1>Vh ss List</h1>

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
    <?php foreach ($vh_ss as $vhs): ?>
    <tr>
      <td><a href="<?php echo url_for('vhs/show?id='.$vhs->getId()) ?>"><?php echo $vhs->getId() ?></a></td>
      <td><?php echo $vhs->getQuantity() ?></td>
      <td><?php echo $vhs->getGeneration() ?></td>
      <td><?php echo $vhs->getYearRecorded() ?></td>
      <td><?php echo $vhs->getCopies() ?></td>
      <td><?php echo $vhs->getStockBrand() ?></td>
      <td><?php echo $vhs->getOffBrand() ?></td>
      <td><?php echo $vhs->getFungus() ?></td>
      <td><?php echo $vhs->getOtherContaminants() ?></td>
      <td><?php echo $vhs->getDuration() ?></td>
      <td><?php echo $vhs->getDurationType() ?></td>
      <td><?php echo $vhs->getType() ?></td>
      <td><?php echo $vhs->getMaterial() ?></td>
      <td><?php echo $vhs->getOxidationCorrosion() ?></td>
      <td><?php echo $vhs->getPackDeformation() ?></td>
      <td><?php echo $vhs->getNoiseReduction() ?></td>
      <td><?php echo $vhs->getTapeType() ?></td>
      <td><?php echo $vhs->getThinTape() ?></td>
      <td><?php echo $vhs->getSlowSpeed() ?></td>
      <td><?php echo $vhs->getSoundField() ?></td>
      <td><?php echo $vhs->getSoftBinderSyndrome() ?></td>
      <td><?php echo $vhs->getGauge() ?></td>
      <td><?php echo $vhs->getColor() ?></td>
      <td><?php echo $vhs->getColorFade() ?></td>
      <td><?php echo $vhs->getSoundtrackFormat() ?></td>
      <td><?php echo $vhs->getSubstrate() ?></td>
      <td><?php echo $vhs->getStrongOdor() ?></td>
      <td><?php echo $vhs->getVinegarOdor() ?></td>
      <td><?php echo $vhs->getADStripLevel() ?></td>
      <td><?php echo $vhs->getShrinkage() ?></td>
      <td><?php echo $vhs->getLevelOfShrinkage() ?></td>
      <td><?php echo $vhs->getRust() ?></td>
      <td><?php echo $vhs->getDiscoloration() ?></td>
      <td><?php echo $vhs->getSurfaceBlisteringBubbling() ?></td>
      <td><?php echo $vhs->getThinTape() ?></td>
      <td><?php echo $vhs->get1993OrEarlier() ?></td>
      <td><?php echo $vhs->getDataGradeTape() ?></td>
      <td><?php echo $vhs->getLongPlay32K96K() ?></td>
      <td><?php echo $vhs->getCorrosionRustOxidation() ?></td>
      <td><?php echo $vhs->getComposition() ?></td>
      <td><?php echo $vhs->getNonStandardBrand() ?></td>
      <td><?php echo $vhs->getTrackConfiguration() ?></td>
      <td><?php echo $vhs->getTapeThickness() ?></td>
      <td><?php echo $vhs->getSpeed() ?></td>
      <td><?php echo $vhs->getSoftBinderSyndrome() ?></td>
      <td><?php echo $vhs->getMaterialsBreakdown() ?></td>
      <td><?php echo $vhs->getPhysicalDamage() ?></td>
      <td><?php echo $vhs->getDelamination() ?></td>
      <td><?php echo $vhs->getPlasticizerExudation() ?></td>
      <td><?php echo $vhs->getRecordingLayer() ?></td>
      <td><?php echo $vhs->getRecordingSpeed() ?></td>
      <td><?php echo $vhs->getCylinderType() ?></td>
      <td><?php echo $vhs->getReflectiveLayer() ?></td>
      <td><?php echo $vhs->getDataLayer() ?></td>
      <td><?php echo $vhs->getOpticalDiscType() ?></td>
      <td><?php echo $vhs->getFormat() ?></td>
      <td><?php echo $vhs->getRecordingStandard() ?></td>
      <td><?php echo $vhs->getPublicationYear() ?></td>
      <td><?php echo $vhs->getCapacityLayers() ?></td>
      <td><?php echo $vhs->getCodec() ?></td>
      <td><?php echo $vhs->getDataRate() ?></td>
      <td><?php echo $vhs->getSheddingSoftBinder() ?></td>
      <td><?php echo $vhs->getFormatVersion() ?></td>
      <td><?php echo $vhs->getOxide() ?></td>
      <td><?php echo $vhs->getBinderSystem() ?></td>
      <td><?php echo $vhs->getReelSize() ?></td>
      <td><?php echo $vhs->getWhiteResidue() ?></td>
      <td><?php echo $vhs->getSize() ?></td>
      <td><?php echo $vhs->getFormatTypedVideoRecordingFormat() ?></td>
      <td><?php echo $vhs->getBitrate() ?></td>
      <td><?php echo $vhs->getScanning() ?></td>
      <td><?php echo $vhs->getCreatedAt() ?></td>
      <td><?php echo $vhs->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('vhs/new') ?>">New</a>
