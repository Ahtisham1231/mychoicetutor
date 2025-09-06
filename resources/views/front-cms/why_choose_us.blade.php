@extends('front-cms.layouts.main')
@section('main-section')
<section class="bannerSec tutBann">
    <div class="container-fluid">
        <div class="tutorHeader">
            <h1 class="mb-5">
                Exceptional tutoring at <br>an affordable price
            </h1>

            <div class="text-center">
                <div class="abc">
                    <div class="flex-container">
                        <div class="charcol">One free trial class<span class="dash px-2">- </span></div>
                        <div class="charcol">One-on-one lessons<span class="dash px-2">- </span></div>
                        <div class="charcol">Flexible scheduling<span class="dash px-2">-</span></div>
                        <div class="charcol">Lecture Recording</div>
                    </div>
                </div>
                <a href="/findatutor"> <button class="btn search-tutor mt-4">Book free trial class today</button></a>
            </div>

        </div>
    </div>
    </div>
</section>
<!-- tutor section -->
<section class="mt-5">
    <div class="container ">

        <div class="whyChooseUsouter">
            <div class="whyChooseUsTop">
                <div class="row ">
                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                        <div class="whyChooseUsCol">
                            <h3>Why Choose My Choice Tutor?</h3>
                            <p class="charcol">My Choice Tutor is designed to connect students with qualified and dedicated tutors who can guide them towards academic success. We focus on flexibility, personalized learning, and reliable support, ensuring that every student gets the right tutor to match their learning needs, schedule, and study goals.
                            </p>

                        </div>

                    </div>

                    <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12 getstartedBtnPosition">
                        <div class="whyChooseUsCol">
                            <a href="student/register"> <button>Get started</button></a>
                        </div>
                    </div>

                    <!-- <div class="Bg_purple1">
                        <div class="p-5">
                        <h3>Why choose us?</h3>

                        <p class="charcol">Education is the best investment one can make in their children’s lives. It’s
                            crucial to be well-informed before selecting tutors and the type of tutoring they receive.
                        </p>
                        <a href="findatutor">    <button class="btn search-tutor">Book now</button></a>

                        </div>
                        
                        <img src="{{ url('frontendnew/img/whychoose1.png') }}" width="100%" alt="">
                    </div> -->


                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 order1"  >

                <div class="Bg_purple">
                    <div class="p-5">
                        <h3>Personalized Learning Experience</h3>

                        <p>At My Choice Tutor, we understand that every student learns differently. Our platform connects learners with tutors who adapt lessons to individual strengths, weaknesses, and goals. Whether you need extra support in a subject or want to excel further, our tutors design study plans to match your pace and style.</p>
                        <a href="findatutor"> <button class="btn search-tutor">Book now</button></a>

                    </div>

                    <img src="{{ url('frontendnew/img/OnefretrialClass.png') }}" width="100%" alt="">
                </div>

            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 order2">

                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="boeder_Bg">
                            <div class="p-5">
                                <h3>Flexible Scheduling Options</h3>

                                <p class="charcol">We make learning stress-free with flexible scheduling that fits your routine. Students can book sessions at convenient times without disrupting daily activities. Our tutors are available across different time slots, making it easy for school, college, or working students to balance studies with other responsibilities.</p>


                            </div>


                        </div>
                    </div>

                    <div class="col-12">
                        <div class="boeder_Bg">
                            <div class="p-5">
                                <h3>Qualified and Professional Tutors</h3>

                                <p class="charcol">Our tutors are carefully selected for their expertise, professionalism, and passion for teaching. Each tutor undergoes a strict selection process to ensure they can deliver high-quality education. With My Choice Tutor, you learn from reliable mentors who focus on building knowledge, confidence, and long-term academic growth.
                                </p>

                            </div>
                            <img src="{{ url('frontendnew/img/Engage_and_Excel.png') }}" width="100%" alt="">

                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 order3">
                <div class="boeder_Bg">
                    <div class="p-5">
                        <h3>Continuous Support and Guidance</h3>

                        <p class="charcol">My Choice Tutor doesn’t stop at lessons; we provide continuous support to ensure consistent progress. Tutors guide students with revision strategies, exam preparation tips, and academic advice. With constant encouragement and feedback, learners gain the motivation and confidence they need to achieve their academic and career goals.</p>

                    </div>
                    <img src="{{ url('frontendnew/img/One-on-one-lessons.png') }}" width="100%" alt="">
                </div>

            </div>

        </div>

    </div>

</section>
@endsection