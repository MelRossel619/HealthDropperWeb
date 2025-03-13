<?php
require('config.php');
?>

<?php
 
$dataPoints1 = array();
$dataPoints2 = array();

try{
     // Creating a new connection.
    // Replace your-hostname, your-db, your-username, your-password according to your database
    $link = new \PDO(   'mysql:host=localhost;dbname=centraldemonit;charset=utf8mb4', //'mysql:host=localhost;dbname=canvasjs_db;charset=utf8mb4',
                        'root', //'root',
                        '', //'',
                        array(
                            \PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                            \PDO::ATTR_PERSISTENT => false
                        )
                    );
	
    $handle = $link->prepare('select id , Flujo from datos'); 
    $handle->execute(); 
    $result = $handle->fetchAll(\PDO::FETCH_OBJ);
		
    foreach($result as $row){
        array_push($dataPoints1, array("x"=>(int) $row->id, "y"=> $row->Flujo));
	//array_push($dataPoints1, array("x"=> $x, "y"=> $row->Temperatura));
    }
	$link = null;
}
catch(\PDOException $ex){
    print($ex->getMessage());
}
try{
     // Creating a new connection.
    // Replace your-hostname, your-db, your-username, your-password according to your database
    $link = new \PDO(   'mysql:host=localhost;dbname=centraldemonit;charset=utf8mb4', //'mysql:host=localhost;dbname=canvasjs_db;charset=utf8mb4',
                        'root', //'root',
                        '', //'',
                        array(
                            \PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                            \PDO::ATTR_PERSISTENT => false
                        )
                    );
	
    
    $handle = $link->prepare('select id, Flujo from datos'); 
    $handle->execute(); 
    $result = $handle->fetchAll(\PDO::FETCH_OBJ);
		
    foreach($result as $row){
       
       array_push($dataPoints2, array("x"=> (int)$row->id, "y"=> $row->Flujo));
       //array_push($dataPoints2, array("x"=> $x, "y"=> $row->Humedad));
    }
	$link = null;
}

catch(\PDOException $ex){
    print($ex->getMessage());
}
///////////////////for($i = 0; $i < $initialNumberOfDataPoints; $i++){

?>














<!DOCTYPE HTML>
<html>
<head>  
<script>
	
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Almacen"
	},
	//axisY: {
	//	prefix: ""
	//},
	axisX: {
		
                xValueType: "Tiempo",
		valueFormatString:"DD MMM hh:mm TT",
		//valueFormatString:"DD MM YYY"
	       
	},
	axisY: {
		suffix: " °C",
		maximum: 100,
		gridThickness: 0
	},
	toolTip:{
		shared: true,
		//content: "{name} </br> <strong>Temperature: </strong> </br> Min: {y[0]} °C, Max: {y[1]} °C"
	},
	
	legend:{
		cursor: "pointer",
		itemclick: toggleDataSeries
	},
	
	data: [
	{
		
		type: "line", //change type to bar, line, area, pie, etc 
		name: "Temperatura",
		showInLegend: "true",
		xValueType: "dateTime",
		xValueFormatString :  "DD MMM hh:mm TT",//"hh: mm: ss TT" , 
		//xValueFormatString :  "YYYY",//"hh: mm: ss TT" , 
		//xValueFormatString: "MMM YYYY",
		
		yValueFormatString: "##.##°C",
		
		dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
		},
	{
		type: "line",
		name: "Humedad",
		showInLegend: "true",
		xValueType: "dateTime",
		xValueFormatString : "DD MMM hh:mm TT", //"hh: mm: ss TT" , 
		//xValueFormatString: "MMM YYYY",
		yValueFormatString: "#,##0.0#",
		dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
	        
	}]
	
	
});
chart.render();
 
 function toggleDataSeries(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chart.render();
}
}
</script>
</head>
<body>
<head>

<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>

<!DOCTYPE html>







<html>
<body>
<form method="get" action="reporte1.php">
<button type="submit">
<b>IMPRIMIR REPORTE 1</b><br />
</button>
</form>
</body>
</html>  




