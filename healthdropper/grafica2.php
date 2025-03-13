<?php
require('config.php');
?>

<?php
 
$dataPoints1 = array();

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

///////////////////for($i = 0; $i < $initialNumberOfDataPoints; $i++){

?>




<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	zoomEnabled: true,
	theme: "dark2",
	title: {
		text: "Flujo"
	},
	axisX: {
		title: "Grafica",
		valueFormatString: "####",
		interval: 2
	},
	axisY: {
		logarithmic: true, //change it to false
		title: "Internet Users (Log)",
		titleFontColor: "#6D78AD",
		lineColor: "#6D78AD",
		gridThickness: 0,
		lineThickness: 1,
		labelFormatter: addSymbols
	},

	legend: {
		verticalAlign: "top",
		fontSize: 16,
		dockInsidePlotArea: true
	},
	data: [{
		type: "line",
		xValueFormatString: "####",
		showInLegend: true,
		name: "Log Scale",
		

        dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>


	},
	{
		type: "line",
		xValueFormatString: "####",
		axisYType: "secondary",
		showInLegend: true,
		name: "Linear Scale",
		dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();

function addSymbols(e) {
	var suffixes = ["", "K", "M", "B", "T"];

	var order = Math.max(Math.floor(Math.log(Math.abs(e.value)) / Math.log(1000)), 0);
	if(order > suffixes.length - 1)
		order = suffixes.length - 1;

	var suffix = suffixes[order];
	return CanvasJS.formatNumber(e.value / Math.pow(1000, order), "#,##0.##") + suffix;
}

}
</script>
</head>
<body>
<div id="chartContainer" style="height: 300px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>
</html>


