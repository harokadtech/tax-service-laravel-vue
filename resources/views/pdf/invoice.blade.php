<!DOCTYPE html>
<html>
<head>
    <title>Invoice Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div style="width: 100%; max-width: 960px; margin: auto">
    <table width="100%">
        <tr style="border-bottom: 1px solid #000000">
            <td><h2>Invoice</h2></td>
{{--            <td style="text-align: right"><h3>Request # {{$taxData->request_id}}</h3></td>--}}
        </tr>
        <tr>
            <td style="padding-bottom: 16px;">
                <strong>Generated To:</strong><br>
                {{$taxData->generated_to}}<br>
            </td>
        </tr>
        <tr>
            <td>
                <strong>Payment Method:</strong><br>
                Visa ending **** 4242<br>
                {{}}
            </td>
            <td style="text-align: right">
                <strong>Request Date:</strong><br>
{{--                {{$taxData->created_at}}<br><br>--}}
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <h3>Tax statement</h3>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <table width="100%" cellpadding="0" cellspacing="0" border="1">
                    <thead>
                    <tr style="background-color: #eee">
                        <th style="text-align: left; padding: 5px 10px;">Item</th>
                        <th style="text-align: center; padding: 5px 10px;">Indicators</th>
                        <th style="text-align: center; padding: 5px 10px;">Value, $</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align: left; padding: 5px 10px;">1</td>
                            <td style="text-align: center; padding: 5px 10px;">All income</td>
                            <td style="text-align: center; padding: 5px 10px;">{{ $taxData->income }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left; padding: 5px 10px;">2</td>
                            <td style="text-align: center; padding: 5px 10px;">Tax rate</td>
                            <td style="text-align: center; padding: 5px 10px;">{{ $taxData->tax_rate }} %</td>
                        </tr>
                        <tr>
                            <td style="text-align: left; padding: 5px 10px;">3</td>
                            <td style="text-align: center; padding: 5px 10px;">The ammount of tax deductions</td>
                            <td style="text-align: center; padding: 5px 10px;">{{ $taxData->deductions }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left; padding: 5px 10px;">4</td>
                            <td style="text-align: center; padding: 5px 10px;">Estimated tax amount</td>
                            <td style="text-align: center; padding: 5px 10px;">{{ $taxData->estimated_tax }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left; padding: 5px 10px;">5</td>
                            <td style="text-align: center; padding: 5px 10px;">Amount of taxes paid</td>
                            <td style="text-align: center; padding: 5px 10px;">{{ $taxData->paid }}</td>
                        </tr>
                        <tr>
                            <td style="text-align: left; padding: 5px 10px;">6</td>
                            <td style="text-align: center; padding: 5px 10px;">Total extra charge</td>
                            <td style="text-align: center; padding: 5px 10px;">{{ $taxData->total_charge }}</td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
