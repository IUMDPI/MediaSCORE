<h1>Da ts List</h1>

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
    <?php foreach ($da_ts as $dat): ?>
    <tr>
      <td><a href="<?php echo url_for('dat/show?id='.$dat->getId()) ?>"><?php echo $dat->getId() ?></a></td>
      <td><?php echo $dat->getQuantity() ?></td>
      <td><?php echo $dat->getGeneration() ?></td>
      <td><?php echo $dat->getYearRecorded() ?></td>
      <td><?php echo $dat->getCopies() ?></td>
      <td><?php echo $dat->getStockBrand() ?></td>
      <td><?php echo $dat->getOffBrand() ?></td>
      <td><?php echo $dat->getFungus() ?></td>
      <td><?php echo $dat->getOtherContaminants() ?></td>
      <td><?php echo $dat->getDuration() ?></td>
      <td><?php echo $dat->getDurationType() ?></td>
      <td><?php echo $dat->getType() ?></td>
      <td><?php echo $dat->getMaterial() ?></td>
      <td><?php echo $dat->getOxidationCorrosion() ?></td>
      <td><?php echo $dat->getPackDeformation() ?></td>
      <td><?php echo $dat->getNoiseReduction() ?></td>
      <td><?php echo $dat->getTapeType() ?></td>
      <td><?php echo $dat->getThinTape() ?></td>
      <td><?php echo $dat->getSlowSpeed() ?></td>
      <td><?php echo $dat->getSoundField() ?></td>
      <td><?php echo $dat->getSoftBinderSyndrome() ?></td>
      <td><?php echo $dat->getGauge() ?></td>
      <td><?php echo $dat->getColor() ?></td>
      <td><?php echo $dat->getColorFade() ?></td>
      <td><?php echo $dat->getSoundtrackFormat() ?></td>
      <td><?php echo $dat->getSubstrate() ?></td>
      <td><?php echo $dat->getStrongOdor() ?></td>
      <td><?php echo $dat->getVinegarOdor() ?></td>
      <td><?php echo $dat->getADStripLevel() ?></td>
      <td><?php echo $dat->getShrinkage() ?></td>
      <td><?php echo $dat->getLevelOfShrinkage() ?></td>
      <td><?php echo $dat->getRust() ?></td>
      <td><?php echo $dat->getDiscoloration() ?></td>
      <td><?php echo $dat->getSurfaceBlisteringBubbling() ?></td>
      <td><?php echo $dat->getThinTape() ?></td>
      <td><?php echo $dat->get1993OrEarlier() ?></td>
      <td><?php echo $dat->getDataGradeTape() ?></td>
      <td><?php echo $dat->getLongPlay32K96K() ?></td>
      <td><?php echo $dat->getCorrosionRustOxidation() ?></td>
      <td><?php echo $dat->getComposition() ?></td>
      <td><?php echo $dat->getNonStandardBrand() ?></td>
      <td><?php echo $dat->getTrackConfiguration() ?></td>
      <td><?php echo $dat->getTapeThickness() ?></td>
      <td><?php echo $dat->getSpeed() ?></td>
      <td><?php echo $dat->getSoftBinderSyndrome() ?></td>
      <td><?php echo $dat->getMaterialsBreakdown() ?></td>
      <td><?php echo $dat->getPhysicalDamage() ?></td>
      <td><?php echo $dat->getDelamination() ?></td>
      <td><?php echo $dat->getPlasticizerExudation() ?></td>
      <td><?php echo $dat->getRecordingLayer() ?></td>
      <td><?php echo $dat->getRecordingSpeed() ?></td>
      <td><?php echo $dat->getCylinderType() ?></td>
      <td><?php echo $dat->getReflectiveLayer() ?></td>
      <td><?php echo $dat->getDataLayer() ?></td>
      <td><?php echo $dat->getOpticalDiscType() ?></td>
      <td><?php echo $dat->getFormat() ?></td>
      <td><?php echo $dat->getRecordingStandard() ?></td>
      <td><?php echo $dat->getPublicationYear() ?></td>
      <td><?php echo $dat->getCapacityLayers() ?></td>
      <td><?php echo $dat->getCodec() ?></td>
      <td><?php echo $dat->getDataRate() ?></td>
      <td><?php echo $dat->getSheddingSoftBinder() ?></td>
      <td><?php echo $dat->getFormatVersion() ?></td>
      <td><?php echo $dat->getOxide() ?></td>
      <td><?php echo $dat->getBinderSystem() ?></td>
      <td><?php echo $dat->getReelSize() ?></td>
      <td><?php echo $dat->getWhiteResidue() ?></td>
      <td><?php echo $dat->getSize() ?></td>
      <td><?php echo $dat->getFormatTypedVideoRecordingFormat() ?></td>
      <td><?php echo $dat->getBitrate() ?></td>
      <td><?php echo $dat->getScanning() ?></td>
      <td><?php echo $dat->getCreatedAt() ?></td>
      <td><?php echo $dat->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('dat/new') ?>">New</a>
