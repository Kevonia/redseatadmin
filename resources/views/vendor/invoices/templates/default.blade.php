<!DOCTYPE html>
<html lang="en">
    <head>
        <title>{{ $invoice->name }}</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

        <link rel="stylesheet" href="{{ public_path('vendor/invoices/bootstrap.min.css') }}">

        <style type="text/css" media="screen">
         
            html {
                margin: 0;
            }
            body {
                font-size: 10px;
            
            }
            body, h1, h2, h3, h4, h5, h6, table, th, tr, td, p, div {
                line-height: 1.1;
            }
            .party-header {
                font-size: 1.5rem;
                font-weight: 400;
            }
            .total-amount {
                font-size: 12px;
                
                
                font-weight: 700;
            }
            html {
                margin: 0;
            }
            body {
                font-size: 10px;
            
            }
            body, h1, h2, h3, h4, h5, h6, table, th, tr, td, p, div {
                line-height: 1.1;
            }
            .party-header {
                font-size: 1.5rem;
                font-weight: 400;
            }
            .total-amount {
                font-size: 12px;
                
                
                font-weight: 700;
            }
 .invoice-box {
         max-width: 800px;
         margin: auto;
         padding: 30px;
         border: 1px solid #eee;
         box-shadow: 0 0 10px rgba(0, 0, 0, .15);
         font-size: 16px;
         line-height: 24px;
         font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
         color: #555;
         }
         .invoice-box table {
         width: 100%;
         line-height: inherit;
         text-align: left;
         }
         .invoice-box table td {
         padding: 5px;
         vertical-align: top;
         }
         .invoice-box table tr td:nth-child(2) {
         text-align: right;
         }
         .invoice-box table tr.top table td {
         padding-bottom: 0;
         }
         .invoice-box table tr.top table td.title {
         font-size: 45px;
         line-height: 45px;
         color: #333;
         }
         .invoice-box table tr.information table td {
         padding-bottom: 40px;
         }
         .invoice-box table tr.heading td {
         background: #eee;
         border-bottom: 1px solid #ddd;
         font-weight: bold;
         }
         .invoice-box table tr.details td {
         padding-bottom: 20px;
         }
         .invoice-box table tr.item td {
         border-bottom: 1px solid #eee;
         }
         .invoice-box table tr.item.last td {
         border-bottom: none;
         }
         .invoice-box table tr.total td:nth-child(2) {
         border-top: 2px solid #eee;
         font-weight: bold;
         }
         @media only screen and (max-width: 600px) {
         .invoice-box table tr.top table td {
         width: 100%;
         display: block;
         text-align: center;
         }
         .invoice-box table tr.information table td {
         width: 100%;
         display: block;
         text-align: center;
         }
         }
         /** RTL **/
         .rtlrtl {
         direction: rtl;
         font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial,
         sans-serif;
         }
         .rtl table {
         text-align: right;
         }
         .rtl table tr td:nth-child(2) {
         text-align: left;
         }
		 .page-title {
	font-size: 2.5rem;
	font-weight: 700;
	margin-top: 0;
	margin-bottom: 0.75em;
}

.sans { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Helvetica, "Apple Color Emoji", Arial, sans-serif, "Segoe UI Emoji", "Segoe UI Symbol"; }

.highlight-red {
    color: rgb(224,62,62);
}

.block-color-gray_background {
	background: rgb(235,236,237);
}
.callout {
	border-radius: 3px;
	padding: 1rem;
}
.icon {
    display: inline-block;
    max-width: 1.2em;
    max-height: 1.2em;
    text-decoration: none;
    vertical-align: text-bottom;
    margin-right: 0.5em;
}

.column-list {
    display: flex;
    justify-content: space-between;
}
mark {
	background-color: transparent;
}


        </style>
    </head>

    <body>
	
    <div class="invoice-box sans">
	<header><h1 class="page-title">Invoice {{ $invoice->buyer->name }} </h1></header>
	
        {{-- Header --}}
        @if($invoice->logo)
            <img src="{{ $invoice->getLogo() }}" alt="logo" height="100">
        @endif
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
               <td colspan="2">
                  <table>
				  	<tr >
               <td>Invoice number:   <strong>{{ $invoice->getSerialNumber() }}</td>
             
            </tr>
			  	<tr>
               <td>Date of issue:  <strong>{{ $invoice->getDate() }}</strong></td>
             
            </tr>
				<tr>
               <td> Date due:    <strong>{{ $invoice->getDate() }} </strong>   </span></td>
             
            </tr>
                     
                  </table>
               </td>
            </tr>
            <tr class="information">
               <td colspan="2">
                  <table >
                     <tr>
					     From
                        <td  class="highlight-red">  Red Seat Courier Ltd
						<br/>  17 Campbells Blvd
						<br/>  Kingston 11
						<br/>  (876)513-2765  
						<br/>     ship@rscja.com
                        </td> 
						
                        <td>
                             Bill to

	<br/>					
						   <span> {{ $invoice->buyer->name }} </span><br/> <span
                          > {{ $invoice->buyer->email }} </span></td>
                     </tr>
                  </table>
               </td>
            </tr>
			<tr> 
			
			   <table style="width:100%">
			   
			<tr class="heading">
               <td>Description</td>
               <td>Weight </td>
			   <td>Freight	Fees</td>
                <td>Fees</td>
			   <td>Duty</td>
			   <td>Total</td>
            </tr>
			 @foreach($invoice->items as $item)
               <tr class="item">
                  <td> {{ $item->title }} </td>
                <td> <span>      {{ $item->quantity }}  </span> </td>
				<td> <span>   {{ $invoice->formatCurrency($item->sub_total_price) }}   </span> </td>
				<td> <span>     {{ $invoice->formatCurrency($item->units) }} </span> </td>
                <td> <span>     {{ $invoice->formatCurrency(0) }} </span> </td>
			<td> <span>     {{ $invoice->formatCurrency($item->sub_total_price) }} </span> </td>
               </tr>
            @endforeach
            <tr class="total">
               <td></td>
               <td>Total: <span >  {{$invoice->formatCurrency($invoice->total_amount)}}  </span></td>
            </tr>
 
</table>
			   
			</tr>

           
         </table>
         <figure class="block-color-gray_background callout" style="white-space:pre-wrap;display:flex" id="c3debd5f-7d81-4cc9-8f98-ee91c1269461"><div style="font-size:1.5em"></div><div style="width:100%"> <a href="https://paypal.me/kovecmedia"><mark class="highlight-teal"><strong>Pay invoice</strong></mark></a></div></figure>
         <div id="75323b49-1350-4dfd-b4a2-7b4e58e6ca7c" class="column-list"><div id="26cef508-b035-4c68-aed7-ce3067f97307" style="width:75%" class="column"><p id="c46aed9e-3b36-464a-bb92-92dd0fb89239" class="">Are you comfortable in the red seat?  <br/> <mark class="highlight-gray">talk to us at cs@rscja.com or call at +1876.513-2765</mark></p><p id="814781b3-c647-4afc-b20c-4897243f3ed7" class="">
</p></div>
</p></div></div>

        <script type="text/php">
            if (isset($pdf) && $PAGE_COUNT > 1) {
                $text = "Page {PAGE_NUM} / {PAGE_COUNT}";
                $size = 10;
                $font = $fontMetrics->getFont("Verdana");
                $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
                $x = ($pdf->get_width() - $width);
                $y = $pdf->get_height() - 35;
                $pdf->page_text($x, $y, $text, $font, $size);
            }
        </script>
    </body>
</html>
