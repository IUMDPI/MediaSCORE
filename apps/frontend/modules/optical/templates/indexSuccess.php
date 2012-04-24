<h1>Optical videos List</h1>

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
    <?php foreach ($optical_videos as $optical_video): ?>
    <tr>
      <td><a href="<?php echo url_for('optical/show?id='.$optical_video->getId()) ?>"><?php echo $optical_video->getId() ?></a></td>
      <td><?php echo $optical_video->getQuantity() ?></td>
      <td><?php echo $optical_video->getGeneration() ?></td>
      <td><?php echo $optical_video->getYearRecorded() ?></td>
      <td><?php echo $optical_video->getCopies() ?></td>
      <td><?php echo $optical_video->getStockBrand() ?></td>
      <td><?php echo $optical_video->getOffBrand() ?></td>
      <td><?php echo $optical_video->getFungus() ?></td>
      <td><?php echo $optical_video->getOtherContaminants() ?></td>
      <td><?php echo $optical_video->getDuration() ?></td>
      <td><?php echo $optical_video->getDurationType() ?></td>
      <td><?php echo $optical_video->getType() ?></td>
      <td><?php echo $optical_video->getMaterial() ?></td>
      <td><?php echo $optical_video->getOxidationCorrosion() ?></td>
      <td><?php echo $optical_video->getPackDeformation() ?></td>
      <td><?php echo $optical_video->getNoiseReduction() ?></td>
      <td><?php echo $optical_video->getTapeType() ?></td>
      <td><?php echo $optical_video->getThinTape() ?></td>
      <td><?php echo $optical_video->getSlowSpeed() ?></td>
      <td><?php echo $optical_video->getSoundField() ?></td>
      <td><?php echo $optical_video->getSoftBinderSyndrome() ?></td>
      <td><?php echo $optical_video->getGauge() ?></td>
      <td><?php echo $optical_video->getColor() ?></td>
      <td><?php echo $optical_video->getColorFade() ?></td>
      <td><?php echo $optical_video->getSoundtrackFormat() ?></td>
      <td><?php echo $optical_video->getSubstrate() ?></td>
      <td><?php echo $optical_video->getStrongOdor() ?></td>
      <td><?php echo $optical_video->getVinegarOdor() ?></td>
      <td><?php echo $optical_video->getADStripLevel() ?></td>
      <td><?php echo $optical_video->getShrinkage() ?></td>
      <td><?php echo $optical_video->getLevelOfShrinkage() ?></td>
      <td><?php echo $optical_video->getRust() ?></td>
      <td><?php echo $optical_video->getDiscoloration() ?></td>
      <td><?php echo $optical_video->getSurfaceBlisteringBubbling() ?></td>
      <td><?php echo $optical_video->getThinTape() ?></td>
      <td><?php echo $optical_video->get1993OrEarlier() ?></td>
      <td><?php echo $optical_video->getDataGradeTape() ?></td>
      <td><?php echo $optical_video->getLongPlay32K96K() ?></td>
      <td><?php echo $optical_video->getCorrosionRustOxidation() ?></td>
      <td><?php echo $optical_video->getComposition() ?></td>
      <td><?php echo $optical_video->getNonStandardBrand() ?></td>
      <td><?php echo $optical_video->getTrackConfiguration() ?></td>
      <td><?php echo $optical_video->getTapeThickness() ?></td>
      <td><?php echo $optical_video->getSpeed() ?></td>
      <td><?php echo $optical_video->getSoftBinderSyndrome() ?></td>
      <td><?php echo $optical_video->getMaterialsBreakdown() ?></td>
      <td><?php echo $optical_video->getPhysicalDamage() ?></td>
      <td><?php echo $optical_video->getDelamination() ?></td>
      <td><?php echo $optical_video->getPlasticizerExudation() ?></td>
      <td><?php echo $optical_video->getRecordingLayer() ?></td>
      <td><?php echo $optical_video->getRecordingSpeed() ?></td>
      <td><?php echo $optical_video->getCylinderType() ?></td>
      <td><?php echo $optical_video->getReflectiveLayer() ?></td>
      <td><?php echo $optical_video->getDataLayer() ?></td>
      <td><?php echo $optical_video->getOpticalDiscType() ?></td>
      <td><?php echo $optical_video->getFormat() ?></td>
      <td><?php echo $optical_video->getRecordingStandard() ?></td>
      <td><?php echo $optical_video->getPublicationYear() ?></td>
      <td><?php echo $optical_video->getCapacityLayers() ?></td>
      <td><?php echo $optical_video->getCodec() ?></td>
      <td><?php echo $optical_video->getDataRate() ?></td>
      <td><?php echo $optical_video->getSheddingSoftBinder() ?></td>
      <td><?php echo $optical_video->getFormatVersion() ?></td>
      <td><?php echo $optical_video->getOxide() ?></td>
      <td><?php echo $optical_video->getBinderSystem() ?></td>
      <td><?php echo $optical_video->getReelSize() ?></td>
      <td><?php echo $optical_video->getWhiteResidue() ?></td>
      <td><?php echo $optical_video->getSize() ?></td>
      <td><?php echo $optical_video->getFormatTypedVideoRecordingFormat() ?></td>
      <td><?php echo $optical_video->getBitrate() ?></td>
      <td><?php echo $optical_video->getScanning() ?></td>
      <td><?php echo $optical_video->getCreatedAt() ?></td>
      <td><?php echo $optical_video->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('optical/new') ?>">New</a>
