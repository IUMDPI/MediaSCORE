<h1>D vs List</h1>

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
    <?php foreach ($d_vs as $dv): ?>
    <tr>
      <td><a href="<?php echo url_for('dv/show?id='.$dv->getId()) ?>"><?php echo $dv->getId() ?></a></td>
      <td><?php echo $dv->getQuantity() ?></td>
      <td><?php echo $dv->getGeneration() ?></td>
      <td><?php echo $dv->getYearRecorded() ?></td>
      <td><?php echo $dv->getCopies() ?></td>
      <td><?php echo $dv->getStockBrand() ?></td>
      <td><?php echo $dv->getOffBrand() ?></td>
      <td><?php echo $dv->getFungus() ?></td>
      <td><?php echo $dv->getOtherContaminants() ?></td>
      <td><?php echo $dv->getDuration() ?></td>
      <td><?php echo $dv->getDurationType() ?></td>
      <td><?php echo $dv->getType() ?></td>
      <td><?php echo $dv->getMaterial() ?></td>
      <td><?php echo $dv->getOxidationCorrosion() ?></td>
      <td><?php echo $dv->getPackDeformation() ?></td>
      <td><?php echo $dv->getNoiseReduction() ?></td>
      <td><?php echo $dv->getTapeType() ?></td>
      <td><?php echo $dv->getThinTape() ?></td>
      <td><?php echo $dv->getSlowSpeed() ?></td>
      <td><?php echo $dv->getSoundField() ?></td>
      <td><?php echo $dv->getSoftBinderSyndrome() ?></td>
      <td><?php echo $dv->getGauge() ?></td>
      <td><?php echo $dv->getColor() ?></td>
      <td><?php echo $dv->getColorFade() ?></td>
      <td><?php echo $dv->getSoundtrackFormat() ?></td>
      <td><?php echo $dv->getSubstrate() ?></td>
      <td><?php echo $dv->getStrongOdor() ?></td>
      <td><?php echo $dv->getVinegarOdor() ?></td>
      <td><?php echo $dv->getADStripLevel() ?></td>
      <td><?php echo $dv->getShrinkage() ?></td>
      <td><?php echo $dv->getLevelOfShrinkage() ?></td>
      <td><?php echo $dv->getRust() ?></td>
      <td><?php echo $dv->getDiscoloration() ?></td>
      <td><?php echo $dv->getSurfaceBlisteringBubbling() ?></td>
      <td><?php echo $dv->getThinTape() ?></td>
      <td><?php echo $dv->get1993OrEarlier() ?></td>
      <td><?php echo $dv->getDataGradeTape() ?></td>
      <td><?php echo $dv->getLongPlay32K96K() ?></td>
      <td><?php echo $dv->getCorrosionRustOxidation() ?></td>
      <td><?php echo $dv->getComposition() ?></td>
      <td><?php echo $dv->getNonStandardBrand() ?></td>
      <td><?php echo $dv->getTrackConfiguration() ?></td>
      <td><?php echo $dv->getTapeThickness() ?></td>
      <td><?php echo $dv->getSpeed() ?></td>
      <td><?php echo $dv->getSoftBinderSyndrome() ?></td>
      <td><?php echo $dv->getMaterialsBreakdown() ?></td>
      <td><?php echo $dv->getPhysicalDamage() ?></td>
      <td><?php echo $dv->getDelamination() ?></td>
      <td><?php echo $dv->getPlasticizerExudation() ?></td>
      <td><?php echo $dv->getRecordingLayer() ?></td>
      <td><?php echo $dv->getRecordingSpeed() ?></td>
      <td><?php echo $dv->getCylinderType() ?></td>
      <td><?php echo $dv->getReflectiveLayer() ?></td>
      <td><?php echo $dv->getDataLayer() ?></td>
      <td><?php echo $dv->getOpticalDiscType() ?></td>
      <td><?php echo $dv->getFormat() ?></td>
      <td><?php echo $dv->getRecordingStandard() ?></td>
      <td><?php echo $dv->getPublicationYear() ?></td>
      <td><?php echo $dv->getCapacityLayers() ?></td>
      <td><?php echo $dv->getCodec() ?></td>
      <td><?php echo $dv->getDataRate() ?></td>
      <td><?php echo $dv->getSheddingSoftBinder() ?></td>
      <td><?php echo $dv->getFormatVersion() ?></td>
      <td><?php echo $dv->getOxide() ?></td>
      <td><?php echo $dv->getBinderSystem() ?></td>
      <td><?php echo $dv->getReelSize() ?></td>
      <td><?php echo $dv->getWhiteResidue() ?></td>
      <td><?php echo $dv->getSize() ?></td>
      <td><?php echo $dv->getFormatTypedVideoRecordingFormat() ?></td>
      <td><?php echo $dv->getBitrate() ?></td>
      <td><?php echo $dv->getScanning() ?></td>
      <td><?php echo $dv->getCreatedAt() ?></td>
      <td><?php echo $dv->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('dv/new') ?>">New</a>
