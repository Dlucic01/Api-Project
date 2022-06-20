
<h3>Directory Structure</h3>

Core directory holds all core files such as:

<p>config/SQLConnection.php - holds information for mysql username and password,</p>
<p>config/config.php - holds database name</p>
<p>bin - used for uploading fake Meals, Categories, Tags, Ingredients and for adding joins</p>


src directory contains Model and Controller

<hr>
<br>

<h3>Basic Usage</h3>

<p>In config/SQLConnection.php please fulfill mysql username and password</p>
<p>Database name can be changed in config/config.php"</p>
<hr>

<p>To upload a new fake Meal:</p>

        php bin/UploadMeals.php
   
<br>


<p>To upload a new Tag or Ingredients</p>

        php bin/UploadTags.php or bin/UploadIngredients.php
   <br>

   
<p>To join a Meal with a Category:</p>

        php UpdateMeals.php category [meal id] [category id]

   <br>

<p>To update Meal status:</p>

        php UpdateMeals.php status [0=created, 1=modified, 2=deleted] [meal id]
<br>

   
<p>To join meal with a tag:</p>

        php join.php tags [meal id] [tag id]


   <br>

<p>To join meal with an ingredient:</p>

        php join.php ingredients [meal id] [ingredient id]
        

<hr>
<br>

