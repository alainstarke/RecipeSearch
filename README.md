# RecipeSearch
Website materials of the RecipeSearch prototype, used in the paper titled 'Nudging Healthy Choices in Food Search through Visual Attractiveness' by Alain Starke, Martijn Willemsen, and Christoph Trattner. It it a search functionality that retrieves recipes using Lucene Zend technology with autocompletion. It was part of a paper currently under review at Frontiers in AI.

Save all of the code in a folder called Food in order to run it locally. To start the study as it was programmed, got to: http://localhost/Food/Informedconsent.php

The search prototype has a lot of files that are relevant If you just test-run the application, you can see the URL changing. This is also the order of the files that are being used:
-	Informedconsent.php
-	Intro.php
-	Index1.php
-	SurveyC1.php
-	Index2.php
-	SurveyC2.php]
-	Index3.php
-	SurveyC3.php
-	Index4.php
-	SurveyC4.php
-	Thanks.html
Other files that are relevant and you should change at some point are: 
-	Visual_data.csv: this is the main data file that contains the recipes of the study. It contains a number of parameters: the rating of a recipe, its healthiness (by means of the FSA score), a location of its photo that is shown in the search prototype (which is also stored in the project folder) and its name.
-	The queries: QueryBase, QueryRanking, QueryVisual, QueryVisualRanking. As you might have noticed, there are four search screens in this experiment. These query files each have different conditions that determine what images are shown in the list (pretty ones for healthy foods or ugle ones; queryvisual), the order of the list (ranked on popularity (querybase) or on health (queryranking), or both (queryvisualranking). The order in which these queries are activated is randomized in Intro.php!
-	Save.php: this helps to store the responses in the study correctly (in the database)
- The folder imageselection stores the images used in the study: both the adapted and the original ones.
-	mlwebdb.inc.php: this file establishes the database connection. In here, you need to indicate the username for your server, the password, the database name, etc. etc.
- Other folders: ‘js’ contains the core of JQuery, ‘Zend’ contains an optimized search protocol, and of course ‘css’. 

When implementing changes, please note the following:
After you do some testing with the original file set, you will suddenly have the folders index1, index2, index3, and index4 in your Food folder. This is normal: these are more easily accessible indexations of the data file visual_data.csv, which speed up the search for future queries. However, if you make changes in visual_data.csv (e.g., add data), they won't show up in your search results, unless you would delete the index1-4 folders first. 
This is of course a bit cumbersome. The workaround for not deleting the folders after every change in the data file is to include the line "deleteDir($index_file)" in each of the query files (QueryBase, QueryVisual, etc.).
