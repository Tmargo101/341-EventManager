# EventManager
An event management application written in PHP.

  Application can manage Events & Sessions, the the Venues they are hosted in, and Attendees registering for Events and Sessions.

Base requirements satisfy ISTE-341 Project 1 - Semester 2195.

## About
### User Roles:
#### Admin:
* View all Users, Venues, Events, and Sessions.
* Create, Edit, and Delete all other users.
* Create, Edit, and Delete all Venues, Events, and Sessions.
* Register or Unregister for Events and Sessions.

#### Manager:
* View all Events & Sessions.
* Create Events & Sessions which they will manage.
* Edit, and Delete Events and Sessions which they manage.
* View all Users who are currently signed up for Events or Sessions which they manage.
* Register or Unregister for Events and Sessions.

#### Attendee:
* View all Events & Sessions.
* Register or Unregister for Events and Sessions.


## Installation

### Prerequisites

1. LAMP server
2. Ability to create new MySQL user

### Instructions

1. Create a directory on your server where the application will live.  Clone the repository into this directory.

2. Import the blank database into your MySQL instance.
   1. Login to your MySQL database
      1. You must login with a user who has permissions to create other users and set user permissions
   2. Import the blank database into your MySQL instance.  
   3. Create new MySQL user.  Name it whatever you want.
   4. Give this new MySQL user the permissions to read/write to the "EventManager" database you just imported.


3. Enter CONSTANTS (Database credentials, Application name, Application Base URL).
