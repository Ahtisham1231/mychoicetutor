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
            <h2 class="mt-3">Success!</h2>
            <p class="lead">Your purchase has been completed successfully.</p>
            <a href="{{url('student/studentpayments')}}" class="btn btn-primary">View Payment Details</a> 
        </div>
    </div>
    <!-- content-wrapper ends -->
@endsection
