<!DOCTYPE html>
<html lang="en">
<head>

    <title>Generate Barcode</title>
</head>
<body>

<center>

	<h3>PT.KURHANZ TRANS</h3>
	<p>Jl. Tanjung Duren Barat IV/8A, 3rd-4th floor Grogol Petamburan, Jakarta Barat Indonesia – 11470</p>
	<p style="font-size: 10pt;">Phone : +62 21 8062 7048, +62 21 8068 2388 Fax : +62 21 563 6076 Email :<a href="http://info@kurhanz.com">info@kurhanz.com</a></p>
		
</center>
	<hr style="margin-bottom: 50px">
    
<center>
    
    <h1>{{ __('document.box_number')}}{{' [ ' . $qr_codePdf->box_number . ' ] ' }}/ {{ __('rack.rack_number')}} {{ '[ ' . $qr_codePdf->rack->rack_number . ' ] '}} {{ '/ Division [ ' . $qr_codePdf->rack->division->name . ' ]'  }}  </h1>

    <p><img src='data:image/png;base64, {{ base64_encode(QrCode::format("png")->size(300)->generate(url("/box/view_data/$qr_codePdf->id"))) }}' > <br> {{ __('rack.sentence_qr_code')}}</p>   

    <!-- <h1>{{ __('Periode :') }} {{date('M d, Y', strtotime($qr_codePdf->from)) . ' - ' . date('M d, Y', strtotime($qr_codePdf->to)) }}</h1>      -->

</center>

<hr style="margin-top: 50px;">
<p><i>Notation* :</i></p>

</body>
</html>