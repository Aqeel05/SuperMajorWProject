# CHANGELOG.md

> To better understand what has been done in each commit, commit descriptions may be noted down.<br>
> *Italic* text refers to classes.<br>
> **Bolded** text refers to file names or directories.<br>
> Do or do not. There is no try.

## 28/7 by Jayson on test-branch-1 - Second cleanup after the branch merge

### Current issues

### Fixes

- Fixed an issue where accounts could not be created due to hashed passwords having too many characters in the password column, by allowing the password column to accept up to 100 characters.
- Fixed an issue where columns could not be sorted properly when logged in as a patient. This is due to the fact that some columns had the wrong sortTable indexes, causing the table to be sorted by the wrong column.
- Fixed an issue where staff could not delete bookings.
- Fixed an issue where the maximum note content length was 1 higher than the hard maximum (65,536), by setting the maximum length to 65,535.
- Fixed misleading help text for emails, where the minimum length was said to be 1 instead of the actual former minimum length of 2.
- Fixed some issues regarding the retrieval of pressure sessions and mistaking of HTTP sessions with pressure sessions.

### Additions and removals

- Added more minlength, maxlength, and required classes to text inputs for proper validation.
- Added more null coalescence functions.
- Added statuses for bookings. Addition implemented in migration file, validation implemented in BookingsController, fillable added in the Booking model, and select areas added in the edit page.
- Added WritePrecision::S in *InfluxDBService*.
- Removed *button* CSS in **dashboard.css**.
- Removed **SessionController** and **UserSessionSeeder**. DatabaseSeeder now seeds 1 pressure session for the test user.

### Modifications

- Changed the minimum email length from 2 to 6 characters.
- Changed the timestamp creators in migration files to datetime since the latter supports dates after 2038.
- Massively reworked the pressure session history page at the cost of the SweetAlert2 JavaScript feature.
- Replaced user_id with patient_id in BookingFactory because bookings do not have a user_id column.



## 24/7 by Jayson on test-branch-1 - First cleanup after the branch merge

### Current issues

- An unknown textarea appears on the top right while logged in.
- There are errors in the pressure session history index page and the modal component.

### Fixes

- Fixed a lot of issues in many pages where old code would reappear by replacing them with the new code.

### Additions and removals

- Added messages to SessionController regarding the confusion between the HTTP sessions and pressure sessions table.
- Added minimum and maximum length requirements to some inputs.
- Removed the old pressure session migration table.

### Modification

- Changed the referred font in the guest layout to Lexend.


## 24/7 by both on master and test-branch-1 - 6 commits total



## 23/7 by Jayson on test-branch-1 - Minor cleanup to prepare for integration

### Additions and removals

- Added **sortTable.js**, the JavaScript file whose code is used in the script sections of the account data and booking index pages.
- Removed the test area in the home index page and moved it to another file in the unused directory.

### Modifications

- Account and booking data tables are now sortable.
- Changed some calendar CSS and JavaScript.
- Fixed an issue in the bookings index page where the calendar would be too small at smaller screen sizes, by extending the calendar to *w-4/5* at said screen sizes.
- Fixed an issue with white spaces again (first mentioned in the 22/7 commit).
- Introduced some null coalescence sections in aforementioned data tables.
- Note titles can now span more than 1 line.
- Staff can now delete bookings.
- The account data table is no longer visible until the sm screen size breakpoint. A message has been added to reflect this.
- The booking index page no longer has the *space-y-4* class.
- The navigation menu that appears on small screens now has position: absolute, preventing it from pushing pages downward.
- Various inputs in the note create and edit pages are now required and/or have a max length.



## 22/7 by Jayson on test-branch-1 - Added bookings and fixed some CSS

### Additions and removals

- Added code to allow users to register as either a patient or staff.
    - In **app/Models/User.php**: Added *account_type_id* as a fillable.
    - In **database/factories/UserFactory.php**: Set the user factory to produce a user with an *account_type_id* of 1 by default.
    - In **app/Http/Requests/ProfileUpdateRequest.php**: Set rules for *account_type_id* validation.
    - In **register.blade.php** and **update-profile-information-form.blade.php**: Added radio buttons.
    - In **app/Http/Controllers/Auth/RegisteredUserController.php**: Added validations for *account_type_id*.
    - Note: A change to their patient/staff status previously could not be made unless they edit it in a MySQL accessing software.
- Added calendar JavaScript to be used in the bookings index page, and updated the Vite config to load that code upon accessing said page. This is because this code is loaded using Vite, requiring the config to be updated.
- Added code for a new feature: bookings. Patients are able to arrange bookings with our website and staff are able to assign themselves to bookings.
    - Added routes for booking pages.
    - Added the controller, model, factory, and migration file.
    - Allowed the DatabaseSeeder to use bookings.
    - Patients are able to create bookings, read their own bookings, edit all details of their own bookings except the staff assignment, and delete their own bookings.
    - Staff are able to read and edit all bookings, including assigning themselves to the booking. However, once they assign themselves, it cannot be undone.
- Removed routes towards the chatbot pages. The chatbot pages and controller are still present.    
- Removed the default value of 1 for *account_type_id* in the migration file that creates the users table.

### Modifications

- Changed the erroneous p sections in note pages' forms to label sections. This is for accessibility purposes.
- Changed the NoteFactory to produce a note with content "This is an example note" by default.
- Fixed an issue where unintended white spaces would appear in note pages' textarea sections by removing white spaces in the code itself.
- Replaced the margin in the note create form to a padding that extends from the top of the div containing the create button.
- The account data table page no longer mentions phpMyAdmin and instead mentions a generalisation of it - "database viewer".
- The Influx and Alpine sections in the About page have switched places now comes first due to Influx's significance in our entire project.
- The MQTT section is now just before the MySQL section - same reason.
- The sections in the about page can now be opened and closed.
- Removed constant capitalisation in the user registration and update pages.
- Uncommented the MAIL_FROM_ADDRESS and MAIL_FROM_NAME attributes from .env.example.



## 12/7 by Jayson on test-branch-1 - Added implementation for Voiceflow.

### Fixes

- Fixed an issue where the "Click here to send the verification email." link in the profile page would still have an indigo ring on focus. The indigo colour has been changed to green.
- Fixed grammatical issues in the about page.

### Additions and removals

- Added code that implements our Voiceflow chatbot to the app.blade.php file, allowing it to be accessible from all pages. At this point it is in its alpha phases.
- Added Voiceflow image.
- Removed the route leading to the chatbot show page.

### Modifications

- Changed dropdown transitions to opacity transitions that have a 200 ms duration.
- Changed the Register / Login section in the navigation bar to Login / Get started.
- The about page route is now /about instead of /home/about.

### To be implemented

- Integration to the cloud (AWS, to be done by all).
- Voiceflow section in the About page (to be done by Jayson).



## 10/7 by Jayson on test-branch-1 - Implemented Alpine.js and some CSS fixes

### Fixes

- Fixed an issue where **dropdowns.js** would not be found in several pages. This has been fixed by implementing Alpine.js into our project.
- Fixed an issue where labels in the uneditable information area of the profile page were unaffiliated with any form. The labels have been replaced with p with the same classes as the previous labels.
- Fixed an issue where note divs could not go narrower than 461.77 px and were able to extend beyond the main section on mobile devices. The minimum width has now been set to 320 px.

### Additions and removals

- Added a script to implement Alpine.js.
- Added Alpine.js image and an svg of our application logo into **public/pictures**.
- Added **target:** *_blank* to all href sections in the about page, which opens links in a new tab.
- Added the class *space-x-4* to the bottom flex element, and removed the class *ms-3* or *ms-4* to the bottom right buttons, in these pages:
    - **forgot-password.blade.php**
    - **login.blade.php**
    - **register.blade.php**
    - **verify-email.blade.php**
- Added the *focus:bg-gray-200* class to all white buttons (except secondary-button).
- Added the *items-center* class to the flex divs for buttons in the about and note index pages.
- Added **uneditable-information.blade.php** as a partial to the profile page.
- May remove **dropdowns.js** in the future.
- Removed *hover:shadow* transitions in divs located in the about and note index pages.
- Removed references to **dropdowns.js**.

### Modifications

- Changed a few margins to paddings.
- Changed **changelog.txt** to **CHANGELOG.md**.
- Changed h3 sections that contained medium-sized text in the about page to p.
- Changed the default text in **tailwind.config.js** from Figtree to Lexend.
- Changed the divs in the about page to flex.
- Changed the location of the register page links in the login and forget password pages to the bottom section.
- Changed the location of the "Click here to re-send the verification email." link in the profile page to the "Uneditable information" section; and replaced "re-send" with "send".
- Changed the nature of all dropdowns into Alpine.js dropdowns.

### Formerly to be implemented

- Accordion and tab sections for the about page.
- Would have changed the *flex-1* in the body section of the frameworks, software, and hardware used section of the about page to *flex-none*, but gave up on that idea.



## 7/7 by Jayson on test-branch-1 - Another CSS fix; chatbot preparation

### Fixes

- Fixed an issue where the *inline-flex items-center* div would appear in the HTML even if unauthenticated, by moving the auth and endauth blocks to cover the whole div.
- Fixed an issue where the ESP32 text in the About page would not be rendered as *text-gray-900*, by changing the erroneous *text-gray-90* to *text-gray-900*.
- Fixed an issue where the **dropdowns.js** file would not be found in the About or 403 pages, by setting the src in the app and errs layouts to include asset (double curved brackets).
- Fixed an issue where no error messages would show when creating a blank note or editing a note/title field to be invalid.
- Fixed an issue where the navbar would be overlapped by other page elements. The navbar has now been brought to z-index 10 using *z-10* to guarantee its placement above all other page elements.

### Additions and removals

- Added this file.
- Added MQTT image.
- Added the pressure_sessions migration file.
- Added data validation for the "title" attribute of all notes.
- Added a placeholder chatbot section into the chatbot index.
- Added help text to note creation and editing pages.
- The notes div and account table div are no longer hideable.
- Titles can now be added to notes in the creation page.

### Modifications

- Note View and Edit buttons have been positioned to the bottom with the creation of a flex box within each note div. Titles also only occupy 1 line.
- Updated the migrations files to be more up to date with the current database. They now add the pressure_sessions table.
- Updated the 403 error page layout.
- Updated the **DatabaseSeeder** to only seed 1 note.
- Updated user data validation.
- Reworked the divs containing the note contents to be flex layouts.
- In the note index page, *truncated* note titles to only occupy 1 line.
- In the note view page, changed the section containing the note contents from p to textarea.
- In the note edit page, the cancel button now redirects to the note view page.



## 5/7 by Aqeel on master - latest 5th July changes

### Additions and removals

- Added code that is necessary for Influx connections.
- More to be added.

### Modifications

- Improved upon the code in the analytics pages.
- More to be added.



## 4/7 by Jayson on test-branch-1 - CSS cleanup and optimisation

### Additions and removals

- Even less *font-sans* references.
- Removed **Postmark.svg** since we are not using it.

### Modifications

- Allowed the app to use UTC +8 rather than UTC +0 to align to our timezone.
- Standardised the margin, padding, and width of divs in most pages. The header sections now have a light green background.
- Separated the CSS classes in a few components into a few lines, with each line containing standard, hover, focus, or transition attributes, for easier readability.
- *toggleDeleteMenu()* becomes *toggleOpenableMenu()*. id *delete-menu* becomes *openable-menu*.
- Improved the look of dropdowns.
- Changed the font of the entire project, and lessened the font weight of headings.
- Moved **dropdowns.js** to a separate file.



## 3/7 by Jayson on test-branch-1 - Notes revamp; Account datatable addition; Differentiated login

### Additions and removals

- Added the account datatable page as well as differentiated login procedures.
- Added empty chatbot folders and files for a future commit.
- Removed most *font-sans* classes in most files that have this reference, except for valuable layout pages.

### Modifications

- Heavily revamped the Notes section to use more refined Tailwind CSS rather than the old CSS.



## 27/6 by Jayson on test-branch-1 - Added implementation for the Resend email delivery service.

### Fixes

- Fixed an issue where the header divs in the home directory's pages would overlap the navigation menu by removing the *"relative"* class from the divs.

### Additions and removals

- Added Postmark and Resend images.
- Added an "uneditable information" section to the profile page with no database connections.
- Composer now requires Resend.
- Added sample email service implementation in the **.env.example** file to closely reflect how it is done in the actual **.env** file.



## 26/6 by Jayson on test-branch-1 - Introduced custom font to more pages including auth pages, and improved buttons

### Additions and removals

- Added ESP32 image.
- Added help text for the register, login, forgot password, and email verification pages.
- Added *font-sans* references (which were later removed).

### Modifications

- Made buttons and textareas have a green ring on focus instead of indigo.



## 22/6 by Jayson on test-branch-1 - Implemented more Tailwind CSS rather than unbranded CSS in the index and about pages, and included more non-secret stuff in the .env.example file

### Additions and removals

- Added Laravel and Tailwind CSS images.
- Added a JavaScript section in ***layouts/app.blade.php*** to toggle dropdowns.
- Added MySQL database connection implementation in the **.env.example** file.

### Modifications

- Massively reworked the home directory's pages to use Tailwind CSS rather than my own CSS.



## 21/6 by Aqeel (rest of the code; he gave the code to me) and Jayson (second contributor) on test-branch-1 - Database integration commit on another branch

### Fixes

- Fixed an issue where the images in the about page would not be lined up properly by adding my custom div class, *"box"*, to the divs housing the images.

### Additions and removals

- A lot of valuable MQTT-related files that would not be touched on my end, but be touched on the other end (which is reflected in the 5/7 commit).

### Modifications

- Cleaned up the CSS in the home directory's pages.