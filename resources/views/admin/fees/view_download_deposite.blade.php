@extends('admin.layout.admin_main')
@section('content')
<link href="{{asset('assets/admin/css/deposite.css')}}" rel="stylesheet">
<div class="pagetitle">
   <h1>View Payment</h1>
   <nav>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
         <li class="breadcrumb-item"><a href="{{ route('deposite.index') }}">Payment</a></li>
         <li class="breadcrumb-item"><a href="{{ route('deposite.edit', @$deposite->payment_number) }}">Edit Payment</a></li>
         <li class="breadcrumb-item"><a href="{{ route('deposite.create') }}">Payment History</a></li>
         <li class="breadcrumb-item active">View Payment</li>
      </ol>
   </nav>
</div>
<section>
   <div class="card border-0">
      <div class="card-body pt-4">
         <section class="bg-yellow" id="print_payment_slip">

            <table border="1" cellspacing="0" cellpadding="8" style="width:100%; font-family:Arial, sans-serif; border-collapse: collapse;">
               <tr>
                  <td colspan="2"><strong>Receipt No:</strong> {{ @$deposite->payment_number }}</td>
                  <td colspan="2" style="text-align:right;"><strong>Date:</strong> {{ @$deposite->created_at ? @$deposite->created_at->format('d-m-Y') : '' }}</td>
               </tr>
               <tr>
                  <td style="align-items: center; text-align:center">
                     <img src="{{asset('assets/website/images/logo.png')}}" alt="Logo">
                  </td>
                  <td colspan="3" style="text-align:center;">
                     <h2 style="margin:0;">NATIONAL PUBLIC SCHOOL</h2>
                     <p style="margin:0;">91/A/7, B. L. Saha Road, Kolkata 700053</p>
                     <p style="margin:5px 0;">Fees Deposited for Credit to Account of</p>
                  </td>
               </tr>
               <tr>
                  <td colspan="2"><strong>Student's Name:</strong> {{ @$deposite->student_name }}</td>
                  <td><strong>Class:</strong> {{ @$deposite->studentClass->class_name }}</td>
                  <td><strong>Section:</strong> {{ @$deposite->studentSection->section_name }}</td>
               </tr>
               <tr>
                  <td colspan="2"><strong>Admission No:</strong> {{ @$deposite->studentDetails->admission_number }}</td>
                  <td colspan="2"><strong>Parent's Name:</strong> {{ @$deposite->parents_name }}</td>
               </tr>
               <tr>
                  <td colspan="4"><strong>Address:</strong> {{ @$deposite->address }}</td>
               </tr>
               <tr>
                  <td><strong>Mobile No:</strong> {{ @$deposite->mobile_no }}</td>
                  <td colspan="3"><strong>For the Month of:</strong> {{ @$deposite->month }}, {{ @$deposite->year }}</td>
               </tr>
            
               <tr>
                  <th colspan="3">Fee Details</th>
                  <th>Amount (Rs.)</th>
               </tr>
            
               @if (@$deposite->admission_charges > 0)
               <tr><td colspan="3">Admission Charges</td><td>{{ @$deposite->admission_charges }}</td></tr>
               @endif
               @if (@$deposite->enrolment_fee > 0)
               <tr><td colspan="3">Enrolment Fee</td><td>{{ @$deposite->enrolment_fee }}</td></tr>
               @endif
               @if (@$deposite->tuition_fee > 0)
               <tr><td colspan="3">Tuition Fee</td><td>{{ @$deposite->tuition_fee }}</td></tr>
               @endif
               @if (@$deposite->terminal_fee > 0)
               <tr><td colspan="3">Terminal Fee (1st Installment)</td><td>{{ @$deposite->terminal_fee }}</td></tr>
               @endif
               @if (@$deposite->sports > 0)
               <tr><td colspan="3">Sports Fee</td><td>{{ @$deposite->sports }}</td></tr>
               @endif
               @if (@$deposite->misc_charges > 0)
               <tr><td colspan="3">Misc. Charges</td><td>{{ @$deposite->misc_charges }}</td></tr>
               @endif
               @if (@$deposite->identity_card > 0)
               <tr><td colspan="3">Identity Card</td><td>{{ @$deposite->identity_card }}</td></tr>
               @endif
               @if (@$deposite->scholarship_concession > 0)
               <tr><td colspan="3">Scholarship / Concession</td><td>-{{ @$deposite->scholarship_concession }}</td></tr>
               @endif
            
               <tr>
                  <td colspan="3" style="text-align:right;"><strong>Total</strong></td>
                  <td><strong>Rs.{{ @$deposite->total }}</strong></td>
               </tr>
            
               <tr>
                  <td colspan="4"><strong>Amount in Words:</strong> {{ NumberToWord(@$deposite->total) }}</td>
               </tr>
            
               <tr>
                  <td><strong>Payment Mode:</strong> {{ @$deposite->payment_mode }}</td>
                  @if ($deposite->payment_mode == 'Online')
                  <td colspan="3"><strong>Transaction ID:</strong> {{ @$deposite->transaction_id }}</td>
                  @elseif ($deposite->payment_mode == 'Cheque')
                  <td><strong>Cheque No.:</strong> {{ @$deposite->cheque_no }}</td>
                  <td><strong>Date:</strong> {{ @$deposite->cheque_date ? \Carbon\Carbon::parse(@$deposite->cheque_date)->format('d-m-Y') : '' }}</td>
                  <td><strong>Bank:</strong> {{ @$deposite->bank_name }}</td>
                  <td><strong>Branch:</strong> {{ @$deposite->branch }}</td>
                  @endif
               </tr>
               <tr>
                  <td colspan="4"><strong>Parent's Signature:</strong> ____________________________</td>
               </tr>
            </table>
           </section>
           <div class="card-footer">
               <button class="btn btn-primary" onclick="printPaymentSlip()">Print Payment Slip</button>
           </div>
      </div>
   </div>
   <style>
      table {
         width: 100%;
         border: 1px solid #000;
      }
      th, td {
         border: 1px solid #000;
         padding: 8px;
      }
   </style>
</section>
<script>
   // function printPaymentSlip() {
   //    var printContents = document.getElementById('print_payment_slip').innerHTML;
   //    var printWindow = window.open('', '', 'width=800,height=600');
      
   //    printWindow.document.open();
   //    printWindow.document.write(`
   //       <html>
   //       <head>
   //          <title>Payment Slip</title>
   //          <style>
   //                body { font-family: Arial, sans-serif; padding: 20px; }
   //                .container { width: 100%; max-width: 800px; margin: auto; }
   //                .text-center { text-align: center; }
   //                .mytable { width: 100%; border-collapse: collapse; }
   //                .mytable th, .mytable td { border: 1px solid #000; padding: 8px; text-align: left; }
   //                .full-line, .full-line2 { border-bottom: 1px solid #000; display: inline-block; min-width: 100px; }
   //                .line3 { display: inline-block; border-bottom: 1px solid #000; }
   //          </style>
   //       </head>
   //       <body>
   //          ${printContents}
   //       </body>
   //       </html>
   //    `);
      
   //    printWindow.document.close();
   //    printWindow.focus();
   //    printWindow.print();
   // }
   function printPaymentSlip() {
      var printContents = document.getElementById('print_payment_slip').innerHTML;
      var printWindow = window.open('', '', 'width=800,height=600');

      printWindow.document.open();
      printWindow.document.write(`
         <html>
         <head>
            <title>Payment Slip</title>
            <style>
               @media print {
                  @page {
                     size: A4 portrait;
                     margin: 8mm;
                  }
                  body {
                     margin: 0;
                     padding: 0;
                     font-family: Arial, sans-serif;
                     font-size: 11px;
                  }
                  .copy {
                     width: 100%;
                     margin-bottom: 5mm;
                     page-break-inside: avoid;
                  }
                  .text-center { text-align: center; }
                  .mytable {
                     width: 100%;
                     border-collapse: collapse;
                     margin-top: 5px;
                  }
                  .mytable th, .mytable td {
                     border: 1px solid #000;
                     padding: 4px;
                     font-size: 10px;
                  }
                  p, h2 {
                     margin: 2px 0;
                  }
                  .full-line, .full-line2, .line3 {
                     display: inline-block;
                     border-bottom: 1px solid #000;
                     min-width: 60px;
                  }
               }
            </style>
         </head>
         <body>
            <div class="copy">${printContents}</div>
            </body>
            </html>
            `);
            
      // <div class="copy">${printContents}</div>
      printWindow.document.close();
      printWindow.focus();
      printWindow.print();
   }


</script>
@endsection