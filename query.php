<?php

//echo $_SERVER["DOCUMENT_ROOT"];
//console.log("hallo");

set_include_path(dirname(__FILE__));
require_once 'Zend/Loader/Autoloader.php';
$autoloader = Zend_Loader_Autoloader::getInstance();
$autoloader->registerNamespace( 'Zend_' );
ini_set('display_errors', 1);
error_reporting(E_ALL);

/*$frontendOptions = array(
    'lifetime' => 3000, // Lebensdauer des Caches 2 Stunden
    'automatic_serialization' => true
);

$backendOptions = array(
    'cache_dir' => $_SERVER['DOCUMENT_ROOT'].'/food/tmp/' // Verzeichnis, in welches die Cache Dateien kommen
);

// Ein Zend_Cache_Core Objekt erzeugen
$cache = Zend_Cache::factory('Core','File',$frontendOptions,$backendOptions);
*/

function sortByOrder($a, $b) {
    return $a['rating'] - $b['rating'];
}

function deleteDir($dirPath) {
    if (!is_dir($dirPath)) {
        //    throw new InvalidArgumentException("$dirPath must be a directory");
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            deleteDir($file);
        } else {
            unlink($file);
        }
    }
    rmdir($dirPath);
}


$index_file = $_SERVER["DOCUMENT_ROOT"].'/Food/index';
//console.log($_SERVER["DOCUMENT_ROOT"]);

$index = null;

deleteDir($index_file); //for debug purposes leave that line in

if (!file_exists($index_file)) {
    $index = Zend_Search_Lucene::create($index_file);
    
    $data = null;
    
    $file = fopen($_SERVER['DOCUMENT_ROOT'].'/Food/visual_data.csv', 'r');
    
    while (($line = fgetcsv($file,0, "\t")) !== FALSE) {
        //$line is an array of the csv elements
        //  array_push($_SESSION['data'],$line);
        
        $dat = array();
        for ($i=1; $i < count($line);$i++) {
            array_push($dat,$line[$i]);
        }
        $data[$line[0]] = $dat;
    }
    fclose($file);
    
    setlocale(LC_ALL, 'en_GB');
    
    
    if ($data != null) {
        
        foreach ($data as $key => $value) {
            
            $r_title = $value[0];
            $r_image = $value[10];        	
  			// echo $r_image;
           // echo strlen($r_image)."<br>";
           // echo substr($r_image,strripos($r_image,"/"));

           //$r_image = "imageselection/{$r_image}.jpg")
          // $r_image = "images/thumbnail.".substr($r_image,strripos($r_image,"/")+1);   //als je afbeeldingen toevoegt moet je die denk ik in de thumbnail map gooien
           $r_image = "images/".substr($r_image,strripos($r_image,"/")+1);   //TEST REGEL - VERWIJDEREN
            $r_fsa = $value[12];
         
              //add a column of FSA scores to the csv document (keep it in tab-separated format to be sure)
                                    //don't know why but the value 6 does not work. The value 2 does work...              
            //echo $key." ".$r_title."<br>";

            /*
            $document = new Zend_Search_Lucene_Document();
            $document->addField(Zend_Search_Lucene_Field::Text('title',  iconv("UTF-8", "ASCII//TRANSLIT", $r_title)));
            $document->addField(Zend_Search_Lucene_Field::Text('dir', iconv("UTF-8", "ASCII//TRANSLIT", $r_dir)));
            $document->addField(Zend_Search_Lucene_Field::Text('ing', iconv("UTF-8", "ASCII//TRANSLIT",  $r_ing)));
          // $document->addField(Zend_Search_Lucene_Field::Text('ID', iconv("UTF-8", "ASCII//TRANSLIT", "hel")));
            $document->addField(Zend_Search_Lucene_Field::Text('img', iconv("UTF-8", "ASCII//TRANSLIT", $r_image)));
            $document->addField(Zend_Search_Lucene_Field::Text('fsa', iconv("UTF-8", "ASCII//TRANSLIT", $r_fsa))); //This line is new; you could also do this with the WHO score
            */
 $document = new Zend_Search_Lucene_Document();
            $document->addField(Zend_Search_Lucene_Field::Text('title', $r_title));
          // $document->addField(Zend_Search_Lucene_Field::Text('ID', iconv("UTF-8", "ASCII//TRANSLIT", "hel")));
            $document->addField(Zend_Search_Lucene_Field::Text('img', $r_image));
            $document->addField(Zend_Search_Lucene_Field::Text('rating', $r_rating)); //This line is new; you could also do this with the WHO score
           

            $index->addDocument($document);
         //iconv converts --> maybe there is a better php function   
        }
        
    } 
    
} else {
    $index = Zend_Search_Lucene::open($index_file);
}




$query = (!empty($_GET['q'])) ? strtolower($_GET['q']) : null;

if (!isset($query)) {
    die('Invalid query.');
}

$status = true;

$databaseUsers = null;

$queryString = urldecode($query);
// echo $queryString;
//$queryString = "chicken";

try {
    $query_ = Zend_Search_Lucene_Search_QueryParser::parse($queryString."*"); //without the star it would be exact  (the . is an append) --> you could bugfix this if you want search queries to be exactly fitting
} catch (Zend_Search_Lucene_Search_QueryParserException $e) {
    echo "Abfrage Syntax Fehler: " . $e->getMessage() . "\n";
}

// $term  = new Zend_Search_Lucene_Index_Term($queryString."*", 'title');
// $query = new Zend_Search_Lucene_Search_Query_Wildcard($term);
$hits  = $index->find($query_);
$counter = 0;
foreach ($hits as $hit) {
    
    $counter++;
    // echo $hit->score;
    // echo $hit->title;
    // echo $hit->ID;
    // $array[] = $hit->title;
    $databaseUsers[] = array (
        'recipe' => $hit->title,
        'image' => $hit->img, //The comma is new
        'rating' => $hit->rating  //This line is new     
    );
    
    //if ($counter == 10)     //LIMITS THE NUMBER OF SEARCH RESULTS - if you comment this out, you get all the results.
       // break;
    
}

usort($databaseUsers, 'sortByOrder');
//foreach ($databaseUsers


//print_r($databaseUsers);

//BELOW HERE (163-170) Christoph told me YOU CAN RE-RANK THE SEARCH RESULTS  --> re-sort the databaseUsers array by FSA
//However i did some googling and am going to write a function that might order it all




/*$resultUsers = [];
foreach ($databaseUsers as $key => $oneUser) {
    if (strpos(strtolower($oneUser["recipe"]), $query) !== false ||
        strpos(str_replace('-', '', strtolower($oneUser["recipe"])), $query) !== false ||
        strpos(strtolower($oneUser["id"]), $query) !== false) {
            $resultUsers[] = $oneUser;
        }
}*/



// Means no result were found
if (empty($databaseUsers) ) {
    $status = false;
}

header('Content-Type: application/json');

echo json_encode(array(
    "status" => $status,
    "error"  => null,
    "data"   => array(
        "recipes"      => $databaseUsers//,
        // "project"   => $resultProjects
    )
));









?>





