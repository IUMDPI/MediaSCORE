<h1>Open reel audiotape pv cs List</h1>

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
    <?php foreach ($open_reel_audiotape_pv_cs as $open_reel_audiotape_pvc): ?>
    <tr>
      <td><a href="<?php echo url_for('openreelaudiotapepvc/show?id='.$open_reel_audiotape_pvc->getId()) ?>"><?php echo $open_reel_audiotape_pvc->getId() ?></a></td>
      <td><?php echo $open_reel_audiotape_pvc->getQuantity() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getGeneration() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getYearRecorded() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getCopies() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getStockBrand() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getOffBrand() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getFungus() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getOtherContaminants() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getDuration() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getDurationType() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getType() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getMaterial() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getOxidationCorrosion() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getPackDeformation() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getNoiseReduction() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getTapeType() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getThinTape() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getSlowSpeed() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getSoundField() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getSoftBinderSyndrome() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getGauge() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getColor() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getColorFade() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getSoundtrackFormat() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getSubstrate() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getStrongOdor() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getVinegarOdor() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getADStripLevel() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getShrinkage() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getLevelOfShrinkage() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getRust() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getDiscoloration() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getSurfaceBlisteringBubbling() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getThinTape() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->get1993OrEarlier() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getDataGradeTape() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getLongPlay32K96K() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getCorrosionRustOxidation() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getComposition() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getNonStandardBrand() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getTrackConfiguration() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getTapeThickness() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getSpeed() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getSoftBinderSyndrome() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getMaterialsBreakdown() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getPhysicalDamage() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getDelamination() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getPlasticizerExudation() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getRecordingLayer() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getRecordingSpeed() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getCylinderType() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getReflectiveLayer() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getDataLayer() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getOpticalDiscType() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getFormat() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getRecordingStandard() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getPublicationYear() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getCapacityLayers() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getCodec() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getDataRate() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getSheddingSoftBinder() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getFormatVersion() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getOxide() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getBinderSystem() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getReelSize() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getWhiteResidue() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getSize() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getFormatTypedVideoRecordingFormat() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getBitrate() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getScanning() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getCreatedAt() ?></td>
      <td><?php echo $open_reel_audiotape_pvc->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('openreelaudiotapepvc/new') ?>">New</a>
