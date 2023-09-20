# The Database

## Description

The database for this project has been substaintially pruned since it was obtained by our current group (f22). Although not all documentation survived the merge from Blackboard to Brightspace, we have been able to figure out some of the functions of the tables which I will go into detail.

### Traffic Tables

*cam_enter*
: Amount of people that entered library sorted by time

*cam_exit*
: Amount of people that left library sorted by time

*FinalUserTable*
: This simply contains the username and password for the administrator accounts for the traffic website

*mock_data*
: This is dummy data used for the traffic team

*traffic_all_time*
: This table was not given data when we recieved it

*traffic_annual*
: This table holds how many people entered the library in a given year

*traffic_annual_exited*
: This table holds how many people exited the library in a given year

*traffic_Cam_Data*
: The author of this document is unsure of what this table holds as he is not part of the traffic team

*traffic_daily*
: This table holds how many people entered the library in a given day

*traffic_daily_exited*
: This table holds how many people exited the library in a given day

*traffic_monthly*
: This table holds how many people entered the library in a given month

*traffic_monthly_exited*
: This table holds how many people exited the library in a given month

*traffic_weekly*
: This table holds how many people entered the library in a given week

*traffic_weekly_exited*
: This table holds how many people exited the library in a given week

### All Other Tables (Clara and Website)

*book_locations*
: Defines what range of book call numbers belongs to which shelf. Determines if a book is misplaced if found on shelf 1-77 (floor-shelfNumber)

*book_location_status*
: This table is referanced in the code, but is not currently used. It likely isn't necessary.

*feed_back*
: This table is referanced in the code, but is not currently used. It appears to define shelves and their book ranges by Subject, but this was likely unsuccessful. It likely isn't necessary.

*misplaced_books*
: This table is necessary and holds the entires of a misplaced book (as determined by the Clara's compare locations function). It is also grabbed by the website and use to display the visual map of shelves with misplaced books.

*shelf_locations*
: This table is necessary for creating the visual map of shelf svg's on the website under the 'Locate a Book' and 'Misplaced' pages.

*structure_locations*
: This table is also necessary, but not currently fully understood.

*subjects*
: This table does not seem necessary, however was referanced in the code.

*users*
: This table simply holds the administrator login information for the Clara website. It encrypts the passwords, so you won't be able to tell the passwords by looking at it. A testable usernamed and password is 'a' 'a'.
