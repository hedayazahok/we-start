<html>
    <head>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>

html2canvas {
     width: 100px !important;
     height: 200px !important;
}

body {
  background-color: coral;
}

        </style>

</head>
<body bgcolor="teal">
<a href="javascript:genScreenshot()"><button style="background:aqua; cursor:pointer">Get Screenshot</button> </a>

<br>
<div id="box1">
</div>
<p>
    <table border="7" bgcolor="green">
        <tbody>
            <tr>
                <th>Company</th>
                <th>Contact</th>
                <th>Country</th>

            </tr>
            <tr>
                <td>Alfreds Futterkiste</td>
                <td>Maria Anders</td>
                <td>Germany</td>
            </tr>
            <tr>
                <td>Centro comercial Moctezuma</td>
                <td>Francisco Chang</td>
                <td>Mexico</td>
            </tr>
            <tr>
                <td>Ernst Handel</td>
                <td>Roland Mendel</td>
                <td>Austria</td>
            </tr>
            <tr>
                <td>Island Trading</td>
                <td>Helen Bennett</td>
                <td>UK</td>
            </tr>
            <tr>
                <td>Laughing Bacchus Winecellars</td>
                <td>Yoshi Tannamuri</td>
                <td>Canada</td>
            </tr>
            <tr>
                <td>Magazzini Alimentari Riuniti</td>
                <td>Giovanni Rovelli</td>
                <td>Italy</td>
            </tr>
        </tbody>
    </table>

</p>




<script>
function genScreenshot() {
    html2canvas(document.body, {
      onrendered: function(canvas) {
      $('#box1').html("");
			$('#box1').append(canvas);

      if (navigator.userAgent.indexOf("MSIE ") > 0 ||
					navigator.userAgent.match(/Trident.*rv\:11\./))
			{
      	var blob = canvas.msToBlob();

        window.navigator.msSaveBlob(blob,'Test file.png');

      }
      else   {

        $('#test').attr('href', canvas.toDataURL("image/png"));
        doc = new jsPDF({
                     unit: 'px',
                     format: 'a4'
                 });
                doc.addImage(canvas.toDataURL("image/png"), 'JPEG', 0, 0);
                doc.save('ExportFile.pdf');
                form.width(cache_width);
        //$('#test').attr('download','Test file.png');
        $('#test')[0].click();
         }


      }
    });
}
</script>
</body>
</html>
