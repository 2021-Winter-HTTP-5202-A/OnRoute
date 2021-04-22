# HTTP 5202 PHP Project: onRoute

## By: The < WebDevs >

---

<!-- ## Our Database Design -->

<!-- ![Database Design]()https://github.com/2021-Winter-HTTP-5202-A/OnRoute/blob/main/images/database_design/database_design.png -->

## Features

#### Nai-Hsien: accommodations.php, hotelDetails.php, hotelBooking.php, models/Hotel.php

##### Feature description (Project phase 1c)
- [X] 1. Accommodation Booking: Search</br>
   Search database for accommodations based off of **_location, check in/out dates, and number of guests_**.
- [X] 2. Accommodation Booking: Book after Search</br>
   Based on search results, users can select an accommodation and book it.
- [X] 3. Accommodation Booking: Confirmation/Details</br>
   After a booking is complete, the page will display accommodation details ~~**_and  confirmation will be sent to the user’s email_**~~
##### Improvement in progress:
  - [ ] Book a hotel with a user id (logged in)
  - [ ] Better CSS
  - [ ] Connecting to other features
  - [ ] composer, namespace, and class
##### Deployment URL
https://nhcto.ca/onRoute/accommodations.php
##### Test credentials
There are only limiting data in the database now. To test the functionality, please select a city from the following list, with only 2 or 4 guests.
###### List of cities in the database:
Beijing, Buenos Aires, Cairo, Calcutta, Chongqing, Delhi, Dhaka, Guangzhou, Istanbul, Karachi, Kinshasa, Lagos, Lahore, Los Angeles, Manila, Mexico City

---

#### Will Midgette: flightNumberSearch.php and flightInfo.php

- Feature allows a user to enter their flight number to check the details of their flight
- Validation on flightNumberSearch.php tells user if they have not entered a flight number, or if the database could not find a flight from the flight number they entered
- If the database can find a flight with the entered flight number, it stores it as a session variable and redirects the user to the flightInfo.php page

---

#### Alexis Arevalo: vehicles.php and vehicleSelection.php

- Displaying all the available vehicles in the database, and the user can select a vehicle by clicking on it.
- When the user selects a vehicle, they are redirected to (vehicleSlection.php) a vehicle information page which is retrieved by the stored vehicle 'id'.
- All inputs made to vehicle search form are validated against empty fields. - Working on Sanitizing input fields against malicious code injections.
- User is able to search the database for vehicles based off of pick-up locations, pick-up dates, and return dates.

---

#### Daniel Guinto: index.php, flights.php, flightBooking.php, deleteFlightBooking.php myaccount.php

- Main search feature that allows users to search the flights table based off of airports, dates, airlines, etc.
- Validation checks if user left field empty, or if search input does not have any results
- Successful results will display a table with all the values matching the search result
- Flights that have passed will display a "Book Unavailable" notice
- Flights that are in the future will display a "Book" button. If the user clicks the button, the data from the flight they selected will be saved and they will be carried over to the flightBooking.php page. Their selected flight will appear on this page, and they will be prompted review their flight details before confirming. Once they click the button, a flightBooking row will be added to the flightBooking table in the dB. Meals and seat selections will be able to be added later.
- Only logged in users can go through the booking process. If they are not logged in, they will be redirected to the login page
- When user is logged in, they can view their account information as well as any trip details associated with their account on their MyAccount page. The can also cancel any bookings they have, as long as the date for the booking has not passed (deletes row from DB)

---

#### Mohamed Sakr: login.php, flightOptions.php and models/User.php

- Login and registration features
- Set up phpmailer
- 'Forgot your password?', password and email changing which rely on the phpmailer
- User model to handle all user related data
- Customer service page now works with phpmailer
