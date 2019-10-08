$(document).ready(function() {
	
	$.ajax({
       url:"http://localhost/Graph/data.php",
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
                  label:'Month rain',
                  backgroundColor: 'rgba(255, 99, 132, 0.2)',
                  borderColor: 'rgba(255,99,132,1)',
                  hoverBackgroundColor:'rgba(255,99,132,.75)',
                  hoverBorderColor:'rgba(255,99,132,1)',
                  data:rain

               }
            ]
         };

         // var ctx = document.getElementById("barchart").getContext('2d');
         var ctx = $("#barchart");
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