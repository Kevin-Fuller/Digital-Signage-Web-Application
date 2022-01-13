<?php
//Connect to DB 
include 'conn.php';

// Clear Information 
$grabTables = $mysqli->query("SELECT * from tablegenerator WHERE user = 'DemoUser1' OR user = 'DemoUser2'");



while ($row = $grabTables->fetch_assoc()):

        $tableToDelete = $row['tableName'];
        
        //Delete any images uploaded by demo account
        $imagePath = 'images/'.$tableToDelete.'.jpg';
        $imagePath2 = 'images/'.$tableToDelete.'Overlay.jpg';
        if (file_exists($imagePath)){
                unlink($imagePath);
        }
        if (file_exists($imagePath2)){
                unlink($imagePath2);
        }


        //Delete from other information table
        $mysqli->query("Delete from other WHERE tableName = '$tableToDelete'");
    
        //Delete from data table
        $mysqli->query("Delete from data WHERE tableGroup = '$tableToDelete'");
    
        //Delete from table Generator
        $mysqli->query("Delete from tablegenerator WHERE tableName = '$tableToDelete'");
    
endwhile;



//insert baseline Information 
$mysqli->query("INSERT INTO tablegenerator (tableName, userTableName, tableType, user) VALUES ('DemoUser1Burgers','Burgers','normal','DemoUser1'), ('DemoUser2Salads','Salads','normal','DemoUser2')");

$mysqli->query("INSERT INTO other (color, title, tableName) VALUES ('#E01B41','BURGERS','DemoUser1Burgers'), ('#34FF33','SALADS','DemoUser2Salads')");

$mysqli->query("INSERT INTO data (item, price, description, inOutStock, type, tableGroup) VALUES 

('','','Pick between your choice of meat (Beef Patty, Grilled Chicken, or Crispy Chicken)','', 'isItalics', 'DemoUser1Burgers'),

('All-American','$9.55','Lettuce, Tomato, Bacon, & American Cheese', '1','isItem','DemoUser1Burgers'),

('Sweet Lou','$11.50','Bacon, Beer-Battered Onion Ring, & Cheddar Cheese', '1','isItem','DemoUser1Burgers'),

('Gables','$10.55','Lettuce, Tomato, Avocado, & Swiss Cheese', '0','isItem','DemoUser1Burgers'),

('Big ol Burger','$111.55','Five All-Beef Patties Stacked', '1','isItem','DemoUser1Burgers'),

('','','KIDS', '','isSubheader','DemoUser1Burgers'),


('Kids Burger','$4.55','American Cheese & Ketchup', '1','isItem','DemoUser1Burgers'),

('','','All Salads Served with Ranch','', 'isItalics', 'DemoUser2Salads'),


('Cobb','$10.55','Lettuce, Tomato, Avocado, Egg, & Provolone', '0','isItem','DemoUser2Salads'),

('Garden','$6.99','Lettuce, Tomato, Carrot, Onion, & Provolone', '1','isItem','DemoUser2Salads'),

('','','OTHER VEGETARIAN OPTIONS', '','isSubheader','DemoUser2Salads'),

('Impossible Burger','$16.99','Your choice of toppings', '1','isItem','DemoUser2Salads'),

('Veggie Wings (5)','$6.99','', '1','isItem','DemoUser2Salads')");



?>