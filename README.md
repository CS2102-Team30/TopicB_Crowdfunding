# Team 30 Topic B Crowdfunding

# Dependencies
+ Bitnami WAPP (PostgreSQL version)
+ PG Admin 4 (Database editor)

# How to set up
+ Website
    1. Install Bitnami Stack program
    2. cd into ```/Bitnami/wappstack-7.1.21-0/apache2/``` (wherever you installed WAPP at)
    3. ```git clone https://github.com/CS2102-Team30/TopicB_Crowdfunding.git htdocs```
+ Database
    1. While installing WAPP, it will ask for a password for the DB. Use ```test``` as the password.
    2. Using PG Admin 4, log in to the database using ```test``` as the password.
    3. Set up a new database called ```project1```
    4. Set up the tables using ```/SQL/schema.sql```

# If you forgot your phpadmin password
    (for Windows only, not sure about other OS)
1. cd into \Bitnami\wappstack-7.1.21-0\postgresql\data
2. open pg_hba.conf using any editor
3. Under 'method' column, change 'md5' to 'trust'
- You can also do the above if you want to skip the process of verifying db password
- Dont do this if there are any local users you can't trust: )
# Setting up Test Data
1. cd into .\SQL
2. Run the following in order
3. Run cleanDatabase.sql, schema.sql, users.sql, projects.sql, invest.sql, updateProjectFunding.sql, funding_trigger.sql
   Alternatively, you can run ultimate.sql, funding_trigger.sql to load the same set of test data.