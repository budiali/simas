<!DOCTYPE html>
<html>
<head>
	<title>{{$detailDocPdf->name}}</title>
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

	<table border="" >
										
		<tr>
			<th>{{ __('document.reference_number') }}</th>
			<td>:</td>
			<td>{{ $detailDocPdf -> reference_number }}</td>
		</tr>
		<tr>
			<th>{{ __('document.job_number') }}</th>
			<td>:</td>
			<td>{{ $detailDocPdf -> job_number }}</td>
		</tr>
		<tr>
			<th>{{ __('document.user_upload') }}</th>
			<td>:</td>
			<td>{{ $detailDocPdf->user->name }}</td>
		</tr>
		<tr>
			<th>{{ __('document.date') }}</th>
			<td>:</td>
			<td>{{ date('M d, Y', strtotime($detailDocPdf -> date)) }}</td>
		</tr>
		<tr>
			<th>{{ __('document.box_number') }}</th>
			<td>:</td>
			<td>{{ 'Box Number [ '.$detailDocPdf->box->box_number.' ] / Rack Number [ '.$detailDocPdf->box->rack->rack_number.' ] / Division [ '.$detailDocPdf->box->rack->division->name.' ]' }}</td>
		</tr>
		<tr>
			<th>{{ __('document.contains') }}</th>
			<td>:</td>
				<td>
					<ul>
					@foreach($detailDocPdf -> contain as $key => $value)
						<li>{{ $value -> name }}</li>
					@endforeach
					</ul>
				</td>
		</tr>
		<tr>
			<th>{{ __('document.file') }}</th>
			<td>:</td>
			<th>
				<ul>
				@foreach($detailDocPdf->file as $key => $value)
					<li>
						<a href="/data_file/{{ $value->filename}}">{{$value->filename}}</a>
					</li>
				@endforeach
				</ul>
			</th>
		</tr>
		<tr>
			<th>{{ __('document.description') }}</th>
			<td>:</td>
			<td>{{ $detailDocPdf -> description }}</td>
		</tr>
	
	</table>		

<hr style="margin-top: 50px;">
<p><i>Notation* :</i></p>
</body>
</html>






