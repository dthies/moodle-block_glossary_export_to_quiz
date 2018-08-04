We hope that this plugin works in Moodle branches 2.8 to 3.5
--------------------
Testing instructions
--------------------
You can download Glossary entries from https://moodle.net/mod/data/view.php?id=24
You should be able to install the plugins without causing errors
You should be able to export Glossary entries into Moodle questions in an XML file
Currently, this has been tested to be OK for Moodle branches:
* 2.8.12 on 04 Sep 2018. Worked OK even when exporting RANDOM entries.
* 3.5 on 04 Sept 2018. BUT sometimes (not always) it produces an ERROR if trying to export RANDOM entries:

Error reading from database
More information about this error
Debug info: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '-1' at line 1
SELECT * FROM mdl_glossary_entries AS ge WHERE ge.glossaryid = 1 AND ge.approved = 1 LIMIT 88 OFFSET -1
[array (
)]
Error code: dmlreadexception
Stack trace:
    line 486 of \lib\dml\moodle_database.php: dml_read_exception thrown
    line 1245 of \lib\dml\mysqli_native_moodle_database.php: call to moodle_database->query_end()
    line 116 of \blocks\glossary_export_to_quiz\exportfile_to_quiz.php: call to mysqli_native_moodle_database->get_records_sql()
...
*******************************************************
Current ERRORS reported by CODE CHECKER on 04 Sept 2018
*******************************************************
blocks\glossary_export_to_quiz\block_glossary_export_to_quiz.php
    #18: ····function·init()·{
    Visibility must be declared on method "init"
    #24: ····function·specialization()·{
    Visibility must be declared on method "specialization"
    #32: ····function·instance_allow_multiple()·{
    Visibility must be declared on method "instance_allow_multiple"
    #37: ····function·get_content()·{
    Visibility must be declared on method "get_content"

blocks\glossary_export_to_quiz\exportfile_to_quiz.php
    #24: ········global·$SESSION,·$DB;
    Expected MOODLE_INTERNAL check or config.php inclusion. Change in global state detected.
    
    
-------------------------------------------
How to install on a moodle 2.0 or 2.1 site.
-------------------------------------------
If you downloaded this zip archive from the new moodle.org plugins page
1.- Unzip the zip archive to your local computer.
2.- This will give you a folder named "glossary_export_to_quiz".
3.- GO TO STEP 4 below
---
If you downloaded this zip archive from GitHub
1.- Unzip the zip archive you downloaded from github to your local computer.
2.- This will give you a folder named something like "moodle-block_glossary_export_to_quiz_xxxx". 
    The end of the name may vary.
3.- ***Rename*** that folder to "glossary_export_to_quiz".
---
4.- Upload the "glossary_export_to_quiz" folder to your moodle/blocks/ folder.
5.- Visit your Admin/Notifications page so that the block gets installed. 
    This does not create any tables in your moodle database, just a version reference.

--------------------------------------------------------------
HOW TO USE block Export Glossary to Quiz for Moodle
--------------------------------------------------------------

A. Export from Glossary to moodle quiz XML file
***********************************************

   1. Go into Edit mode and click on the Configuration icon to configure the Export_Glossary_to_Quiz block.

   2. Use the dropdown list to select the glossary that you want to use to export its entries to the quiz questions bank. 
   If that glossary contains categories, you can select only one category to export its entries. 
   To cancel your choice or to reset the block, simply leave the dropdown list on the Choose... position. 

   3. Maximum number of entries to export. Leave empty to export all entries from selected Glossary or Category. 
   This option can be useful for exporting a limited number of entries from very large glossaries.
 
   4. Glossary entries can be exported to the Quiz Questions bank either as multiple choice or short answer questions.
Multiple choice questions will consist of the following elements:
    * question text = glossary entry definition
    * correct answer = glossary entry concept
    * distracters = 3 glossary entry concepts randomly selected from the glossary (or glossary category) that you have selected.
You have a choice of 4 types of numbering for the exported multiple choice questions:
* a., b., c. (the default numbering type)
* A., B., C., D.
* 1., 2., 3.
* no numbering

Short answer questions
 * Case insensitive. Student responses will be accepted as correct regardless of the original glossary entry concept case
    (uppercase or lowercase).
          o Example: original entry "Moodle". Accepted correct responses: "Moodle", "moodle".
 * Case sensitive. Student responses will be only be accepted as correct it the case of the original glossary entry concept is used.
          o Example: original entry "Moodle". Accepted correct response: "Moodle".

   5. When done, click OK.

   6. You are back in the course homepage, but now the block displays the settings you have selected.

   7. Click on the [Export n entries] link.

   8. Now you are on page Your course -> Glossaries -> (e.g.) Demo -> Glossary -> Export entries to Quiz (XML)

   9. Click on the Export entries to file button.

  10. At the prompt, save file to your computer. Its name is e.g. Demo_Glossary.xml.

  11. Go back to the course's homepage. You see that the the Export Glossary to Quiz block has been reset.


B. Import to the quiz questions bank
************************************

   1. Turn editing on

   2. In Administration block, click Questions

   3. On the Edit questions page, Click the Import tab

   4. Set these settings:
      File format : Moodle XML format
      General
      Category Default
      Get category from file (check it)
      Import from file upload...

   5. Go to the file you saved to your computer in step A 10 (Demo_Glossary.xml. and click Upload this file button.

   6. If all goes well, the imported questions should get displayed on the next screen.

   7. Click Continue.

   8. On the next page, the Question bank displays the new category name (formed on the name of the exported Glossary, 
   plus the name of its category if you selected one of the glossary's categories) 
   and of course all the questions that were imported (of the SHORTANSWER type).

   9. You can use the SHORTANSWER or the MULTICHOICE questions in a quiz.

  10. You can use the SHORTANSWER questions to create one or more Random Short-Answer MATCHING questions.
  Note.- At the time of writing, the Random Short-Answer MATCHING question type is working in Moodle 2.0 
  but not working in Moodle 2.1.
  
-----------
ONLINE HELP
-----------
Online help is available when editing the block.   

Enjoy!
--------------------------
