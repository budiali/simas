<!DOCTYPE html>
<html>
<head>
	
	<title>PDF data box</title>
	<style type="text/css">
		th.{
			width: 180px;
			text-align: left;
		}
		td.{
			width: 40px;
			text-align: left;
		}
	</style>
</head>
<body>

	<center>

		<h3>PT.KURHANZ TRANS</h3>
		<p>Jl. Tanjung Duren Barat IV/8A, 3rd-4th floor Grogol Petamburan, Jakarta Barat Indonesia – 11470</p>
		<p style="font-size: 10pt;">Phone : +62 21 8062 7048, +62 21 8068 2388 Fax : +62 21 563 6076 Email :<a href="http://info@kurhanz.com">info@kurhanz.com</a></p>
		
	</center>
	<hr style="margin-bottom: 50px">
	<p class="panel-subtitle">
       {{ __('document.box_number')}} {{ '[ ' . $printDataBox->box_number . ' ]' }} {{ __('rack.rack_number')}} {{' [ ' . $printDataBox->rack->rack_number . ' ] '}}  {{ '/ Division [ ' . $printDataBox->rack->division->name . ' ]'  }}
    </p>
    <p class="panel-subtitle">
        {{ __('box.period') }} : {{date('M d, Y', strtotime($printDataBox->from)) . ' - ' . date('M d, Y', strtotime($printDataBox->to)) }}
    </p>

	<table width="800px">
		<tr>
            <th>{{__('document.reference_number')}}</th>
            <th>{{__('document.job_number')}}</th>
            <th>{{__('document.date')}}</th>
            <th>{{__('document.description')}}</th>
         </tr>
         @foreach($printDataBox->document as $value)
         	<tr>
         		<td>{{ $value->reference_number }}</td>
                <td>{{ $value->job_number }}</td>
               	<td>{{ $value->date }}</td>
                <td>{{ $value->description }}</td>
         	</tr>
         @endforeach
	</table>


	<hr style="margin-top: 50px;">
<p><i>Notation* :</i></p>

</body>
</html>

