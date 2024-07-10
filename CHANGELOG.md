# CHANGELOG.md

> To better understand what has been done in each commit, commit descriptions may be noted down.
> *Italic* text refers to classes.
> **Bolded** text refers to file names.
> ***Bolded, italic*** text refers to project directories.

## 10/7 by Jayson on test-branch-1 - Implemented Alpine.js and some CSS fixes

### Fixes

- Fixed an issue where **dropdowns.js** would not be found in several pages. This has been fixed by implementing Alpine.js into our project.
- Fixed an issue where labels in the uneditable information area of the profile page were unaffiliated with any form. The labels have been replaced with p with the same classes as the previous labels.
- Fixed an issue where note divs could not go narrower than 461.77 px and were able to extend beyond the main section on mobile devices. The minimum width has now been set to 320 px.

### Additions and removals

- Added a script to implement Alpine.js.
- Added Alpine.js image and an svg of our application logo into ***public/pictures***.
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

### To be implemented

- Accordion and tab sections for the about page.
- Will change the *flex-1* in the body section of the frameworks, software, and hardware used section of the about page to *flex-none*.



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

To be added.



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