
<?php
session_start();
include("adminheader.php");
include "../includes/dbconnect.php";
require_once("../includes/classes/user.php");
require_once("../includes/classes/transaction.php");
require_once("../includes/classes/Loan.php");
$transaction= new Transaction($con,null);
$loan= new Loan($con,null);
$user=new User($con,null) ;
$res=$transaction->makeSavingGraph();
for ($i=0; $i < count($res); $i++) { 
 // echo $res[$i]."<br>";
}
?>
<br>
</body>
<div class="container"></div>

<div class="container-fluid">
	<div class="card">
	<div class="card-header">Loans</div>
	<div class="card-body"><form>
  <div class="row">
    <div class="col-md-6 card" style="border: 1px solid skyblue;">
        
      <br><div class="row">

      <div class="col-md-3">
        <select class="form-control">
          <option>Select Year</option>
          <?php
           $y=date("Y");
           $start=2015;
           for ($i=(int)$y; $i >=$start; $i--) { 
             echo "<option>".$i ."</option>";
           }

           ?>
        </select><br>
              
      </div>
      <div class="col-md-4"><center><h5>2019</h5></center></div>  
      <div class="col-md-5">
        <label class="form-control">
        <center>Total Loan this year   450000</center>
        </label>
      </div><?php echo $loan->receivedDate(); ?>
       <div class="table-responsive">
        <table class="table table-stripped table-bordered">
          <th>Jan</th>
          <th>Feb</th>
          <th>Mar</th>
          <th>Apl</th>
          <th>May</th>
          <th>Jun</th>
          <th>Jul</th>
          <th>Aug</th>
          <th>Sep</th>
          <th>Oct</th>
          <th>Nov</th>
          <th>Dec</th>
          <tr>
            <td>45000</td>
            <td>45000</td>
              <td>45000</td>
            <td>45000</td>
            <td>45000</td>
                <td>45000</td> 
                <td>45000</td>
                <td>45000</td>
                <td>45000</td>
                <td>45000</td>
                <td>45000</td>
                <td>45000</td>
          </tr>
         </table>
         </div>
    </div>
  </div>
<div class="col-md-1"></div><br>
  <div class="col-md-5 card" style="border: 1px solid skyblue;">
    <canvas id="loansChart" style="max-height:300px;"></canvas>
  </div>

    </div>
		</form>
	</div>
	</div><br>

   <div class="row">
   	<div class="col-md-3">
   		<div class="card">
   			<div class="card-header">
  				<center><font><i class="fas fa-users"></i>&nbsp;All Members</font></center>
   				<hr>
   				<center><h3><?php echo $user->getAllUser(); ?></h3></center>
   				<hr>
   				<a href="registration.php">Read More</a>
   			</div>
   		</div>
   	</div>
   	<div class="col-md-3">
   		<div class="card">
   			<div class="card-header">
   				<center><font><i class="fas fa-money-check"></i>&nbsp;Total Savings</font></center>
   				<hr>
   				<center><h3><?php echo $transaction->getTotalBalance(); ?><span style="font-size: 13px;">Rwf</span></h3></center>
   				<hr>
   				<a href="saving.php">Read More</a>
   			</div>
   		</div>
   	</div>
   	<div class="col-md-3">
   		<div class="card">
   			<div class="card-header">
  				<center><font>Returned Loans</font></center>
   				<hr>
   				<center><h3>50000</h3></center>
   				<hr>
   				<a href="">Read More</a>
   			</div>
   		</div>
   	</div>
   	<div class="col-md-3">
   		<div class="card">
   			<div class="card-header">
  				<center><font>Unreturned Loans</font></center>
   				<hr>
   				<center><h3>12000</h3></center>
   				<hr>
   				<a href="">Read More</a>
   			</div>
   		</div>
   	</div>
    </div>
   <br>


  <div class="row">
    <div class="col-md-4 card" style="margin-left: 1%;">
     <div class="card-header" style="background-color: rgba(255, 99, 132, 0.2);font-weight: bold;"><center>Gender in Maranata</center></div>
       <canvas id="savingsChart" style="max-width: 500px;"></canvas>
     </div><br>
     <div class="col-md-4 card" style="margin-left: 2%;">
     <div class="card-header" style="background-color: rgba(75, 78, 80, 0.2);font-weight: bold;"><center>Savings category</center></div>
       <canvas id="dougnutChart" style="max-width: 500px;"></canvas>
     </div><br>
     <div class="col-md-3 card" style="margin-left: 2%;">
     <div class="card-header" style="background-color: rgba(255, 206, 86, 0.2);font-weight: bold;"><center>Years category</center></div>
       <canvas id="yearsChart" style="max-width: 500px;"></canvas><br>
     </div>
   </div> 

</div>
</div>
<br>
<div class="container-fluid">
  <div class="card">
    <div class="card-header">
      <?php include("../includes/footer.php") ?>
    </div>
  </div>
</div>
<body>

<!--Graph of Loans-->

<script type="text/javascript">

  $(document).ready(function() {
  
  $.ajax({
       url:"http://localhost/IkiminaGit/maranata/Graph/data.php",
       method:"GET",
       success: function(data){
        console.log(data);
         var month = [];
         var rain = [];

         for (var i  in data) {
          month.push(data[i].moth);
          rain.push(data[i].rain);
         }

         var chartdata = {
            labels: month,
            datasets:[
               {
                  label:'Loans Variation in this year',
                  backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 200, 86, 0.2)',
                                    'rgba(75, 78, 80, 0.2)',
                                    'rgba(30, 60, 255, 0.3)',
                                    'rgba(0, 255, 64, 0.2)'
                                    ],
                  borderColor: [
                                    'rgba(255,99,132,1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                    ],
                hoverBackgroundColor: [
                                    'rgba(255, 99, 132, 0.5)',
                                    'rgba(54, 162, 235, 0.5)',
                                    'rgba(255, 206, 86, 0.5)',
                                    'rgba(75, 192, 192, 0.5)',
                                    'rgba(153, 102, 255, 0.5)',
                                    'rgba(255, 159, 64, 0.5)',
                                    'rgba(255, 99, 132, 0.5)',
                                    'rgba(54, 162, 235, 0.5)',
                                    'rgba(255, 200, 86, 0.5)',
                                    'rgba(75, 78, 80, 0.5)',
                                    'rgba(30, 60, 255, 0.5)',
                                    'rgba(0, 255, 64, 0.5)'
                                    ],
                  hoverBorderColor:'rgba(255,99,132,1)',
                  data:rain

               }
            ]
         };

         // var ctx = document.getElementById("barchart").getContext('2d');
         var ctx = $("#loansChart");
         var barGraph= new Chart(ctx, {
              type:"bar",
              data:chartdata
         });

       },
       error: function(data){
        console.log(data);
       }
  });
});
</script>

<!--Graph of Loans End-->


<!--Graph of Savings -->
<script type="text/javascript">
  $(document).ready(function() {
  
  $.ajax({
       url:"http://localhost/oaz/maranata/Graph/sexGraph.php",
       method:"GET",
       success: function(data){
        console.log(data);
         var gender = [];
         var num = [];

         for (var i  in data) {
          gender.push(data[i].gen);
          num.push(data[i].num);
         }

         var chartdata = {
            labels: gender,
            datasets:[
               {
                  label:'Savings',
                  backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 206, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(255, 200, 86, 0.2)',
                                    'rgba(75, 78, 80, 0.2)',
                                    'rgba(30, 60, 255, 0.3)',
                                    'rgba(0, 255, 64, 0.2)'
                                    ],
                  borderColor: [
                                    'rgba(255,99,132,1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 159, 64, 1)'
                                    ],
                hoverBackgroundColor: [
                                    'rgba(255, 99, 132, 0.5)',
                                    'rgba(54, 162, 235, 0.5)',
                                    'rgba(255, 206, 86, 0.5)',
                                    'rgba(75, 192, 192, 0.5)',
                                    'rgba(153, 102, 255, 0.5)',
                                    'rgba(255, 159, 64, 0.5)',
                                    'rgba(255, 99, 132, 0.5)',
                                    'rgba(54, 162, 235, 0.5)',
                                    'rgba(255, 200, 86, 0.5)',
                                    'rgba(75, 78, 80, 0.5)',
                                    'rgba(30, 60, 255, 0.5)',
                                    'rgba(0, 255, 64, 0.5)'
                                    ],
                  hoverBorderColor:'rgba(255,99,132,1)',
                  data:num

               }
            ]
         };

         // var ctx = document.getElementById("barchart").getContext('2d');
         var ctx = $("#savingsChart");
         var barGraph= new Chart(ctx, {
              type:"pie",
              data:chartdata
         });

       },
       error: function(data){
        console.log(data);
       }
  });
});
</script>

<!--Graph of Savings Ends-->


<script type="text/javascript">
// var ctx = document.getElementById("savingsChart").getContext('2d');
// var myChart = new Chart(ctx, {
// type: 'bar',
// data: {
// labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
// datasets: [{
// label: 'Savings',
// data: [12, 19, 3, 5, 2, 3],
// backgroundColor: [
// 'rgba(255, 99, 132, 0.2)',
// 'rgba(54, 162, 235, 0.2)',
// 'rgba(255, 206, 86, 0.2)',
// 'rgba(75, 192, 192, 0.2)',
// 'rgba(153, 102, 255, 0.2)',
// 'rgba(255, 159, 64, 0.2)'
// ],
// borderColor: [
// 'rgba(255,99,132,1)',
// 'rgba(54, 162, 235, 1)',
// 'rgba(255, 206, 86, 1)',
// 'rgba(75, 192, 192, 1)',
// 'rgba(153, 102, 255, 1)',
// 'rgba(255, 159, 64, 1)'
// ],
// borderWidth: 1
// }]
// },
// options: {
// scales: {
// yAxes: [{
// ticks: {
// beginAtZero: true
// }
// }]
// }
// }
// });
</script>

<!--Graph of Loans-->

<script type="text/javascript">
// var ctx = document.getElementById("loansChart").getContext('2d');
// var myChart = new Chart(ctx, {
// type: 'bar',
// data: {
// labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
// datasets: [{
// label: 'Loans',
// data: [12, 19, 3, 5, 2, 3],
// backgroundColor: [
// 'rgba(255, 99, 132, 0.2)',
// 'rgba(54, 162, 235, 0.2)',
// 'rgba(255, 206, 86, 0.2)',
// 'rgba(75, 192, 192, 0.2)',
// 'rgba(153, 102, 255, 0.2)',
// 'rgba(255, 159, 64, 0.2)'
// ],
// borderColor: [
// 'rgba(255,99,132,1)',
// 'rgba(54, 162, 235, 1)',
// 'rgba(255, 206, 86, 1)',
// 'rgba(75, 192, 192, 1)',
// 'rgba(153, 102, 255, 1)',
// 'rgba(255, 159, 64, 1)'
// ],
// borderWidth: 1
// }]
// },
// options: {
// scales: {
// yAxes: [{
// ticks: {
// beginAtZero: true
// }
// }]
// }
// }
// });
</script>


<!--Graph of Years-->

<script type="text/javascript">
var ctx = document.getElementById("yearsChart").getContext('2d');
var myChart = new Chart(ctx, {
type: 'pie',
data: {
labels: ["-25", "26-30", "30+"],
datasets: [{
label: 'Loans',
data: [12, 40, 15],
backgroundColor: [
'rgba(255, 99, 132, 0.2)',
'rgba(54, 162, 235, 0.2)',
'rgba(255, 206, 86, 0.2)',
'rgba(75, 192, 192, 0.2)',
'rgba(153, 102, 255, 0.2)',
'rgba(255, 159, 64, 0.2)'
],
borderColor: [
'rgba(255,99,132,1)',
'rgba(54, 162, 235, 1)',
'rgba(255, 206, 86, 1)',
'rgba(75, 192, 192, 1)',
'rgba(153, 102, 255, 1)',
'rgba(255, 159, 64, 1)'
],
borderWidth: 1
}]
},
options: {
scales: {
yAxes: [{
ticks: {
beginAtZero: true
}
}]
}
}
});
</script>


<!--Graph of Joining-->

<script type="text/javascript">
var ctx = document.getElementById("dougnutChart").getContext('2d');
var myChart = new Chart(ctx, {
type: 'doughnut',
data: {
labels: ["5000-50000","50000-150000","150000-500000","500000-Above"],
datasets: [{
label: 'Loans',
data: [12, 19, 3, 5],
backgroundColor: [
'rgba(255, 99, 132, 0.2)',
'rgba(54, 162, 235, 0.2)',
'rgba(255, 206, 86, 0.2)',
'rgba(75, 192, 192, 0.2)',
'rgba(153, 102, 255, 0.2)',
'rgba(255, 159, 64, 0.2)'
],
borderColor: [
'rgba(255,99,132,1)',
'rgba(54, 162, 235, 1)',
'rgba(255, 206, 86, 1)',
'rgba(75, 192, 192, 1)',
'rgba(153, 102, 255, 1)',
'rgba(255, 159, 64, 1)'
],
borderWidth: 1
}]
},
options: {
scales: {
yAxes: [{
ticks: {
beginAtZero: true
}
}]
}
}
});
</script>


