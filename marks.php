
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<title>IET DAVV</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<link href="admin/css/footer.css" rel="stylesheet" type="text/css">
<link href="admin/css/home.css" rel="stylesheet" type="text/css">
<link href="admin/css/maincss.css" rel="stylesheet" type="text/css">
<style>
.tstyle{
	text-align:center; 
	color:aliceblue;
}
body {
    background-repeat: no-repeat;
    background-attachment: fixed;
}
</style>
<script>
$(document).ready(function(){
    var isAndroid = /android/i.test(navigator.userAgent.toLowerCase());
    if (isAndroid)
    {$("#navigate").remove();
         $("body").css("background-image", "url('./background.png')");
          //$("body").css("background-color", "gray");
    }
});

</script>
</head>
<body>
<center>
<div class="navigate" id="navigate">
    <nav class="navbar navbar-light bg-faded">
        <div class="row container">
            <div class="col-sm-2">
                <img src="davv.png" width="100" height="100" class="d-inline-block align-center" alt="IET-DAVV" align='center'>
            </div>
    		<div class="col-sm-8" style="color:aliceblue">
    			<h1>Institute Of Engineering & Technology</h1>
    		</div>
    		<div class="col-sm-4"></div>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent"></div>
        <h3 align="left"><a href="http://faculty.ietdavv.edu.in" class="btn btn-lg btn-primary">Back</a></h3> 
    </nav>
</div>
<br>
<?php if(false) { ?>
<div class="table-responsive col-md-8" >  
	<table class="table table-bordered table-hover text-center">
                <thead>
					<th colspan="2"  class="bg-success">Data Wareshousing & Mining (CER6G4)</th>
					<tr class="tstyle bg-dark">
						<th>TEST</th>
						<th>MARKS</th>
					</tr>
                </thead>
				<tbody>
					<tr>
						<th>Test1</th>
						<td>14</td>
					</tr>
					<tr>
						<th>Test2</th>
						<td>17</td>
					</tr>
					<tr>
						<th>Test3</th>
						<td>18</td>
					</tr>
					<tr class="table-active">
						<th>BEST of Two</th>
						<td>35</td>
					</tr>
                </tbody>
    </table>
</div>

<div class="table-responsive col-md-8" >  
	<table class="table table-bordered table-hover text-center">
                <thead>
					<th colspan="2"  class="bg-success">Computer Graphics (CER6G3)</th>
					<tr class="tstyle bg-dark">
						<th>TEST</th>
						<th>MARKS</th>
					</tr>
                </thead>
				<tbody>
					<tr>
						<th>Test1</th>
						<td>14</td>
					</tr>
					<tr>
						<th>Test2</th>
						<td>17</td>
					</tr>
					<tr>
						<th>Test3</th>
						<td>18</td>
					</tr>
					<tr class="table-active">
						<th>BEST of Two</th>
						<td>35</td>
					</tr>
                </tbody>
    </table>
</div>

<div class="table-responsive col-md-8" >  
	<table class="table table-bordered table-hover text-center">
                <thead>
					<th colspan="2" class="bg-success">Design and analysis of algorithm (CER6G2)</th>
					<tr class="tstyle bg-dark">
						<th>TEST</th>
						<th>MARKS</th>
					</tr>
                </thead>
				<tbody>
					<tr>
						<th>Test1</th>
						<td>14</td>
					</tr>
					<tr>
						<th>Test2</th>
						<td>17</td>
					</tr>
					<tr>
						<th>Test3</th>
						<td>18</td>
					</tr>
					<tr class="table-active">
						<th>BEST of Two</th>
						<td>35</td>
					</tr>
                </tbody>
    </table>
</div>

<div class="table-responsive col-md-8" >  
	<table class="table table-bordered table-hover text-center">
                <thead>
					<th colspan="2"  class="bg-success">Compiler Technique (CER6G1)</th>
					<tr class="tstyle bg-dark">
						<th>TEST</th>
						<th>MARKS</th>
					</tr>
                </thead>
				<tbody>
					<tr>
						<th>Test1</th>
						<td>14</td>
					</tr>
					<tr>
						<th>Test2</th>
						<td>17</td>
					</tr>
					<tr>
						<th>Test3</th>
						<td>18</td>
					</tr>
					<tr class="table-active">
						<th>BEST of Two</th>
						<td>35</td>
					</tr>
                </tbody>
    </table>
</div>

<div class="table-responsive col-md-8" >  
	<table class="table table-bordered table-hover text-center">
                <thead>
					<th colspan="2" class="bg-success">Wireless Network (CER6F4)</th>
					<tr class="tstyle bg-dark">
						<th>TEST</th>
						<th>MARKS</th>
					</tr>
                </thead>
				<tbody>
					<tr>
						<th>Test1</th>
						<td>14</td>
					</tr>
					<tr>
						<th>Test2</th>
						<td>17</td>
					</tr>
					<tr>
						<th>Test3</th>
						<td>18</td>
					</tr>
					<tr class="table-active">
						<th>BEST of Two</th>
						<td>35</td>
					</tr>
                </tbody>
    </table>
</div>
<?php } else echo 'Marks not uploaded.'; ?>


</center>
</body>
</html>
