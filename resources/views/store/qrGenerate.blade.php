@extends('layouts.store')
 @section('content')
<div>
    <script type="text/javascript" src="{{ asset('js/jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/qrcode.js') }}"></script>

    

<input id="text" type="text" value="{{$id}}" style="width:80%" /><br />
<div id="qrcode" style="width:200px; height:200px; margin-top:15px;"></div>
<input type="button" onclick="PrintDiv();" value="Print" />  

<script type="text/javascript">
var qrcode = new QRCode(document.getElementById("qrcode"), {
	width : 200,
	height : 200
});

function makeCode () {		
	var elText = document.getElementById("text");
	
	if (!elText.value) {
		alert("Input a text");
		elText.focus();
		return;
	}
	
	qrcode.makeCode(elText.value);
}

makeCode();

$("#text").
	on("blur", function () {
		makeCode();
	}).
	on("keydown", function (e) {
		if (e.keyCode == 13) {
			makeCode();
		}
	});


    function PrintDiv() 
   {  
       var divContents = document.getElementById("qrcode").innerHTML;  
       var printWindow = window.open('', '', 'height=400,width=400');  
       printWindow.document.write('<html><head><title>Print DIV Content</title>');  
       printWindow.document.write('</head><body >');  
       printWindow.document.write(divContents);  
       printWindow.document.write('</body></html>');  
       printWindow.document.close();  
       printWindow.print();  
    }  
</script> 
</div> 
      
@endsection