
<?php
require('datos.php');
$dt=stats::newReg();
?>

<!DOCTYPE html>
<html>
<head>
<script src="https://code.jquery.com/jquery-1.12.3.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.2.61/jspdf.min.js"></script>

<script>

$(function() {
var chart_data = {
         labels: ['Player1', 'Player2', 'Player3', 'Player4'],
         datasets: [
             {
                 fillColor: "rgba(6, 118, 152, 0.71)",
                 strokeColor: "rgba(220,220,220,1)",
                 pointColor: "rgba(220,220,220,1)",
                 pointStrokeColor: "#fff",
                 pointHighlightFill: "#fff",
                 pointHighlightStroke: "rgba(220,220,220,1)",
                 data: [20,34,15,64,]
             }
         ]    
}

//original canvas
var canvas = document.querySelector('#cool-canvas');
var context = canvas.getContext('2d');



new Chart(context).Line(chart_data);

//hidden canvas
var newCanvas = document.querySelector('#supercool-canvas');
newContext = newCanvas.getContext('2d');

var supercoolcanvas = new Chart(newContext).Line(chart_data);
supercoolcanvas.defaults.global = {
	scaleFontSize: 600
}

//add event listener to button
document.getElementById('download-pdf').addEventListener("click", downloadPDF);

//donwload pdf from original canvas
function downloadPDF() {
  var canvas = document.querySelector('#cool-canvas');
 
	//creates image
	var canvasImg = canvas.toDataURL("image/png", 1.0);
    var newCanvas = document.querySelector('#supercool-canvas');

  //create image from dummy canvas
	var newCanvasImg = newCanvas.toDataURL("image/png", 1.0);




	//creates PDF from img
	var doc = new jsPDF('p', 'pt', 'letter');
	doc.setFontSize(20);
    doc.setFont('times')
    doc.setFontType('italic')
	doc.text(20, 20, 'This PDF has a title, subject, author, keywords and a creator.');

     

    source = $('#content')[0];

    margins = {
            top: 80,
            bottom: 60,
            left: 40,
            width: 522
        };


        specialElementHandlers = {
            // element with id of "bypass" - jQuery style selector
            '#bypassme': function (element, renderer) {
                // true = "handled elsewhere, bypass text extraction"
                return true
            }
        };

	
    doc.fromHTML(
        source, // HTML string or DOM elem ref.
        margins.left, // x coord
        margins.top, { // y coord
            'width': margins.width, // max width of content on PDF
            'elementHandlers': specialElementHandlers
        }, margins);
   
                    

                    var base64Img = null;
                    imgToBase64('octocat.jpg', function(base64) {
                        base64Img = base64; 
                    });

                    function imgToBase64(url, callback, imgVariable) {
                    
                    if (!window.FileReader) {
                        callback(null);
                        return;
                    }
                    var xhr = new XMLHttpRequest();
                    xhr.responseType = 'blob';
                    xhr.onload = function() {
                        var reader = new FileReader();
                        reader.onloadend = function() {
                            imgVariable = reader.result.replace('text/xml', 'image/jpeg');
                            callback(imgVariable);
                        };
                        reader.readAsDataURL(xhr.response);
                    };
                    xhr.open('GET', url);
                    xhr.send();
                    };

    
    doc.addImage(base64Img, 'JPEG',10, 10, 40,40);        
    doc.addImage(newCanvasImg, 'JPEG', 10, 200, 600,300);
	doc.save('canvas.pdf');
    
	
	
    setTimeout(function(){
    console.log(newCanvasImg);
		try {
					$.ajax({
							url: 'salvar.php',  
							data:{ 
								img:newCanvasImg
							},                     
							type: 'POST',   
							success: function(data)
							{
							alert("Imagen guardada en servidor");                       
							}
						});                
			}
			catch(err) {
				alert("Ocurrio un error");
			} 
            alert("Hello"); }, 3000);


}
 


});


      
    

</script>

</head>
<body>

<div id="content">
 <h2> Ejemplo de div y span </h2>
  <p>
    Esto es un párrafo dentro de un div,
    <span style="color: red;"> y esto un span dentro de un párrafo.</span> 
  </p>
</div>


<div style="height:0; width:0; overflow:hidden;">
  <canvas id="cool-canvas" width="600" height="300"></canvas>
</div>

<div style="height:0; width:0; overflow:hidden;">
  <canvas id="supercool-canvas" width="1200" height="600"></canvas>
</div>

<button type="button" id="download-pdf" >
  Download PDF
</button>





</body>
</html> 