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
         padding-bottom: 20px;
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
         .rtl {
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
        </style>
    </head>

    <body>
    <div class="invoice-box">
        {{-- Header --}}
        @if($invoice->logo)
            <img src="{{ $invoice->getLogo() }}" alt="logo" height="100">
        @endif
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
               <td colspan="2">
                  <table>
                     <tr>
                        <td class="title"> </td>
                        <td>Invoice #:   <strong>{{ $invoice->getSerialNumber() }}</strong> <br/>
                           Created :  <strong>{{ $invoice->getDate() }}</strong>   </span>
                        </td>
                     </tr>
                  </table>
               </td>
            </tr>
            <tr class="information">
               <td colspan="2">
                  <table>
                     <tr>
                        <td>RED SEAT COURIER LTD<br/> (876)513-2765 <br/> 17
                           Campbell's Blvd, Kgn 11
                        </td>
                        <td><span> {{ $invoice->buyer->name }} </span><br/> <span
                          > {{ $invoice->buyer->email }} </span></td>
                     </tr>
                  </table>
               </td>
            </tr>
            <tr class="heading">
               <td>Description</td>
               <td>Amount</td>
            </tr>
            @foreach($invoice->items as $item)
               <tr class="item">
                  <td> {{ $item->title }} </td>
                <td> <span>     {{ $invoice->formatCurrency($item->sub_total_price) }} </span> </td>
               </tr>
            @endforeach
            <tr class="total">
               <td></td>
               <td>Total: <span >   {{ $invoice->formatCurrency($invoice->total_amount) }}   </span></td>
            </tr>
           
         </table>

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
