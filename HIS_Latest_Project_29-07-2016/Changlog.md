[1.6.6]  2017-06-30
#Bug Fixes
1. Resolve a small issue of drug batch update not working.
2. Resolve an issue of batch manufacture date and expire date not properly getting added to the database.
3. Fixed a major issue of ‘new drug addition through an excel file (.csv)‘ not working

[1.6.5]  2017-06-30
#Features
1. Added a dropdown near ‘auto assign patient’ button to select to which ‘visitType’ needs to be assigned.
2. Added a warning when the user tries to auto-assign a patient to a visitType with no doctors.
3. Created a delete function to delete batches
4. Added an alert to show that the drug list was successfully added or not and disable the submit button till a file is been added to upload.

[1.5.4]  2017-06-23
#Features
1. Changed the hold queue method to assign status to ‘hrAttendance’ table, and only retrieve the doctor who are in that table.
2. Changed the redirect queue method to assign status to ‘hrattendance’ table
3. Further changed the redirect and hold queue method to check the database value instead of the static value created in the API.
4. Add a new feature to automatically assign patients to doctor’s queue.
5. Relocated the visit type change to individual doctors
7. Create an automatic database backup project using Shell Script and task scheduling
8. His.sliit.lk/OPD is updated with latest frontend, API and database.


[1.4.4]  2017-06-16
#Bug Fixes
1. Fixed an issue where admission is not added even though it is shown in front-end as added. (Inward module)
2. Fixed few bugs in android application (Inward Module)
3. Fixed some redirection errors (Inward Module)
4. Resolved an issue where data is not sent to create the pharmacy bill (Pharmacy Module)
5. Resolved a nested transaction issue in prescribing drug which result in drug quantity becoming negative for drugs entered after the 1 st one.
6. Resolved all remaining errors with JavaScript libraries shown in the browser console of pharmacy and OPD frontends.

[1.4.3]  2017-06-16
#Features
1. Change the layout and format of the Pharmacy Bill (Pharmacy Module)
2. Added a copyright comment to all view, controllers, models &amp; js file in OPD, Laboratory and Pharmacy frontend projects.
3. Change the layout and format of the Pharmacy Bill (Pharmacy Module)

[1.3.3]   2017-06-09
#Bug Fixes
1. Resolved an issue in mapping patient to patient_injection table in database
2. Resolved and mapped OPD_treatment to visit

[1.3.2]  2017-06-09
#Features
1. Treatment features such as API methods and new treatment window for doctors are added.
	1.1 Added a table to show treatments given for that visit
	1.2 ‘Treatment Room’ added to Nurse to update treatments of patients
2. Injection features such as API methods and new injection window for doctors are added.
	2.1 Added a table to show treatments Injections for that visit
	2.2 ‘Injection Room’ added to Nurse to update treatments of patients 
3. Latest versions of OPD and Pharmacy are now hosted in his.sliit.lk

[1.2.2]  2017-06-02
#Features
1. Changed the printed-out pharmacy (drugs that are not in hospital) prescription to a more descriptive format.
2. Changing the prescription from pending to new automation.
3. New tables added to the database
4. New API methods implemented (Village DAO and service,Complaint DAO and service)
5. Patient registration UI changed to have ‘address1’, ‘address2’ and ‘village’ in the place of ‘address’.
6. Village auto-completion feature implemented
7. Complaint/Injury concatenated auto-completion feature implemented (uses ICPC-2 data)

[1.1.2]   2017-05-26
#Bug Fixes
1. Fixed an issue in the host OPD module where the doctor could not add a lab order and the lab order dates were not shown properly.
2. Resolved an issue where the out prescription can be printed but not added into the database prescription item table
3. Change the UI of the add prescription window.
4. Fixed an issue where selecting the liquid drug will not filter the dosage to liquids.
5. Resolved an issue where prescription with only out pharmacy drug are shown in the list.
6. Fixed an issue where out prescription showing in the drug dispense view and bill. 
7. Resolve the issue of bill not been printed due to conflict between in and out pharmacies.
8. Resolve a major issue where, when dispensing a drug the qty will get reduces from the main stock and the amount in the main stock is copied to assistant stock.
9. Fixed an issue were success message was not shown when examination was successfully add, also added BMI column in to the examination table in the visit view.
10. Fixed issue of patient could not be search with HIN number,patient not getting admitted and showing details of patient once admission was successful. 

3. Fixed an issue where side navigation bar will still show links for adding prescriptions,exam and lab order for old visits
4. Updated datatable js, css to latest version to resolve a pagination error in patient_overview window’s tables
5. Resolved an issue of Year month date not shown properly on patient update and dob not getting updated.

[1.1.1]  2017-05-26
#Features
1. Created the Web cam Image taking feature
2. Modified the Pharmacy module’s frequency table to hold the value for the respective medical abbreviation.
3. Add the frequently used medical abbreviation for frequency into the database.
4.Created an Individual drug addition method into the pharmacy module and created new pop view to add frequencies
5. Hosted the lasted front-ends of OPD and Pharmacy Modules and also updated the hosted API project and the Database.
6. Add liquid values into dosage and define the quantity if selected
7. Put stock quantity next to the drug name in the prescription addition view
8. Frequency type (s.o.s = if necessary) field if selected needs to give the dosage
	8.1 Added a pop model for prescription view 
	8.2 Changed the dropdown listed to show the abbreviation and instead of the value for the frequencies
9. comparing to the HHIMS version 2.1 solution with our current system following changes were made
	9.1 Added Age to patient registration view and created methods to automatically calculate the date of birth or vice versa.
	9.2 Created a method to show age in patient details shown in different views.
	9.3 Added some quick fill button to examination view.
	9.4 Added general patient details onto “add lab orders” view and “add examination view”
	9.5 Researching on HL7 and SNOMED
	9.6 Created the Proposal for the national planning to deploy the system to a government hospital.