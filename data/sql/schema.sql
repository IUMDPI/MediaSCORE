CREATE TABLE format_type (id BIGINT AUTO_INCREMENT, quantity BIGINT NOT NULL, generation BIGINT NOT NULL, year_recorded VARCHAR(255) NOT NULL, copies TINYINT(1), stock_brand VARCHAR(255), off_brand TINYINT(1), fungus TINYINT(1), other_contaminants TINYINT(1), duration BIGINT NOT NULL, duration_type VARCHAR(255), type VARCHAR(255), material BIGINT NOT NULL, oxidationcorrosion TINYINT(1) NOT NULL, pack_deformation BIGINT, noise_reduction TINYINT(1) NOT NULL, tape_type BIGINT NOT NULL, thin_tape TINYINT(1), slow_speed TINYINT(1), sound_field BIGINT NOT NULL, soft_binder_syndrome TINYINT(1), gauge BIGINT NOT NULL, color TINYINT(1) NOT NULL, colorfade TINYINT(1), soundtrackformat BIGINT, substrate BIGINT NOT NULL, strongodor TINYINT(1), vinegarodor TINYINT(1), adstriplevel BIGINT, shrinkage TINYINT(1), levelofshrinkage BIGINT, rust TINYINT(1), discoloration TINYINT(1), surfaceblisteringbubbling TINYINT(1), thintape TINYINT(1), 1993orearlier TINYINT(1), datagradetape TINYINT(1), longplay32k96k TINYINT(1), corrosionrustoxidation TINYINT(1), composition BIGINT, nonstandardbrand TINYINT(1), trackconfiguration BIGINT NOT NULL, tapethickness BIGINT, speed BIGINT NOT NULL, softbindersyndrome BIGINT, materialsbreakdown TINYINT(1), physicaldamage BIGINT, delamination TINYINT(1), plasticizerexudation TINYINT(1), recordinglayer BIGINT NOT NULL, recordingspeed BIGINT NOT NULL, cylindertype BIGINT NOT NULL, reflectivelayer BIGINT NOT NULL, datalayer BIGINT NOT NULL, opticaldisctype BIGINT NOT NULL, format BIGINT NOT NULL, recordingstandard BIGINT NOT NULL, publicationyear DATE NOT NULL, capacitylayers BIGINT NOT NULL, codec BIGINT NOT NULL, datarate BIGINT NOT NULL, sheddingsoftbinder TINYINT(1), formatversion BIGINT NOT NULL, oxide BIGINT NOT NULL, bindersystem TINYINT(1) NOT NULL, reelsize BIGINT NOT NULL, whiteresidue TINYINT(1), size TINYINT(1) NOT NULL, formattypedvideorecordingformat BIGINT NOT NULL, bitrate BIGINT, scanning BIGINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE store (id BIGINT AUTO_INCREMENT, name VARCHAR(255) NOT NULL, inst_id VARCHAR(255) NOT NULL, notes text, creator_id BIGINT, last_editor_id BIGINT, type VARCHAR(255), resident_structure_description text, parent_node_id BIGINT, status VARCHAR(255), location VARCHAR(255), format_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX creator_id_idx (creator_id), INDEX last_editor_id_idx (last_editor_id), INDEX format_id_idx (format_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE store (id BIGINT AUTO_INCREMENT, name VARCHAR(255) NOT NULL, inst_id VARCHAR(255) NOT NULL, notes text, creator_id BIGINT, last_editor_id BIGINT, type VARCHAR(255), resident_structure_description text, parent_node_id BIGINT, status VARCHAR(255), location VARCHAR(255), format_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX creator_id_idx (creator_id), INDEX last_editor_id_idx (last_editor_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE collection_storage_location (collection_id BIGINT, storage_location_id BIGINT, PRIMARY KEY(collection_id, storage_location_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user (id BIGINT AUTO_INCREMENT, first_name VARCHAR(255), last_name VARCHAR(255), email_address VARCHAR(255) NOT NULL UNIQUE, username VARCHAR(128) NOT NULL UNIQUE, algorithm VARCHAR(128) DEFAULT 'sha1' NOT NULL, salt VARCHAR(128), password VARCHAR(128), is_active TINYINT(1) DEFAULT '1', is_super_admin TINYINT(1) DEFAULT '0', last_login DATETIME, type VARCHAR(255), phone VARCHAR(255), role VARCHAR(255) NOT NULL, contact_info text, unit_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX is_active_idx_idx (is_active), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE evaluator_history (id BIGINT AUTO_INCREMENT, type BIGINT NOT NULL, evaluator_id BIGINT NOT NULL, asset_group_id BIGINT, updated_at DATE, INDEX evaluator_id_idx (evaluator_id), INDEX asset_group_id_idx (asset_group_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE evaluator_history_personnel (id BIGINT AUTO_INCREMENT, evaluator_history_id BIGINT, person_id BIGINT, INDEX evaluator_history_id_idx (evaluator_history_id), INDEX person_id_idx (person_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE format_type (id BIGINT AUTO_INCREMENT, quantity BIGINT NOT NULL, generation BIGINT NOT NULL, year_recorded VARCHAR(255) NOT NULL, copies TINYINT(1), stock_brand VARCHAR(255), off_brand TINYINT(1), fungus TINYINT(1), other_contaminants TINYINT(1), duration BIGINT NOT NULL, duration_type VARCHAR(255), type VARCHAR(255), material BIGINT NOT NULL, oxidationcorrosion TINYINT(1) NOT NULL, pack_deformation BIGINT, noise_reduction TINYINT(1) NOT NULL, tape_type BIGINT NOT NULL, thin_tape TINYINT(1), slow_speed TINYINT(1), sound_field BIGINT NOT NULL, soft_binder_syndrome TINYINT(1), gauge BIGINT NOT NULL, color TINYINT(1) NOT NULL, colorfade TINYINT(1), soundtrackformat BIGINT, substrate BIGINT NOT NULL, strongodor TINYINT(1), vinegarodor TINYINT(1), adstriplevel BIGINT, shrinkage TINYINT(1), levelofshrinkage BIGINT, rust TINYINT(1), discoloration TINYINT(1), surfaceblisteringbubbling TINYINT(1), thintape TINYINT(1), 1993orearlier TINYINT(1), datagradetape TINYINT(1), longplay32k96k TINYINT(1), corrosionrustoxidation TINYINT(1), composition BIGINT, nonstandardbrand TINYINT(1), trackconfiguration BIGINT NOT NULL, tapethickness BIGINT, speed BIGINT NOT NULL, softbindersyndrome BIGINT, materialsbreakdown TINYINT(1), physicaldamage BIGINT, delamination TINYINT(1), plasticizerexudation TINYINT(1), recordinglayer BIGINT NOT NULL, recordingspeed BIGINT NOT NULL, cylindertype BIGINT NOT NULL, reflectivelayer BIGINT NOT NULL, datalayer BIGINT NOT NULL, opticaldisctype BIGINT NOT NULL, format BIGINT NOT NULL, recordingstandard BIGINT NOT NULL, publicationyear DATE NOT NULL, capacitylayers BIGINT NOT NULL, codec BIGINT NOT NULL, datarate BIGINT NOT NULL, sheddingsoftbinder TINYINT(1), formatversion BIGINT NOT NULL, oxide BIGINT NOT NULL, bindersystem TINYINT(1) NOT NULL, reelsize BIGINT NOT NULL, whiteresidue TINYINT(1), size TINYINT(1) NOT NULL, formattypedvideorecordingformat BIGINT NOT NULL, bitrate BIGINT, scanning BIGINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX format_type_type_idx (type), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE pressed45_r_p_m_disc (id BIGINT AUTO_INCREMENT, quantity BIGINT NOT NULL, generation BIGINT NOT NULL, year_recorded VARCHAR(255) NOT NULL, copies TINYINT(1), stock_brand VARCHAR(255), off_brand TINYINT(1), fungus TINYINT(1), other_contaminants TINYINT(1), duration BIGINT NOT NULL, duration_type VARCHAR(255), type VARCHAR(255), material BIGINT NOT NULL, oxidationcorrosion TINYINT(1) NOT NULL, pack_deformation BIGINT, noise_reduction TINYINT(1) NOT NULL, tape_type BIGINT NOT NULL, thin_tape TINYINT(1), slow_speed TINYINT(1), sound_field BIGINT NOT NULL, soft_binder_syndrome TINYINT(1), gauge BIGINT NOT NULL, color TINYINT(1) NOT NULL, colorfade TINYINT(1), soundtrackformat BIGINT, substrate BIGINT NOT NULL, strongodor TINYINT(1), vinegarodor TINYINT(1), adstriplevel BIGINT, shrinkage TINYINT(1), levelofshrinkage BIGINT, rust TINYINT(1), discoloration TINYINT(1), surfaceblisteringbubbling TINYINT(1), thintape TINYINT(1), 1993orearlier TINYINT(1), datagradetape TINYINT(1), longplay32k96k TINYINT(1), corrosionrustoxidation TINYINT(1), composition BIGINT, nonstandardbrand TINYINT(1), trackconfiguration BIGINT NOT NULL, tapethickness BIGINT, speed BIGINT NOT NULL, softbindersyndrome BIGINT, materialsbreakdown TINYINT(1), physicaldamage BIGINT, delamination TINYINT(1), plasticizerexudation TINYINT(1), recordinglayer BIGINT NOT NULL, recordingspeed BIGINT NOT NULL, cylindertype BIGINT NOT NULL, reflectivelayer BIGINT NOT NULL, datalayer BIGINT NOT NULL, opticaldisctype BIGINT NOT NULL, format BIGINT NOT NULL, recordingstandard BIGINT NOT NULL, publicationyear DATE NOT NULL, capacitylayers BIGINT NOT NULL, codec BIGINT NOT NULL, datarate BIGINT NOT NULL, sheddingsoftbinder TINYINT(1), formatversion BIGINT NOT NULL, oxide BIGINT NOT NULL, bindersystem TINYINT(1) NOT NULL, reelsize BIGINT NOT NULL, whiteresidue TINYINT(1), size TINYINT(1) NOT NULL, formattypedvideorecordingformat BIGINT NOT NULL, bitrate BIGINT, scanning BIGINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX format_type_type_idx (type), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE pressed78_r_p_m_disc (id BIGINT AUTO_INCREMENT, quantity BIGINT NOT NULL, generation BIGINT NOT NULL, year_recorded VARCHAR(255) NOT NULL, copies TINYINT(1), stock_brand VARCHAR(255), off_brand TINYINT(1), fungus TINYINT(1), other_contaminants TINYINT(1), duration BIGINT NOT NULL, duration_type VARCHAR(255), type VARCHAR(255), material BIGINT NOT NULL, oxidationcorrosion TINYINT(1) NOT NULL, pack_deformation BIGINT, noise_reduction TINYINT(1) NOT NULL, tape_type BIGINT NOT NULL, thin_tape TINYINT(1), slow_speed TINYINT(1), sound_field BIGINT NOT NULL, soft_binder_syndrome TINYINT(1), gauge BIGINT NOT NULL, color TINYINT(1) NOT NULL, colorfade TINYINT(1), soundtrackformat BIGINT, substrate BIGINT NOT NULL, strongodor TINYINT(1), vinegarodor TINYINT(1), adstriplevel BIGINT, shrinkage TINYINT(1), levelofshrinkage BIGINT, rust TINYINT(1), discoloration TINYINT(1), surfaceblisteringbubbling TINYINT(1), thintape TINYINT(1), 1993orearlier TINYINT(1), datagradetape TINYINT(1), longplay32k96k TINYINT(1), corrosionrustoxidation TINYINT(1), composition BIGINT, nonstandardbrand TINYINT(1), trackconfiguration BIGINT NOT NULL, tapethickness BIGINT, speed BIGINT NOT NULL, softbindersyndrome BIGINT, materialsbreakdown TINYINT(1), physicaldamage BIGINT, delamination TINYINT(1), plasticizerexudation TINYINT(1), recordinglayer BIGINT NOT NULL, recordingspeed BIGINT NOT NULL, cylindertype BIGINT NOT NULL, reflectivelayer BIGINT NOT NULL, datalayer BIGINT NOT NULL, opticaldisctype BIGINT NOT NULL, format BIGINT NOT NULL, recordingstandard BIGINT NOT NULL, publicationyear DATE NOT NULL, capacitylayers BIGINT NOT NULL, codec BIGINT NOT NULL, datarate BIGINT NOT NULL, sheddingsoftbinder TINYINT(1), formatversion BIGINT NOT NULL, oxide BIGINT NOT NULL, bindersystem TINYINT(1) NOT NULL, reelsize BIGINT NOT NULL, whiteresidue TINYINT(1), size TINYINT(1) NOT NULL, formattypedvideorecordingformat BIGINT NOT NULL, bitrate BIGINT, scanning BIGINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX format_type_type_idx (type), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE storage_location (id BIGINT AUTO_INCREMENT, name VARCHAR(255) NOT NULL, resident_structure_description text NOT NULL, env_rating BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE store (id BIGINT AUTO_INCREMENT, name VARCHAR(255) NOT NULL, inst_id VARCHAR(255) NOT NULL, notes text, creator_id BIGINT, last_editor_id BIGINT, type VARCHAR(255), resident_structure_description text, parent_node_id BIGINT, status VARCHAR(255), location VARCHAR(255), format_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX store_type_idx (type), INDEX creator_id_idx (creator_id), INDEX last_editor_id_idx (last_editor_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE unit_person (unit_id BIGINT, person_id BIGINT, PRIMARY KEY(unit_id, person_id)) ENGINE = INNODB;
CREATE TABLE unit_storage_location (unit_id BIGINT, storage_location_id BIGINT, PRIMARY KEY(unit_id, storage_location_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_forgot_password (id BIGINT AUTO_INCREMENT, user_id BIGINT NOT NULL, unique_key VARCHAR(255), expires_at DATETIME NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_group (id BIGINT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_group_permission (group_id BIGINT, permission_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(group_id, permission_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_permission (id BIGINT AUTO_INCREMENT, name VARCHAR(255) UNIQUE, description TEXT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_remember_key (id BIGINT AUTO_INCREMENT, user_id BIGINT, remember_key VARCHAR(32), ip_address VARCHAR(50), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user (id BIGINT AUTO_INCREMENT, first_name VARCHAR(255), last_name VARCHAR(255), email_address VARCHAR(255) NOT NULL UNIQUE, username VARCHAR(128) NOT NULL UNIQUE, algorithm VARCHAR(128) DEFAULT 'sha1' NOT NULL, salt VARCHAR(128), password VARCHAR(128), is_active TINYINT(1) DEFAULT '1', is_super_admin TINYINT(1) DEFAULT '0', last_login DATETIME, type VARCHAR(255), phone VARCHAR(255), role VARCHAR(255) NOT NULL, contact_info text, unit_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX is_active_idx_idx (is_active), INDEX sf_guard_user_type_idx (type), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_group (user_id BIGINT, group_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, group_id)) ENGINE = INNODB;
CREATE TABLE sf_guard_user_permission (user_id BIGINT, permission_id BIGINT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(user_id, permission_id)) ENGINE = INNODB;
ALTER TABLE store ADD CONSTRAINT store_last_editor_id_sf_guard_user_id FOREIGN KEY (last_editor_id) REFERENCES sf_guard_user(id);
ALTER TABLE store ADD CONSTRAINT store_format_id_format_type_id FOREIGN KEY (format_id) REFERENCES format_type(id);
ALTER TABLE store ADD CONSTRAINT store_creator_id_sf_guard_user_id FOREIGN KEY (creator_id) REFERENCES sf_guard_user(id);
ALTER TABLE collection_storage_location ADD CONSTRAINT cssi FOREIGN KEY (storage_location_id) REFERENCES storage_location(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE collection_storage_location ADD CONSTRAINT collection_storage_location_collection_id_store_id FOREIGN KEY (collection_id) REFERENCES store(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE evaluator_history ADD CONSTRAINT evaluator_history_evaluator_id_sf_guard_user_id FOREIGN KEY (evaluator_id) REFERENCES sf_guard_user(id);
ALTER TABLE evaluator_history ADD CONSTRAINT evaluator_history_asset_group_id_store_id FOREIGN KEY (asset_group_id) REFERENCES store(id);
ALTER TABLE evaluator_history_personnel ADD CONSTRAINT evaluator_history_personnel_person_id_sf_guard_user_id FOREIGN KEY (person_id) REFERENCES sf_guard_user(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE evaluator_history_personnel ADD CONSTRAINT eeei FOREIGN KEY (evaluator_history_id) REFERENCES evaluator_history(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE unit_person ADD CONSTRAINT unit_person_unit_id_store_id FOREIGN KEY (unit_id) REFERENCES store(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE unit_person ADD CONSTRAINT unit_person_person_id_sf_guard_user_id FOREIGN KEY (person_id) REFERENCES sf_guard_user(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE unit_storage_location ADD CONSTRAINT unit_storage_location_unit_id_store_id FOREIGN KEY (unit_id) REFERENCES store(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE unit_storage_location ADD CONSTRAINT unit_storage_location_storage_location_id_storage_location_id FOREIGN KEY (storage_location_id) REFERENCES storage_location(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE sf_guard_forgot_password ADD CONSTRAINT sf_guard_forgot_password_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_group_permission ADD CONSTRAINT sf_guard_group_permission_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_remember_key ADD CONSTRAINT sf_guard_remember_key_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_group ADD CONSTRAINT sf_guard_user_group_group_id_sf_guard_group_id FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_user_id_sf_guard_user_id FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE;
ALTER TABLE sf_guard_user_permission ADD CONSTRAINT sf_guard_user_permission_permission_id_sf_guard_permission_id FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE;
