@extends('student.layouts.main')
@section('main-section')
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="text-center">
            <!-- Success Image -->
            <img src="{{ url('../images/success.gif') }}" alt="Success" style="max-width: 250px;">

            <!-- Success Message -->
            <h2 class="mt-3">Enrollment Request Submitted!</h2>
            <p class="lead">Your enrollment request has been submitted successfully.</p>
            <p class="text-muted">Admin will review your request and approve it after payment verification. You will be notified once approved.</p>
            <a href="{{url('student/studentpayments')}}" class="btn btn-primary">View Payment Details</a> 
        </div>
    </div>
    <!-- content-wrapper ends -->
@endsection
