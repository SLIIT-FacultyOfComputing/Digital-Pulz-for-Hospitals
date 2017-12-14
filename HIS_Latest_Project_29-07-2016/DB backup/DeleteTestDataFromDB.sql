INSERT INTO `pcu_admition` (`admition_id`, `patient_id`, `admition_date`, `status`, `created_by`, `created_time`, `modified_by`, `modified_time`) 
VALUES ('2', '7', '2017-01-10', '1', '1', '2017-01-10 00:00:00', '1', '2017-01-18 00:00:00');

INSERT INTO `ward_admission` (`bht_no`, `patient_id`, `bed_no`, `ward_no`, `daily_no`, `monthly_no`, `yearly_no`, `doctor_id`, `admit_date_time`, `patient_complain`, `previous_history`, `discharge_type`, `remark`, `admission_unit`, `created_user`, `created_date_time`, `last_updated_user`, `last_updated_date_time`, `status`, `sign`, `outcomes`, `dischargediagnosis`, `referredto`, `discharge_immr`, `icd_code`) VALUES ('99999', '7', '8', 'Ward-01', '3', '26', '34', '1', '2015-07-16 07:16:00', 'Test', 'Test', 'none', '', 'OPD', '5', '2015-09-03 07:16:00', '5', '2015-09-03 07:16:00', 'Confirmed', 'C:\\xampp\\htdocs\\Inward\\css\\img\\201534-040915084913.jpg', '', '', '', '', '');

UPDATE `ward_nursenote` SET `bht_no` = '201419' WHERE `ward_nursenote`.`note_id` = 2;
UPDATE `ward_liquidbalancechart` SET `bht_no` = '201419' WHERE `ward_liquidbalancechart`.`row_no` = 3;

#Laboratory

DELETE FROM `lab_mainresults` WHERE `ftest_request_id` = 16;
DELETE FROM `lab_labdepartments` WHERE `lab_dept_name` = 'TestDeptName';
DELETE FROM `lab_laboratories` WHERE `lab_name` = 'sam';
DELETE FROM `lab_types` WHERE `lab_type_name` = "TestLabType";
DELETE FROM `lab_parenttestfields` WHERE `parent_field_name` = 'CEDL';
DELETE FROM `lab_reports` ORDER BY `report_id` DESC LIMIT 1;
DELETE FROM `lab_samplecentertypes` WHERE `sample_center_type_name` = 'TestSampleCenterType';
DELETE FROM `lab_testcategory` WHERE `category_name` = 'deleteNew' OR `category_name` = 'delete';
DELETE FROM `lab_specimenretentiontype` WHERE `retention_type_name` = 'delete3';
DELETE FROM `lab_specimentype` WHERE `specimen_type_name` = 'delete2';
DELETE FROM `lab_specimen` WHERE `remarks` ='TestRemarks';
DELETE FROM `lab_subtestfields` WHERE `sub_test_field_name` = 'test';
DELETE FROM `lab_testcategory` WHERE `category_id_name` ='delete';
DELETE FROM `lab_testsubcategory` WHERE `sub_category_name` = 'deleteNew2' or `sub_category_name` = 'delete1';
DELETE FROM `lab_samplecenters` WHERE `sample_center_name` ='Tester-SampleCollectionCenter';
DELETE FROM `lab_labtestrequest` WHERE `comment` ='TestComment';
DELETE FROM `lab_laboratories` WHERE `lab_incharge` = 'Tester';
DELETE FROM `lab_labdepartments` WHERE `lab_dept_name` = 'Toxicology';
DELETE FROM `lab_specimen` WHERE `remarks` = 'TestRemarks';
DELETE FROM `lab_testnames`  WHERE `test_name` = "Sample_Test";
DELETE FROM `lab_subfieldresults` WHERE `fmresult_id` = 1 AND `fparentf_id` = 1 AND `fsubf_id` = 1;
DELETE FROM `lab_opdlabrequest` WHERE `opd_lab_test_request_id` = 34 AND `patient_visit_id` = 7;
DELETE FROM `lab_pculabrequest` ORDER BY `pcu_lab_test_request_id` DESC LIMIT 1;

#OPD

DELETE FROM `opd_patient_allergy` WHERE `allergy_remarks` = 'testRemarkUpdated';
DELETE FROM `opd_patient_examination` WHERE `examination_weight` = 600 AND `examination_bmi` = 150 AND `examination_sysBP` = 400 AND `examination_diastBP` = 400;
DELETE FROM `opd_prescription_item` WHERE `prescription_item_frequency` = 'Once a Day' AND `prescription_item_dosage` = 5 AND `prescription_item_period` = 'for 1 day';
DELETE FROM `opd_patient_attachment` WHERE `attachment_type` = 'opdfile' AND `attachment_description` = 'opdnote' AND `attachment_name`= 'opdnew';
DELETE FROM `opd_patient_queue` WHERE `queue_remarks` = 'opdqueue';
DELETE FROM `opd_patient_record` WHERE `record_text` = 'updaterecordTest' OR `record_text` = 'recordTest';
DELETE FROM `opd_patient_visit` WHERE `visit_complaint` = 'TEST';
DELETE FROM `opd_questionnaire` WHERE `questionnaire_remarks` = 'TestRemark';
DELETE FROM `opd_questionanswerset` ORDER BY `answer_setid` DESC LIMIT 1;
DELETE FROM `opd_questionanswer` ORDER BY `answer_id` DESC LIMIT 1;
DELETE FROM `opd_question` WHERE `question_text` ='Test';

#Pharmacy

DELETE FROM `pharm_drugssupplied` WHERE `drug_supplied_name` ='TestDrug';
DELETE FROM `pharm_drug` WHERE `drug_name` = 'TestDrug';
DELETE FROM `pharm_frequency` WHERE `frequency` = "Test times a Day" OR `frequency` = "Test times a Day Updated";
DELETE FROM `pharm_drugrequests` ORDER BY `request_drug_id` DESC LIMIT 1;
DELETE FROM `pharm_email` WHERE `email_content`="Test Mail is Sent";
DELETE FROM `pharm_dispensedrug` WHERE `dispense_drugs_name` = 'TestDrug';
UPDATE `pharm_dosage` SET `dosage`=1,`dosage_status`=0 WHERE `dosage_id`=1;
#DELETE FROM `opd_prescription` ORDER BY `prescription_id` DESC LIMIT 1;
DELETE FROM `pharm_asst_stock` WHERE `drug_name` ='TestDrug';

#Inward

DELETE FROM `ward_admission_request` WHERE `ward_admission_request`.`remark` = "TestCase";
DELETE FROM `ward_externaltransfer` WHERE `ward_externaltransfer`.`transfer_from` = "TestCase";
DELETE FROM `ward_internaltransfer` WHERE `ward_internaltransfer`.`reson_for_trasnsfer` = "TestCase";
DELETE FROM `ward_wards` WHERE `ward_wards`.`ward_no` = "Ward-Test";
DELETE FROM `ward_diabeticchart` WHERE `ward_diabeticchart`.`bht_no` = "99999";
DELETE FROM `ward_prescriptionitem` WHERE `ward_prescriptionitem`.`status` = "testingcase";
DELETE FROM `ward_prescription_terms` WHERE `ward_prescription_terms`.`bht_no` = "99999";
DELETE FROM `ward_nursenote` WHERE `ward_nursenote`.`note` = "testing";
DELETE FROM `ward_admission` WHERE `bht_no` = "99999";
DELETE FROM `ward_treatment` WHERE `bht_no`= "99999";
SELECT * FROM `ward_liquidbalancechart` WHERE `bht_no` = "99999";
DELETE FROM `ward_temp_prescribe` WHERE `frequency` = "test" or `frequency` = "TestUpdate";


