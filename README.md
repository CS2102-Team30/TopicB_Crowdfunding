# Team 30 Topic B Crowdfunding

# How to set up
1. Install Bitnami Stack program
2. cd into ./Bitnami/wappstack-7.1.21-0/apache2/
3. git clone https://github.com/CS2102-Team30/TopicB_Crowdfunding.git htdocs

# Why tho?
-Because our website is hosted in ./Bitnami/wappstack-7.1.21-0/apache2/htdocs :-)

# If you forgot your phpadmin password
    (for Windows only, not sure about other OS)
1. cd into \Bitnami\wappstack-7.1.21-0\postgresql\data
2. open pg_hba.conf using any editor
3. Under 'method' column, change 'md5' to 'trust'
- You can also do the above if you want to skip the process of verifying db password
- Dont do this if there are any local users you can't trust: )
