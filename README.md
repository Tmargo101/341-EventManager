# EventManager
An event management application written in PHP.

Base requirements satisfy ISTE-341 Project 1 - Semester 2195.

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
