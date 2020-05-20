<body>
<h1>Hello, {{\Illuminate\Support\Facades\Auth::user()->name}}</h1>
<p>Here your tax statement:</p>
@include('pdf.invoice', ['taxData' => $taxData])
<p>Have a nice day! Thank you for using our services.</p>
</body>


