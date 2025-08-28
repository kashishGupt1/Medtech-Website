@extends('layouts.layout') @section('content')
      <section class="page-title-section top-position1 bg-img cover-background left-overlay-dark" data-overlay-dark="6"
         style="padding: 30px 0;">
         <div class="container">
             <div class="page-title text-center">
                 <div class="row">
                     <div class="col-md-12">
                         <h1>Thank You</h1>
                     </div>
                 </div>
             </div>
         </div>
     </section>
     
    <section class="border-top">
         <div class="container">
             <div class="row about-style2">
                 <div class="col-lg-12 wow fadeIn text-center" data-wow-delay="400ms">
                     <!--<h2 class="mb-1-6 text-center">Thank you!</h2>-->
                     <p> Your quote request has been submitted successfully.</p>
                     <p> Our team will contact you shortly with the details. </p>
                    <p> Need immediate assistance? Email us at <b>{{$user->email}}</b> or contact us <b>{{$user->contact_no1}}</b></p>
                 </div>
             </div>
         </div>
     </section>
 
@endsection