<h1>Films List</h1>

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
    <?php foreach ($films as $film): ?>
    <tr>
      <td><a href="<?php echo url_for('film/show?id='.$film->getId()) ?>"><?php echo $film->getId() ?></a></td>
      <td><?php echo $film->getQuantity() ?></td>
      <td><?php echo $film->getGeneration() ?></td>
      <td><?php echo $film->getYearRecorded() ?></td>
      <td><?php echo $film->getCopies() ?></td>
      <td><?php echo $film->getStockBrand() ?></td>
      <td><?php echo $film->getOffBrand() ?></td>
      <td><?php echo $film->getFungus() ?></td>
      <td><?php echo $film->getOtherContaminants() ?></td>
      <td><?php echo $film->getDuration() ?></td>
      <td><?php echo $film->getDurationType() ?></td>
      <td><?php echo $film->getType() ?></td>
      <td><?php echo $film->getMaterial() ?></td>
      <td><?php echo $film->getOxidationCorrosion() ?></td>
      <td><?php echo $film->getPackDeformation() ?></td>
      <td><?php echo $film->getNoiseReduction() ?></td>
      <td><?php echo $film->getTapeType() ?></td>
      <td><?php echo $film->getThinTape() ?></td>
      <td><?php echo $film->getSlowSpeed() ?></td>
      <td><?php echo $film->getSoundField() ?></td>
      <td><?php echo $film->getSoftBinderSyndrome() ?></td>
      <td><?php echo $film->getGauge() ?></td>
      <td><?php echo $film->getColor() ?></td>
      <td><?php echo $film->getColorFade() ?></td>
      <td><?php echo $film->getSoundtrackFormat() ?></td>
      <td><?php echo $film->getSubstrate() ?></td>
      <td><?php echo $film->getStrongOdor() ?></td>
      <td><?php echo $film->getVinegarOdor() ?></td>
      <td><?php echo $film->getADStripLevel() ?></td>
      <td><?php echo $film->getShrinkage() ?></td>
      <td><?php echo $film->getLevelOfShrinkage() ?></td>
      <td><?php echo $film->getRust() ?></td>
      <td><?php echo $film->getDiscoloration() ?></td>
      <td><?php echo $film->getSurfaceBlisteringBubbling() ?></td>
      <td><?php echo $film->getThinTape() ?></td>
      <td><?php echo $film->get1993OrEarlier() ?></td>
      <td><?php echo $film->getDataGradeTape() ?></td>
      <td><?php echo $film->getLongPlay32K96K() ?></td>
      <td><?php echo $film->getCorrosionRustOxidation() ?></td>
      <td><?php echo $film->getComposition() ?></td>
      <td><?php echo $film->getNonStandardBrand() ?></td>
      <td><?php echo $film->getTrackConfiguration() ?></td>
      <td><?php echo $film->getTapeThickness() ?></td>
      <td><?php echo $film->getSpeed() ?></td>
      <td><?php echo $film->getSoftBinderSyndrome() ?></td>
      <td><?php echo $film->getMaterialsBreakdown() ?></td>
      <td><?php echo $film->getPhysicalDamage() ?></td>
      <td><?php echo $film->getDelamination() ?></td>
      <td><?php echo $film->getPlasticizerExudation() ?></td>
      <td><?php echo $film->getRecordingLayer() ?></td>
      <td><?php echo $film->getRecordingSpeed() ?></td>
      <td><?php echo $film->getCylinderType() ?></td>
      <td><?php echo $film->getReflectiveLayer() ?></td>
      <td><?php echo $film->getDataLayer() ?></td>
      <td><?php echo $film->getOpticalDiscType() ?></td>
      <td><?php echo $film->getFormat() ?></td>
      <td><?php echo $film->getRecordingStandard() ?></td>
      <td><?php echo $film->getPublicationYear() ?></td>
      <td><?php echo $film->getCapacityLayers() ?></td>
      <td><?php echo $film->getCodec() ?></td>
      <td><?php echo $film->getDataRate() ?></td>
      <td><?php echo $film->getSheddingSoftBinder() ?></td>
      <td><?php echo $film->getFormatVersion() ?></td>
      <td><?php echo $film->getOxide() ?></td>
      <td><?php echo $film->getBinderSystem() ?></td>
      <td><?php echo $film->getReelSize() ?></td>
      <td><?php echo $film->getWhiteResidue() ?></td>
      <td><?php echo $film->getSize() ?></td>
      <td><?php echo $film->getFormatTypedVideoRecordingFormat() ?></td>
      <td><?php echo $film->getBitrate() ?></td>
      <td><?php echo $film->getScanning() ?></td>
      <td><?php echo $film->getCreatedAt() ?></td>
      <td><?php echo $film->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('film/new') ?>">New</a>
