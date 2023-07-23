# specbee-assignment

Story: As a user, I should be able to see the Site location and the current time for the location.

# Implementation details:
Add an ADMIN CONFIGURATION form which will take the following inputs:
Country - text field
City - text field
Timezone - select list
Options in the select list
America/Chicago
America/New_York
Asia/Tokyo
Asia/Dubai
Asia/Kolkata
Europe/Amsterdam
Europe/Oslo
Europe/London

Create a service that will return the current time based on the time zone selection in the above form. Time should be in the format 25th Oct 2019 - 10:30 PM
Add a Plugin block which will render the Location from the configuration set in the ACF and the current time calling the service in the previous step. Pass the variables to a template to be rendered.

# Acceptance Criteria
<li> Since this block will be placed on all the pages, caching needs to be enabled on the block. </li>
<li>However, the time must be updated without a cache rebuild.</li>
<li> Any service calls should be done using Dependency Injection. Any direct calls to services are not allowed.</li>
<li> Your code must follow Drupal coding standards and DrupalPractice code standards.</li>
<li> Once done, please share the Github URL of the module.  If you don't have a Github profile please create one</li>
