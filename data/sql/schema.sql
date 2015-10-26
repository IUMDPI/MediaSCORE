CREATE TABLE `characteristics_constraints` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `constraint_name` varchar(255) DEFAULT NULL,
  `constraint_value` varchar(255) DEFAULT NULL,
  `constraint_readable` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

<<<<<<< HEAD
=======
CREATE TABLE `characteristics_format` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `format_id` bigint(20) DEFAULT NULL,
  `format_c_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `format_id_idx` (`format_id`),
  CONSTRAINT `characteristics_format_format_id_format_type_id` FOREIGN KEY (`format_id`) REFERENCES `format_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=196 DEFAULT CHARSET=latin1;

CREATE TABLE `characteristics_values` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `c_name` varchar(255) DEFAULT NULL,
  `c_score` float(18,2) DEFAULT NULL,
  `format_id` bigint(20) DEFAULT NULL,
  `constraint_id` bigint(20) DEFAULT NULL,
  `parent_characteristic_id` bigint(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_characteristic_id_idx` (`parent_characteristic_id`),
  KEY `format_id_idx` (`format_id`),
  KEY `constraint_id_idx` (`constraint_id`)
) ENGINE=InnoDB AUTO_INCREMENT=761 DEFAULT CHARSET=latin1;

CREATE TABLE `collection_storage_location` (
  `collection_id` bigint(20) NOT NULL DEFAULT '0',
  `storage_location_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`collection_id`,`storage_location_id`),
  KEY `storage_location_id` (`storage_location_id`),
  CONSTRAINT `collection_storage_location_ibfk_1` FOREIGN KEY (`collection_id`) REFERENCES `store` (`id`) ON DELETE CASCADE,
  CONSTRAINT `collection_storage_location_ibfk_2` FOREIGN KEY (`storage_location_id`) REFERENCES `storage_location` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `evaluator_history` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` bigint(20) NOT NULL,
  `evaluator_id` bigint(20) NOT NULL,
  `asset_group_id` bigint(20) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `asset_group_id_idx` (`asset_group_id`),
  CONSTRAINT `evaluator_history_ibfk_1` FOREIGN KEY (`asset_group_id`) REFERENCES `store` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=755 DEFAULT CHARSET=latin1;

CREATE TABLE `evaluator_history_personnel` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `evaluator_history_id` bigint(20) DEFAULT NULL,
  `person_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `evaluator_history_id_idx` (`evaluator_history_id`),
  KEY `person_id_idx` (`person_id`),
  CONSTRAINT `evaluator_history_personnel_ibfk_1` FOREIGN KEY (`evaluator_history_id`) REFERENCES `evaluator_history` (`id`) ON DELETE CASCADE,
  CONSTRAINT `evaluator_history_personnel_ibfk_2` FOREIGN KEY (`person_id`) REFERENCES `sf_guard_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=686 DEFAULT CHARSET=latin1;
>>>>>>> 98d124a31ac606025a45f7a756aaef023c444c4f

CREATE TABLE `format_type` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `quantity` bigint(20) NOT NULL,
  `generation` bigint(20) NOT NULL,
  `year_recorded` varchar(255) NOT NULL,
  `copies` tinyint(1) DEFAULT NULL,
  `stock_brand` varchar(255) DEFAULT NULL,
  `off_brand` tinyint(1) DEFAULT NULL,
  `fungus` tinyint(1) DEFAULT NULL,
  `other_contaminants` tinyint(1) DEFAULT NULL,
  `duration` varchar(255) NOT NULL,
  `duration_type` varchar(255) DEFAULT NULL,
  `duration_type_methodology` varchar(255) NOT NULL,
  `format_notes` text NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `material` bigint(20) NOT NULL,
  `oxidationcorrosion` tinyint(1) NOT NULL,
  `pack_deformation` bigint(20) DEFAULT NULL,
  `noise_reduction` tinyint(1) NOT NULL,
  `tape_type` bigint(20) NOT NULL,
  `thin_tape` tinyint(1) DEFAULT NULL,
  `slow_speed` tinyint(1) DEFAULT NULL,
  `sound_field` bigint(20) NOT NULL,
  `soft_binder_syndrome` tinyint(1) DEFAULT NULL,
  `gauge` bigint(20) NOT NULL,
  `color` int(5) NOT NULL,
  `colorfade` tinyint(1) DEFAULT NULL,
  `soundtrackformat` bigint(20) DEFAULT NULL,
  `substrate` bigint(20) NOT NULL,
  `strongodor` tinyint(1) DEFAULT NULL,
  `vinegarodor` tinyint(1) DEFAULT NULL,
  `adstriplevel` bigint(20) DEFAULT NULL,
  `shrinkage` tinyint(1) DEFAULT NULL,
  `levelofshrinkage` bigint(20) DEFAULT NULL,
  `rust` tinyint(1) DEFAULT NULL,
  `discoloration` tinyint(1) DEFAULT NULL,
  `surfaceblisteringbubbling` tinyint(1) DEFAULT NULL,
  `thintape` tinyint(1) DEFAULT NULL,
  `1993orearlier` tinyint(1) DEFAULT NULL,
  `datagradetape` tinyint(1) DEFAULT NULL,
  `longplay32k96k` tinyint(1) DEFAULT NULL,
  `corrosionrustoxidation` tinyint(1) DEFAULT NULL,
  `composition` bigint(20) DEFAULT NULL,
  `nonstandardbrand` tinyint(1) DEFAULT NULL,
  `trackconfiguration` bigint(20) NOT NULL,
  `tapethickness` bigint(20) DEFAULT NULL,
  `speed` varchar(255) NOT NULL,
  `softbindersyndrome` varchar(255) DEFAULT NULL,
  `materialsbreakdown` tinyint(1) DEFAULT NULL,
  `physicaldamage` bigint(20) DEFAULT NULL,
  `delamination` tinyint(1) DEFAULT NULL,
  `plasticizerexudation` tinyint(1) DEFAULT NULL,
  `recordinglayer` bigint(20) NOT NULL,
  `recordingspeed` bigint(20) NOT NULL,
  `cylindertype` bigint(20) NOT NULL,
  `reflectivelayer` varchar(255) NOT NULL,
  `datalayer` varchar(255) NOT NULL,
  `opticaldisctype` bigint(20) NOT NULL,
  `format` bigint(20) NOT NULL,
  `recordingstandard` bigint(20) NOT NULL,
  `publicationyear` year(4) NOT NULL,
  `capacitylayers` bigint(20) NOT NULL,
  `codec` varchar(255) NOT NULL,
  `datarate` varchar(255) NOT NULL,
  `sheddingsoftbinder` tinyint(1) DEFAULT NULL,
  `formatversion` varchar(255) NOT NULL,
  `oxide` bigint(20) NOT NULL,
  `bindersystem` tinyint(1) NOT NULL,
  `reelsize` varchar(255) NOT NULL,
  `whiteresidue` tinyint(1) DEFAULT NULL,
  `size` tinyint(1) NOT NULL,
  `formattypedvideorecordingformat` bigint(20) NOT NULL,
  `bitrate` varchar(255) DEFAULT NULL,
  `scanning` bigint(20) NOT NULL,
  `asset_score` float NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `format_type_type_idx` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=18969 DEFAULT CHARSET=latin1;

<<<<<<< HEAD
CREATE TABLE `characteristics_format` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `format_id` bigint(20) DEFAULT NULL,
  `format_c_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `format_id_idx` (`format_id`),
  CONSTRAINT `characteristics_format_format_id_format_type_id` FOREIGN KEY (`format_id`) REFERENCES `format_type` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=196 DEFAULT CHARSET=latin1;

CREATE TABLE `characteristics_values` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `c_name` varchar(255) DEFAULT NULL,
  `c_score` float(18,2) DEFAULT NULL,
  `format_id` bigint(20) DEFAULT NULL,
  `constraint_id` bigint(20) DEFAULT NULL,
  `parent_characteristic_id` bigint(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_characteristic_id_idx` (`parent_characteristic_id`),
  KEY `format_id_idx` (`format_id`),
  KEY `constraint_id_idx` (`constraint_id`)
) ENGINE=InnoDB AUTO_INCREMENT=761 DEFAULT CHARSET=latin1;



CREATE TABLE `storage_location` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `resident_structure_description` text NOT NULL,
  `env_rating` bigint(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;


CREATE TABLE `sf_guard_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email_address` varchar(255) NOT NULL,
  `username` varchar(128) NOT NULL,
  `algorithm` varchar(128) NOT NULL DEFAULT 'sha1',
  `salt` varchar(128) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `activation_key` varchar(255) NOT NULL,
  `forgot_password` tinyint(1) NOT NULL,
  `is_super_admin` tinyint(1) DEFAULT '0',
  `last_login` datetime DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL,
  `mediascore_access` tinyint(1) NOT NULL DEFAULT '1',
  `mediariver_access` tinyint(1) NOT NULL DEFAULT '1',
  `contact_info` text,
  `unit_id` bigint(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_address` (`email_address`),
  UNIQUE KEY `username` (`username`),
  KEY `is_active_idx_idx` (`is_active`),
  KEY `sf_guard_user_type_idx` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;

CREATE TABLE `store` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `name_slug` text NOT NULL,
  `inst_id` text NOT NULL,
  `notes` text,
  `creator_id` bigint(20) DEFAULT NULL,
  `last_editor_id` bigint(20) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `is_imported` tinyint(1) DEFAULT '0',
  `resident_structure_description` text,
  `parent_node_id` bigint(20) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `format_id` bigint(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `characteristics` text,
  `project_title` varchar(255) DEFAULT NULL,
  `iub_unit` bigint(20) DEFAULT NULL,
  `iub_work` bigint(20) DEFAULT NULL,
  `date_completed` datetime DEFAULT NULL,
  `score_subject_interest` float(18,2) DEFAULT NULL,
  `notes_subject_interest` text,
  `score_content_quality` float(18,2) DEFAULT NULL,
  `notes_content_quality` text,
  `score_rareness` float(18,2) DEFAULT NULL,
  `notes_rareness` text,
  `score_documentation` float(18,2) DEFAULT NULL,
  `notes_documentation` text,
  `score_technical_quality` float DEFAULT NULL,
  `notes_technical_quality` text,
  `unknown_technical_quality` varchar(6) DEFAULT NULL,
  `collection_score` float DEFAULT NULL,
  `generation_statement` varchar(255) DEFAULT NULL,
  `generation_statement_notes` text,
  `ip_statement` varchar(255) DEFAULT NULL,
  `ip_statement_notes` text,
  `general_notes` text,
  PRIMARY KEY (`id`),
  KEY `store_type_idx` (`type`),
  KEY `creator_id_idx` (`creator_id`),
  KEY `last_editor_id_idx` (`last_editor_id`),
  KEY `format_id` (`format_id`),
  KEY `type` (`type`),
  KEY `parent_node_id` (`parent_node_id`),
  KEY `status` (`status`),
  CONSTRAINT `store_ibfk_1` FOREIGN KEY (`creator_id`) REFERENCES `sf_guard_user` (`id`) ON DELETE SET NULL,
  CONSTRAINT `store_ibfk_2` FOREIGN KEY (`last_editor_id`) REFERENCES `sf_guard_user` (`id`) ON DELETE SET NULL,
  CONSTRAINT `store_ibfk_3` FOREIGN KEY (`format_id`) REFERENCES `format_type` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8147 DEFAULT CHARSET=latin1;

CREATE TABLE `collection_storage_location` (
  `collection_id` bigint(20) NOT NULL DEFAULT '0',
  `storage_location_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`collection_id`,`storage_location_id`),
  KEY `storage_location_id` (`storage_location_id`),
  CONSTRAINT `collection_storage_location_ibfk_1` FOREIGN KEY (`collection_id`) REFERENCES `store` (`id`) ON DELETE CASCADE,
  CONSTRAINT `collection_storage_location_ibfk_2` FOREIGN KEY (`storage_location_id`) REFERENCES `storage_location` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `evaluator_history` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` bigint(20) NOT NULL,
  `evaluator_id` bigint(20) NOT NULL,
  `asset_group_id` bigint(20) DEFAULT NULL,
  `updated_at` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `asset_group_id_idx` (`asset_group_id`),
  CONSTRAINT `evaluator_history_ibfk_1` FOREIGN KEY (`asset_group_id`) REFERENCES `store` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=755 DEFAULT CHARSET=latin1;

CREATE TABLE `evaluator_history_personnel` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `evaluator_history_id` bigint(20) DEFAULT NULL,
  `person_id` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `evaluator_history_id_idx` (`evaluator_history_id`),
  KEY `person_id_idx` (`person_id`),
  CONSTRAINT `evaluator_history_personnel_ibfk_1` FOREIGN KEY (`evaluator_history_id`) REFERENCES `evaluator_history` (`id`) ON DELETE CASCADE,
  CONSTRAINT `evaluator_history_personnel_ibfk_2` FOREIGN KEY (`person_id`) REFERENCES `sf_guard_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=686 DEFAULT CHARSET=latin1;



=======
>>>>>>> 98d124a31ac606025a45f7a756aaef023c444c4f
CREATE TABLE `pressed45_r_p_m_disc` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `quantity` bigint(20) NOT NULL,
  `generation` bigint(20) NOT NULL,
  `year_recorded` varchar(255) NOT NULL,
  `copies` tinyint(1) DEFAULT NULL,
  `stock_brand` varchar(255) DEFAULT NULL,
  `off_brand` tinyint(1) DEFAULT NULL,
  `fungus` tinyint(1) DEFAULT NULL,
  `other_contaminants` tinyint(1) DEFAULT NULL,
  `duration` bigint(20) NOT NULL,
  `duration_type` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `material` bigint(20) NOT NULL,
  `oxidationcorrosion` tinyint(1) NOT NULL,
  `pack_deformation` bigint(20) DEFAULT NULL,
  `noise_reduction` tinyint(1) NOT NULL,
  `tape_type` bigint(20) NOT NULL,
  `thin_tape` tinyint(1) DEFAULT NULL,
  `slow_speed` tinyint(1) DEFAULT NULL,
  `sound_field` bigint(20) NOT NULL,
  `soft_binder_syndrome` tinyint(1) DEFAULT NULL,
  `gauge` bigint(20) NOT NULL,
  `color` tinyint(1) NOT NULL,
  `colorfade` tinyint(1) DEFAULT NULL,
  `soundtrackformat` bigint(20) DEFAULT NULL,
  `substrate` bigint(20) NOT NULL,
  `strongodor` tinyint(1) DEFAULT NULL,
  `vinegarodor` tinyint(1) DEFAULT NULL,
  `adstriplevel` bigint(20) DEFAULT NULL,
  `shrinkage` tinyint(1) DEFAULT NULL,
  `levelofshrinkage` bigint(20) DEFAULT NULL,
  `rust` tinyint(1) DEFAULT NULL,
  `discoloration` tinyint(1) DEFAULT NULL,
  `surfaceblisteringbubbling` tinyint(1) DEFAULT NULL,
  `thintape` tinyint(1) DEFAULT NULL,
  `1993orearlier` tinyint(1) DEFAULT NULL,
  `datagradetape` tinyint(1) DEFAULT NULL,
  `longplay32k96k` tinyint(1) DEFAULT NULL,
  `corrosionrustoxidation` tinyint(1) DEFAULT NULL,
  `composition` bigint(20) DEFAULT NULL,
  `nonstandardbrand` tinyint(1) DEFAULT NULL,
  `trackconfiguration` bigint(20) NOT NULL,
  `tapethickness` bigint(20) DEFAULT NULL,
  `speed` bigint(20) NOT NULL,
  `softbindersyndrome` bigint(20) DEFAULT NULL,
  `materialsbreakdown` tinyint(1) DEFAULT NULL,
  `physicaldamage` bigint(20) DEFAULT NULL,
  `delamination` tinyint(1) DEFAULT NULL,
  `plasticizerexudation` tinyint(1) DEFAULT NULL,
  `recordinglayer` bigint(20) NOT NULL,
  `recordingspeed` bigint(20) NOT NULL,
  `cylindertype` bigint(20) NOT NULL,
  `reflectivelayer` bigint(20) NOT NULL,
  `datalayer` bigint(20) NOT NULL,
  `opticaldisctype` bigint(20) NOT NULL,
  `format` bigint(20) NOT NULL,
  `recordingstandard` bigint(20) NOT NULL,
  `publicationyear` date NOT NULL,
  `capacitylayers` bigint(20) NOT NULL,
  `codec` bigint(20) NOT NULL,
  `datarate` bigint(20) NOT NULL,
  `sheddingsoftbinder` tinyint(1) DEFAULT NULL,
  `formatversion` bigint(20) NOT NULL,
  `oxide` bigint(20) NOT NULL,
  `bindersystem` tinyint(1) NOT NULL,
  `reelsize` bigint(20) NOT NULL,
  `whiteresidue` tinyint(1) DEFAULT NULL,
  `size` tinyint(1) NOT NULL,
  `formattypedvideorecordingformat` bigint(20) NOT NULL,
  `bitrate` bigint(20) DEFAULT NULL,
  `scanning` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `format_type_type_idx` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `pressed78_r_p_m_disc` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `quantity` bigint(20) NOT NULL,
  `generation` bigint(20) NOT NULL,
  `year_recorded` varchar(255) NOT NULL,
  `copies` tinyint(1) DEFAULT NULL,
  `stock_brand` varchar(255) DEFAULT NULL,
  `off_brand` tinyint(1) DEFAULT NULL,
  `fungus` tinyint(1) DEFAULT NULL,
  `other_contaminants` tinyint(1) DEFAULT NULL,
  `duration` bigint(20) NOT NULL,
  `duration_type` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `material` bigint(20) NOT NULL,
  `oxidationcorrosion` tinyint(1) NOT NULL,
  `pack_deformation` bigint(20) DEFAULT NULL,
  `noise_reduction` tinyint(1) NOT NULL,
  `tape_type` bigint(20) NOT NULL,
  `thin_tape` tinyint(1) DEFAULT NULL,
  `slow_speed` tinyint(1) DEFAULT NULL,
  `sound_field` bigint(20) NOT NULL,
  `soft_binder_syndrome` tinyint(1) DEFAULT NULL,
  `gauge` bigint(20) NOT NULL,
  `color` tinyint(1) NOT NULL,
  `colorfade` tinyint(1) DEFAULT NULL,
  `soundtrackformat` bigint(20) DEFAULT NULL,
  `substrate` bigint(20) NOT NULL,
  `strongodor` tinyint(1) DEFAULT NULL,
  `vinegarodor` tinyint(1) DEFAULT NULL,
  `adstriplevel` bigint(20) DEFAULT NULL,
  `shrinkage` tinyint(1) DEFAULT NULL,
  `levelofshrinkage` bigint(20) DEFAULT NULL,
  `rust` tinyint(1) DEFAULT NULL,
  `discoloration` tinyint(1) DEFAULT NULL,
  `surfaceblisteringbubbling` tinyint(1) DEFAULT NULL,
  `thintape` tinyint(1) DEFAULT NULL,
  `1993orearlier` tinyint(1) DEFAULT NULL,
  `datagradetape` tinyint(1) DEFAULT NULL,
  `longplay32k96k` tinyint(1) DEFAULT NULL,
  `corrosionrustoxidation` tinyint(1) DEFAULT NULL,
  `composition` bigint(20) DEFAULT NULL,
  `nonstandardbrand` tinyint(1) DEFAULT NULL,
  `trackconfiguration` bigint(20) NOT NULL,
  `tapethickness` bigint(20) DEFAULT NULL,
  `speed` bigint(20) NOT NULL,
  `softbindersyndrome` bigint(20) DEFAULT NULL,
  `materialsbreakdown` tinyint(1) DEFAULT NULL,
  `physicaldamage` bigint(20) DEFAULT NULL,
  `delamination` tinyint(1) DEFAULT NULL,
  `plasticizerexudation` tinyint(1) DEFAULT NULL,
  `recordinglayer` bigint(20) NOT NULL,
  `recordingspeed` bigint(20) NOT NULL,
  `cylindertype` bigint(20) NOT NULL,
  `reflectivelayer` bigint(20) NOT NULL,
  `datalayer` bigint(20) NOT NULL,
  `opticaldisctype` bigint(20) NOT NULL,
  `format` bigint(20) NOT NULL,
  `recordingstandard` bigint(20) NOT NULL,
  `publicationyear` date NOT NULL,
  `capacitylayers` bigint(20) NOT NULL,
  `codec` bigint(20) NOT NULL,
  `datarate` bigint(20) NOT NULL,
  `sheddingsoftbinder` tinyint(1) DEFAULT NULL,
  `formatversion` bigint(20) NOT NULL,
  `oxide` bigint(20) NOT NULL,
  `bindersystem` tinyint(1) NOT NULL,
  `reelsize` bigint(20) NOT NULL,
  `whiteresidue` tinyint(1) DEFAULT NULL,
  `size` tinyint(1) NOT NULL,
  `formattypedvideorecordingformat` bigint(20) NOT NULL,
  `bitrate` bigint(20) DEFAULT NULL,
  `scanning` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `format_type_type_idx` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `sf_guard_forgot_password` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `unique_key` varchar(255) DEFAULT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_idx` (`user_id`),
  CONSTRAINT `sf_guard_forgot_password_user_id_sf_guard_user_id` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `sf_guard_group` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

<<<<<<< HEAD
CREATE TABLE `sf_guard_permission` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

=======
>>>>>>> 98d124a31ac606025a45f7a756aaef023c444c4f
CREATE TABLE `sf_guard_group_permission` (
  `group_id` bigint(20) NOT NULL DEFAULT '0',
  `permission_id` bigint(20) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`group_id`,`permission_id`),
  KEY `sf_guard_group_permission_permission_id_sf_guard_permission_id` (`permission_id`),
  CONSTRAINT `sf_guard_group_permission_group_id_sf_guard_group_id` FOREIGN KEY (`group_id`) REFERENCES `sf_guard_group` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sf_guard_group_permission_permission_id_sf_guard_permission_id` FOREIGN KEY (`permission_id`) REFERENCES `sf_guard_permission` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

<<<<<<< HEAD
=======
CREATE TABLE `sf_guard_permission` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
>>>>>>> 98d124a31ac606025a45f7a756aaef023c444c4f

CREATE TABLE `sf_guard_remember_key` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `remember_key` varchar(32) DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id_idx` (`user_id`),
  CONSTRAINT `sf_guard_remember_key_user_id_sf_guard_user_id` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

<<<<<<< HEAD
=======
CREATE TABLE `sf_guard_user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email_address` varchar(255) NOT NULL,
  `username` varchar(128) NOT NULL,
  `algorithm` varchar(128) NOT NULL DEFAULT 'sha1',
  `salt` varchar(128) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `activation_key` varchar(255) NOT NULL,
  `forgot_password` tinyint(1) NOT NULL,
  `is_super_admin` tinyint(1) DEFAULT '0',
  `last_login` datetime DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL,
  `mediascore_access` tinyint(1) NOT NULL DEFAULT '1',
  `mediariver_access` tinyint(1) NOT NULL DEFAULT '1',
  `contact_info` text,
  `unit_id` bigint(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_address` (`email_address`),
  UNIQUE KEY `username` (`username`),
  KEY `is_active_idx_idx` (`is_active`),
  KEY `sf_guard_user_type_idx` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;

>>>>>>> 98d124a31ac606025a45f7a756aaef023c444c4f
CREATE TABLE `sf_guard_user_group` (
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `group_id` bigint(20) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`),
  KEY `sf_guard_user_group_group_id_sf_guard_group_id` (`group_id`),
  CONSTRAINT `sf_guard_user_group_group_id_sf_guard_group_id` FOREIGN KEY (`group_id`) REFERENCES `sf_guard_group` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sf_guard_user_group_user_id_sf_guard_user_id` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `sf_guard_user_permission` (
  `user_id` bigint(20) NOT NULL DEFAULT '0',
  `permission_id` bigint(20) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`user_id`,`permission_id`),
  KEY `sf_guard_user_permission_permission_id_sf_guard_permission_id` (`permission_id`),
  CONSTRAINT `sf_guard_user_permission_permission_id_sf_guard_permission_id` FOREIGN KEY (`permission_id`) REFERENCES `sf_guard_permission` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sf_guard_user_permission_user_id_sf_guard_user_id` FOREIGN KEY (`user_id`) REFERENCES `sf_guard_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

<<<<<<< HEAD
=======
CREATE TABLE `storage_location` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `resident_structure_description` text NOT NULL,
  `env_rating` bigint(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

CREATE TABLE `store` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `name_slug` text NOT NULL,
  `inst_id` text NOT NULL,
  `notes` text,
  `creator_id` bigint(20) DEFAULT NULL,
  `last_editor_id` bigint(20) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `is_imported` tinyint(1) DEFAULT '0',
  `resident_structure_description` text,
  `parent_node_id` bigint(20) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `format_id` bigint(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `characteristics` text,
  `project_title` varchar(255) DEFAULT NULL,
  `iub_unit` bigint(20) DEFAULT NULL,
  `iub_work` bigint(20) DEFAULT NULL,
  `date_completed` datetime DEFAULT NULL,
  `score_subject_interest` float(18,2) DEFAULT NULL,
  `notes_subject_interest` text,
  `score_content_quality` float(18,2) DEFAULT NULL,
  `notes_content_quality` text,
  `score_rareness` float(18,2) DEFAULT NULL,
  `notes_rareness` text,
  `score_documentation` float(18,2) DEFAULT NULL,
  `notes_documentation` text,
  `score_technical_quality` float DEFAULT NULL,
  `notes_technical_quality` text,
  `unknown_technical_quality` varchar(6) DEFAULT NULL,
  `collection_score` float DEFAULT NULL,
  `generation_statement` varchar(255) DEFAULT NULL,
  `generation_statement_notes` text,
  `ip_statement` varchar(255) DEFAULT NULL,
  `ip_statement_notes` text,
  `general_notes` text,
  PRIMARY KEY (`id`),
  KEY `store_type_idx` (`type`),
  KEY `creator_id_idx` (`creator_id`),
  KEY `last_editor_id_idx` (`last_editor_id`),
  KEY `format_id` (`format_id`),
  KEY `type` (`type`),
  KEY `parent_node_id` (`parent_node_id`),
  KEY `status` (`status`),
  CONSTRAINT `store_ibfk_1` FOREIGN KEY (`creator_id`) REFERENCES `sf_guard_user` (`id`) ON DELETE SET NULL,
  CONSTRAINT `store_ibfk_2` FOREIGN KEY (`last_editor_id`) REFERENCES `sf_guard_user` (`id`) ON DELETE SET NULL,
  CONSTRAINT `store_ibfk_3` FOREIGN KEY (`format_id`) REFERENCES `format_type` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8147 DEFAULT CHARSET=latin1;
>>>>>>> 98d124a31ac606025a45f7a756aaef023c444c4f

CREATE TABLE `unit_person` (
  `unit_id` bigint(20) NOT NULL DEFAULT '0',
  `person_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`unit_id`,`person_id`),
  KEY `person_id` (`person_id`),
  CONSTRAINT `unit_person_ibfk_1` FOREIGN KEY (`unit_id`) REFERENCES `store` (`id`) ON DELETE CASCADE,
  CONSTRAINT `unit_person_ibfk_2` FOREIGN KEY (`person_id`) REFERENCES `sf_guard_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `unit_storage_location` (
  `unit_id` bigint(20) NOT NULL DEFAULT '0',
  `storage_location_id` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`unit_id`,`storage_location_id`),
  KEY `storage_location_id` (`storage_location_id`),
  CONSTRAINT `unit_storage_location_ibfk_1` FOREIGN KEY (`unit_id`) REFERENCES `store` (`id`) ON DELETE CASCADE,
  CONSTRAINT `unit_storage_location_ibfk_2` FOREIGN KEY (`storage_location_id`) REFERENCES `storage_location` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
