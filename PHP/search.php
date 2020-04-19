<?php
    mysql_connect("itconcept.it", "hrhackathon", "bwAn5jr5xQbvSYkmnrMVxBa5n2xwCm") or die("Error connecting to database: ".mysql_error());
    mysql_select_db("hrhackathon") or die(mysql_error());
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Search results</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<?php
    $query = $_GET['searchTerm_en'];
    $query2 = $_GET['location'];

    $min_length = 3;

    if(strlen($query) >= $min_length){

        $query = htmlspecialchars($query);
        $query2 = htmlspecialchars($query2);

        $query = mysql_real_escape_string($query);
        $query2 = mysql_real_escape_string($query2);

        $raw_results = mysql_query("SELECT profession, location FROM hrhackathon
            WHERE (`title` LIKE '%".$query."%') OR (`text` LIKE '%".$query."%')") or die(mysql_error());

        if(mysql_num_rows($raw_results) > 0){

            while($results = mysql_fetch_array($raw_results)){


                echo "<p><h3>".$results['title']."</h3>".$results['text']."</p>";

            }

        }
        else{
            echo "No results";
        }

    }
    else{
        echo "Minimum length is ".$min_length;
    }
?>
</body>
</html>
