<!DOCTYPE html>
<html>
<head>
	<title>highchart</title>
	<script type="text/javascript" src='js/jquery.min.js'></script>
	<script type="text/javascript" src='js/highcharts.js'></script>
	<script type="text/javascript">
		function chart (data,cat) {
		   $('#container').highcharts({
		    chart: {
		        type: 'line'
		    },
		    title: {
		        text: 'Profit'
		    },
		    xAxis: {
		        categories:cat
		    },
		    yAxis: {
		        title: {
		            text: 'Jumlah Profit'
		        }
		    },
		    series: data,
		  });
		}
		$(document).ready(function() {
		 $.ajax({
		    url: 'function/cobaproses.php',
		    data:'',
		    dataType: "json",
		    success: function (data) {

		        chart(data.series,data.categories);
		    }
		  });
		 });
	</script>
</head>
<body>
<div id="container" style="width:100%; height:400px;"></div>
</body>
</html>