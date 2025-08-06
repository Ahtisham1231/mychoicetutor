@extends('tutor.layouts.main')
@section('main-section')

<div class="main-content">
    <style>
        .profile-pic-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .profile-pic-wrapper img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #ccc;
        }

        #file {
            display: none;
        }

        #uploadBtn {
            margin-top: 10px;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            #uploadBtn {
                display: block !important;
                position: static;
                width: auto;
                background-color: #007bff;
                color: white;
                text-align: center;
            }
        }

        .alert-dismissible {
            width: auto;
            margin: 5px;
        }
    </style>

    <div class="page-content">
        <div class="container-fluid">

            @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            @if (Session::has('fail'))
                <div class="alert alert-danger">{{ Session::get('fail') }}</div>
            @endif

            <div class="card mx-auto" style="max-width: 700px;">
                <form action="{{ route('tutor.updateprofiledata') }}" enctype="multipart/form-data" method="POST">
                    @csrf

                    <div class="card-header bg-white">
                        <div class="row mb-4">
                            <div class="col-12 d-flex flex-column align-items-center justify-content-center">
                                <div class="profile-pic-wrapper position-relative">
                                    <img src="{{ url('images/tutors/profilepics', $tutorpd->profile_pic ?? '1703078631.png') }}"
                                        id="photo"
                                        alt="Profile Photo">

                                    <input type="file" id="file" name="file" onchange="validateImage()">
                                    <label for="file" id="uploadBtn" class="btn btn-sm btn-primary">
                                        <i class="ri-camera-line"></i> Choose Photo
                                    </label>

                                    <span class="text-danger" id="file-error"></span>
                                </div>
                            </div>

                            <div class="col-12 text-center mt-3">
                                <h4>{{ $tutorpd->name ?? session('userid')->name }}</h4>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row g-3">
                            <div class="form-group col-md-6">
                                <label>Full Name<i style="color:red">*</i></label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ $tutorpd->name ?? session('userid')->name }}" disabled>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Gender</label>
                                <select class="form-control" name="gender">
                                    <option value="1" {{ $tutorpd->gender == "1" ? 'selected' : '' }}>Male</option>
                                    <option value="2" {{ $tutorpd->gender == "2" ? 'selected' : '' }}>Female</option>
                                    <option value="3" {{ $tutorpd->gender == "3" ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Qualification</label>
                                <input type="text" class="form-control" name="qualification"
                                    value="{{ $tutorpd->qualification ?? '' }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Experience</label>
                                <input type="text" class="form-control" name="experience"
                                    value="{{ $tutorpd->experience ?? '' }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Certification</label>
                                <input type="text" class="form-control" name="certification"
                                    value="{{ $tutorpd->certification ?? '' }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Mobile</label>
                                <input type="text" class="form-control"
                                    value="{{ $tutorpd->mobile ?? session('userid')->mobile }}" disabled>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Secondary Mobile</label>
                                <input type="text" class="form-control" name="secmobile"
                                    value="{{ $tutorpd->secondary_mobile ?? '' }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input type="email" class="form-control"
                                    value="{{ $tutorpd->email ?? session('userid')->email }}" disabled>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Headline</label>
                                <input type="text" class="form-control" name="headline"
                                    value="{{ $tutorpd->headline ?? '' }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label>About Me</label>
                                <input type="text" class="form-control" name="goals"
                                    value="{{ $tutorpd->goal ?? '' }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Other Details</label>
                                <input type="text" class="form-control" name="details1"
                                    value="{{ $tutorpd->detail_1 ?? '' }}">
                            </div>

                            <div class="form-group col-md-6" hidden>
                                <label>Details 2</label>
                                <input type="text" class="form-control" name="details2"
                                    value="{{ $tutorpd->detail_2 ?? '' }}">
                            </div>

                            <div class="form-group col-md-6" hidden>
                                <label>Details 3</label>
                                <input type="text" class="form-control" name="details3"
                                    value="{{ $tutorpd->detail_3 ?? '' }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Rate Per Hour (£)<i style="color:red">*</i></label>
                                <input type="text" class="form-control" name="rateperhour"
                                    value="{{ $tutorpd->rateperhour ?? 0 }}" disabled>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Intro Video Link <span style="font-size: 10px; color:red;">(e.g., https://www.youtube.com/embed/abc123)</span></label>
                                <input type="text" class="form-control" name="introvideolink"
                                    value="{{ $tutorpd->intro_video_link ?? '' }}">
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fa fa-check"></i> Update
                            </button>
                            <p class="mt-2 text-danger" style="font-size:12px">* Make sure to update the data before going down.</p>
                        </div>
                    </div>
                </form>

                

                
            </div>
        </div>
    </div>

    {{-- JS Scripts --}}
    <script>
        const imgDiv = document.querySelector('.profile-pic-wrapper');
        const img = document.querySelector('#photo');
        const file = document.querySelector('#file');
        const uploadBtn = document.querySelector('#uploadBtn');

        // Only show on hover for desktop
        if (window.innerWidth > 768) {
            imgDiv.addEventListener('mouseenter', function () {
                uploadBtn.style.display = "block";
            });

            imgDiv.addEventListener('mouseleave', function () {
                uploadBtn.style.display = "none";
            });
        }

        // Preview uploaded image
        file.addEventListener('change', function () {
            const choosedFile = this.files[0];
            if (choosedFile) {
                const reader = new FileReader();
                reader.addEventListener('load', function () {
                    img.setAttribute('src', reader.result);
                });
                reader.readAsDataURL(choosedFile);
            }
        });

        function validateImage() {
            const fileInput = document.getElementById('file');
            const filePath = fileInput.value;
            const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
            const file = fileInput.files[0];
            const maxSize = 2 * 1024 * 1024;
            const errorElement = document.getElementById('file-error');

            errorElement.textContent = '';

            if (!allowedExtensions.exec(filePath)) {
                errorElement.textContent = 'Only .jpg, .jpeg, and .png files are allowed';
                fileInput.value = '';
                return false;
            }

            if (file.size > maxSize) {
                errorElement.textContent = 'File size must not exceed 2MB';
                fileInput.value = '';
                return false;
            }

            return true;
        }
    </script>
</div>
@endsection
