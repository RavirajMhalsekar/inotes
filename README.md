
# Notes taking webiste

website allows users to create notes on the site. All the CRUD operation are performed in the website.

### features:

- Creating new notes.
- Updating the notes.
- Deleting the notes.
- Displaying all the notes on the webiste. 
- Manage the information in MYSQL database.


## Deployment

To deploy this project run

```bash
  clone the project
  install/start xampp
  start Apache and mysql
  start Apache and mysql
  run the localhost
```


## create database table

create database "notes" and run the following sql.

```bash
  CREATE TABLE `notes`.`notesdata` (
     `Sno` INT NOT NULL AUTO_INCREMENT ,  
     `title` VARCHAR(50) NOT NULL ,  
     `description` TEXT NOT NULL ,  
     `tstamp` DATE NOT NULL DEFAULT CURRENT_TIMESTAMP ,
     PRIMARY KEY  (`Sno`)
    );
```