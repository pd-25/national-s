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
                <div class="container">
                   <div class="row" style="margin-bottom:0px;">
                      <div class="span-3">
                         <p><span class="notxt">{{@$deposite->payment_number}}</span></p>
                      </div>
                      <div class="span-6 text-center" style="font-weight:400;font-size:14px;">
                         <p>Fees Deposited for Credit to Account of</p>
                      </div>
                      <div class="span-3">
                         <p class="single-line" style="margin-bottom:0;">Date<strong class="full-line">{{ @$deposite->created_at ? @$deposite->created_at->format('d-m-Y') : '' }}</strong></p>
                      </div>
                   </div>
                   <div class="row" style="margin-bottom:0px;">
                      <div class="span-12 text-center" style="font-weight:400;font-size:16px;">
                         <h2 style="text-transform:uppercase;">National Public School</h2>
                         <p>91/A/7, B. L. Saha Road, kolkata 700053</p>
                      </div>
                   </div>
                   <div class="row">
                      <div class="span-12" style="padding-top:0px;">
                         <p class="single-line">Student's Name<strong class="full-line2">{{@$deposite->student_name}} </strong></p>
                         <p class="three-line"><span>Class<strong class="line3" style="width:30%;">{{@$deposite->studentClass->class_name}}</strong></span><span>Sec.<strong class="line3" style="width:20%;">{{@$deposite->studentSection->section_name}}</strong></span><span>Roll No.<strong class="line3" style="width:25%">{{@$deposite->student_roll}}</strong></span></p>
                         <p class="two-line" style="margin-bottom:5px;"><span>Parent's Name<strong class="line3" style="width:25%;">{{@$deposite->parents_name}}</strong></span> <span>Address<strong class="line3" style="width:50%;">{{@$deposite->address}}</strong></span></p>
                         <p class="two-line" style="margin-bottom:5px;"><span>Mobile No.<strong class="line3" style="width:30%;">{{@$deposite->mobile_no}}</strong></span> <span>For thr Month of <b>{{@$deposite->month}}, </b><strong class="line3" style="width:30%;">{{@$deposite->year}}</strong></span></p>
                         <hr>
                      </div>
                      <div class="span-12">
                         <table class="mytable" style="border:0;margin-top:0px;">
                            <tbody>
                              @if (@$deposite->enrolment_fee > 0)
                              <tr>
                                 <th scope="col">Admission Charges / Enrolment Fee</th>
                                 <th scope="col" style="width:200px;">Rs.{{@$deposite->enrolment_fee}}</th>
                              </tr>
                              @endif
                              @if (@$deposite->tuition_fee > 0)
                              <tr>
                                 <th scope="col">Tuition Fee</th>
                                 <th scope="col" style="width:200px;">Rs.{{@$deposite->tuition_fee}}</th>
                              </tr>
                              @endif
                              @if (@$deposite->terminal_fee > 0)
                               <tr>
                                  <th scope="col">Terminal Fee(1st Installment)</th>
                                  <th scope="col" style="width:200px;">Rs.{{@$deposite->terminal_fee}}</th>
                               </tr>
                              @endif
                               @if (@$deposite->misc_charges > 0)
                               <tr>
                                  <th scope="col">Misc, Charges</th>
                                  <th scope="col" style="width:200px;">Rs.{{@$deposite->misc_charges}}</th>
                               </tr>
                               @endif
                               @if (@$deposite->identity_card > 0)
                               <tr>
                                  <th scope="col">Identity Card</th>
                                  <th scope="col" style="width:200px;border-bottom:2px #000000 solid;">Rs.{{@$deposite->identity_card}}</th>
                               </tr>
                               @endif
                               <tr>
                                  <th scope="col"><strong style="font-size:16px;">Total</strong></th>
                                  <th scope="col" style="width:200px;border-bottom:2px #000000 solid;font-size:16px;padding-bottom:0;">Rs.{{@$deposite->total}}</th>
                               </tr>
                            </tbody>
                         </table>
                      </div>
                      <div class="span-12" style="margin-top:10px;">
                        <p class="three-line"><span>Payment Mode.<strong class="line3" style="width:100px;">{{@$deposite->payment_mode}}</strong>
                            @if ($deposite->payment_mode == 'Online')
                                <span>Transaction Id.<strong class="line3" style="width:300px;">{{@$deposite->transaction_id}}</strong></span>
                            @elseif ($deposite->payment_mode == 'Cheque')
                                <span>Cheque No.<strong class="line3" style="width:300px;">{{@$deposite->cheque_no}}</strong></span> <span>Date<strong class="line3" style="width:100px;">{{ @$deposite->cheque_date ? \Carbon\Carbon::parse(@$deposite->cheque_date)->format('d-m-Y') : '' }}</strong></span><span>Bank Name<strong class="line3" style="width:200px;">{{@$deposite->bank_name}}</strong></span><span>Branch<strong class="line3" style="width:150px;">{{@$deposite->branch}}</strong></span>
                            @endif
                        </p>
                            <p class="single-line">Amount in words<strong class="full-line2">{{NumberToWord(@$deposite->total)}}  </strong></p>
                            <p class="single-line">Parent's Signature<strong class="full-line2"> </strong>
                        
                        </p>
                      </div>
                   </div>
                   <div class="row" style="margin-bottom:0px;">
                      <div class="span-4">
                         <p style="height:20px;"></p>
                         <p><span class="notxt">Parent's Copy</span></p>
                      </div>
                      <div class="span-3" style="text-align:right;">
                         <p style="height:20px;"></p>
                         <p><span class="notxt">Signature</span></p>
                      </div>
                   </div>
                </div>
            </section>
            <div class="mt-4">
                <button class="btn btn-primary" onclick="printPaymentSlip()">Print Slip</button>
            </div>
        </div>
    </div>
</section>
<script>
    // function printPaymentSlip() {
    //     var printContents = document.getElementById('print_payment_slip').innerHTML;
    //     var originalContents = document.body.innerHTML;
    //     document.body.innerHTML = printContents;
    //     window.print();
    //     document.body.innerHTML = originalContents;
    //     location.reload();
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
                body { font-family: Arial, sans-serif; padding: 20px; }
                .container { width: 100%; max-width: 800px; margin: auto; }
                .text-center { text-align: center; }
                .mytable { width: 100%; border-collapse: collapse; }
                .mytable th, .mytable td { border: 1px solid #000; padding: 8px; text-align: left; }
                .full-line, .full-line2 { border-bottom: 1px solid #000; display: inline-block; min-width: 100px; }
                .line3 { display: inline-block; border-bottom: 1px solid #000; }
            </style>
        </head>
        <body>
            ${printContents}
        </body>
        </html>
    `);
    
    printWindow.document.close();
    printWindow.focus();
    printWindow.print();
}

    </script>
@endsection