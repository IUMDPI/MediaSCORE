<h1>Open reel audiotape papers List</h1>

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
    <?php foreach ($open_reel_audiotape_papers as $open_reel_audiotape_paper): ?>
    <tr>
      <td><a href="<?php echo url_for('openreelaudiotapepaper/show?id='.$open_reel_audiotape_paper->getId()) ?>"><?php echo $open_reel_audiotape_paper->getId() ?></a></td>
      <td><?php echo $open_reel_audiotape_paper->getQuantity() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getGeneration() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getYearRecorded() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getCopies() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getStockBrand() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getOffBrand() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getFungus() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getOtherContaminants() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getDuration() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getDurationType() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getType() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getMaterial() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getOxidationCorrosion() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getPackDeformation() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getNoiseReduction() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getTapeType() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getThinTape() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getSlowSpeed() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getSoundField() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getSoftBinderSyndrome() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getGauge() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getColor() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getColorFade() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getSoundtrackFormat() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getSubstrate() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getStrongOdor() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getVinegarOdor() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getADStripLevel() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getShrinkage() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getLevelOfShrinkage() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getRust() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getDiscoloration() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getSurfaceBlisteringBubbling() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getThinTape() ?></td>
      <td><?php echo $open_reel_audiotape_paper->get1993OrEarlier() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getDataGradeTape() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getLongPlay32K96K() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getCorrosionRustOxidation() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getComposition() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getNonStandardBrand() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getTrackConfiguration() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getTapeThickness() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getSpeed() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getSoftBinderSyndrome() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getMaterialsBreakdown() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getPhysicalDamage() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getDelamination() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getPlasticizerExudation() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getRecordingLayer() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getRecordingSpeed() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getCylinderType() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getReflectiveLayer() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getDataLayer() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getOpticalDiscType() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getFormat() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getRecordingStandard() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getPublicationYear() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getCapacityLayers() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getCodec() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getDataRate() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getSheddingSoftBinder() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getFormatVersion() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getOxide() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getBinderSystem() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getReelSize() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getWhiteResidue() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getSize() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getFormatTypedVideoRecordingFormat() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getBitrate() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getScanning() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getCreatedAt() ?></td>
      <td><?php echo $open_reel_audiotape_paper->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('openreelaudiotapepaper/new') ?>">New</a>
