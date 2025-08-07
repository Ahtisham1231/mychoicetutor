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
                                <label>Headline</label>
                                <input type="text" class="form-control char-limit" name="headline"
                                    value="{{ $tutorpd->headline ?? '' }}" maxlength="200" data-limit="200">
                                <small class="text-muted char-count-feedback"></small>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Qualification</label>
                                <input type="text" class="form-control char-limit" name="qualification"
                                    value="{{ $tutorpd->qualification ?? '' }}" maxlength="200" data-limit="200">
                                <small class="text-muted char-count-feedback"></small>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Experience</label>
                                <input type="text" class="form-control char-limit" name="experience"
                                    value="{{ $tutorpd->experience ?? '' }}" maxlength="200" data-limit="200">
                                <small class="text-muted char-count-feedback"></small>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Certification</label>
                                <input type="text" class="form-control char-limit" name="certification"
                                    value="{{ $tutorpd->certification ?? '' }}" maxlength="200" data-limit="200">
                                <small class="text-muted char-count-feedback"></small>
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
                                <label>Rate Per Hour (£)<i style="color:red">*</i></label>
                                <input type="text" class="form-control" name="rateperhour"
                                    value="{{ $tutorpd->rateperhour ?? 0 }}" disabled>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Other Details</label>
                                <textarea class="form-control" name="details1" rows="4" data-limit="200">{{ $tutorpd->detail_1 ?? '' }}</textarea>
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
                                <label>About Me</label>
                                <textarea class="form-control " name="goals" rows="4" data-limit="200">{{ $tutorpd->goal ?? '' }}</textarea>
                                <small class="text-muted word-count-feedback"></small>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Intro Video Link </br> <span style="font-size: 10px; color:red;">(e.g., https://www.youtube.com/embed/abc123)</span></label>
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


                <hr>

                    {{-- Achievement Add/Update --}}
                    <h3 class="text-center my-5"><u>Class/Grade Mapping</u></h3>

                    <form action="{{ route('tutor.classmapping') }}" method="POST" name="classmapping">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="">Class<i style="color:red">*</i></label>
                                <select type="text" class="form-control" id="classname" name="classname" onchange="fetchSubjects();" required>
                                    <option value="">--Select--</option>
                                    @foreach ($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <input type="hidden" id="id" name="id" class="form-group">
                                <label for="">Subject<i style="color:red">*</i></label>
                                <select type="text" class="form-control" id="subject" name="subject" required>

                                </select>
                            </div>
                            <div class="form-group col-md-3 text-right" style="margin-top: 33px;">
                                <button class=" btn btn-sm btn-success text-white" type="submit"><span class="fa fa-plus"></span> Add</button>
                            </div>
                        </div>
                    </form>
                    <hr>

                    <table class="table table-hover table-striped align-middlemb-0 table-responsive">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Class</th>
                                <th>Subject</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tutorclassmappinggrid">
                            @foreach ($tutorsub as $classmapping)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-wrap">{{ $classmapping->class }}</td>
                                <td class="text-wrap">{{ $classmapping->subject }}</td>
                                <td><a href="{{url('tutor/classmappingdelete')}}/{{$classmapping->id}}"><button class="btn-sm btn btn-danger" type="button"><span class="fa fa-trash"></span> Delete</button></a></td>
                            </tr>
                            @endforeach
                            <tr></tr>
                        </tbody>
                    </table>

                    <hr>

                    {{-- Achievement Add/Update --}}
                    <h3 class="text-center my-5"><u>Achievement</u></h3>

                    <form action="{{ route('tutor.tutoracadd') }}" method="POST" name="achie">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="">Name<i style="color:red">*</i></label>
                                <input type="text" class="form-control" id="achievementName" name="achievementName" placeholder="Enter Details" required>
                                <span class="text-danger">
                                    @error('achievementName')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">Description<i style="color:red">*</i></label>
                                <input type="text" class="form-control" id="achievementDesc" name="achievementDesc" placeholder="Enter Details" required>
                                <span class="text-danger">
                                    @error('achievementDesc')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">Date</label>
                                <input type="date" class="form-control" id="achDate" name="achDate">
                            </div>
                            <div class="form-group col-md-3 text-right" style="margin-top: 33px;">
                                <button class=" btn btn-sm btn-success text-white" type="submit"><span class="fa fa-plus"></span> Add</button>
                            </div>
                        </div>
                    </form>
                    <hr>

                    <table class="table table-bordered table-responsive">
                        <thead class="">
                            <tr>
                                <th>S.No.</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="achievementGrid">
                            @foreach ($achievement as $achievement)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-wrap">{{ $achievement->name }}</td>
                                <td class="text-wrap">{{ $achievement->description }}</td>
                                <td>{{ \Carbon\Carbon::parse($achievement->date)->format('j-F-Y') }}</td>
                                <td><a href="{{url('tutor/tutoracdel')}}/{{$achievement->id}}"><button class="btn-sm btn btn-danger" type="button"><span class="fa fa-trash"></span> Delete</button></a></td>
                            </tr>
                            @endforeach
                            <tr></tr>
                        </tbody>
                    </table>

                    <hr>

                    <h3 class="text-center my-5"><u>Skills</u></h3>
                    <div class="form">
                        <form action="{{route('tutor.update-skills')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-9">
                                    <input type="text" class="form-control" oninput="validateInput(this)" name="skills" value="{{ $tutorpd->keywords ?? '' }}" placeholder="Enter skills separated with comma (Example: Java Expert, Python Expert)">
                                    @error('skills')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-3 text-right" style="margin-top: 4px;">
                                    <button class="btn btn-sm btn-success text-white" type="submit"><span class="fa fa-plus"></span> Add</button>
                                </div>
                            </div>
                        </form>
                        <p style="color:red; font-size:12px"> * Please enter all the skills separated with comma. After that click on <b>+Add</b> button</p>
                        <hr>

                        @if($tutorpd->keywords ?? '')
                        <div class="row">
                            @foreach ($skillsArray  as $item)
                                <div class="alert alert-primary alert-dismissible fade show skill-preview" data-skill="{{ $item }}">
                                    <button type="button" class="btn-close remove-skill" data-bs-dismiss="alert"></button>
                                    <strong>{{ $item }}</strong>
                                </div>
                            @endforeach
                        </div>
                        @endif
                    </div>


                
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

        function fetchSubjects() {

            var classId = $('#classname option:selected').val();
            $("#subject").html('');
            $.ajax({
                url: "{{ url('fetchsubjects') }}",
                type: "POST",
                data: {
                    class_id: classId,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(result) {
                    $('#subject').html('<option value="">-- Select Type --</option>');
                    $.each(result.subjects, function(key, value) {
                        $("#subject").append('<option value="' + value
                            .id + '">' + value.name + '</option>');
                    });
                }
            });
        };
    </script>
    
    <script>
        var achievementArray = [];

        function addNewAchievement() {
            achieveObj = {};
            achieveObj.achieveName = $("#achievementName").val();
            achieveObj.achieveDesc = $("#achievementDesc").val();
            achieveObj.achieveDate = $("#achDate").val();
            achievementArray.push(achieveObj);

            bindAchieveArray();

            $("#achievementName").val("");
            $("#achievementDesc").val("");
            $("#achDate").val("");

        }

        function bindAchieveArray() {
            var p = 0;
            var strRow = "";
            for (var c = 0; c < achievementArray.length; c++) {
                p++;
                strRow += `<tr>`;
                strRow += `<td >${p}</td>`;
                strRow += `<td>${achievementArray[c].achieveName}</td>`;
                strRow += `<td>${achievementArray[c].achieveDesc}</td>`;
                strRow += `<td>${achievementArray[c].achieveDate}</td>`;
                strRow += `<td><button class="btn-danger" href="#" onclick="removeAchievement(${p})" ></i>Remove</a></td>`;
                strRow += `</tr>`;
            }
            document.getElementById("achievementGrid").innerHTML = strRow;
        }

        function removeAchievement(objToRemove) {


        }
</script>

<script>

    const imgDiv = document.querySelector('.profile-pic-div');
    const img = document.querySelector('#photo');
    const file = document.querySelector('#file');
    const uploadBtn = document.querySelector('#uploadBtn');

    //if user hover on img div

    imgDiv.addEventListener('mouseenter', function() {
        uploadBtn.style.display = "block";
    });

    //if we hover out from img div

    imgDiv.addEventListener('mouseleave', function() {
        uploadBtn.style.display = "none";
    });

    //lets work for image showing functionality when we choose an image to upload

    //when we choose a foto to upload

    file.addEventListener('change', function() {
        //this refers to file
        const choosedFile = this.files[0];

        if (choosedFile) {

            const reader = new FileReader(); //FileReader is a predefined function of JS

            reader.addEventListener('load', function() {
                img.setAttribute('src', reader.result);
            });

            reader.readAsDataURL(choosedFile);
        }
    });


    function fetchSubjects() {

        var classId = $('#classname option:selected').val();
        $("#subject").html('');
        $.ajax({
            url: "{{ url('fetchsubjects') }}",
            type: "POST",
            data: {
                class_id: classId,
                _token: '{{ csrf_token() }}'
            },
            dataType: 'json',
            success: function(result) {
                $('#subject').html('<option value="">-- Select Type --</option>');
                $.each(result.subjects, function(key, value) {
                    $("#subject").append('<option value="' + value
                        .id + '">' + value.name + '</option>');
                });

            }

        });

    };
</script>
        <script>
    function validateInput(inputElement) {
        // Get the input value
        var inputValue = inputElement.value;


        // Remove any characters that are not alphabets, numbers, or #
        var sanitizedValue = inputValue.replace(/[^a-zA-Z0-9#, ]/g, '');

        // Update the input field with the sanitized value
        inputElement.value = sanitizedValue;
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $(".remove-skill").click(function () {
            var skillToRemove = $(this).closest(".skill-preview").data("skill"); // Get the skill name from data attribute
            var currentSkills = $("input[name='skills']").val(); // Get the current skills from the input field
            var skillsArray = currentSkills.split(","); // Split the skills into an array

            // Remove the skill from the array
            var index = skillsArray.indexOf(skillToRemove);
            if (index !== -1) {
                skillsArray.splice(index, 1);
            }
            $("input[name='skills']").val(skillsArray.join(", "));
        });
    });
</script>
<script>
    function validateImage() {

    const fileInput = document.getElementById('file');
    const filePath = fileInput.value;
    const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
    const file = fileInput.files[0];
    const maxSize = 2 * 1024 * 1024; // 2MB in bytes
    const errorElement = document.getElementById('file-error');

    // Reset previous error message
    errorElement.textContent = '';

    // Check file extension
    if (!allowedExtensions.exec(filePath)) {
        errorElement.textContent = 'Only .jpg, .jpeg, and .png files are allowed';
        fileInput.value = '';
        return false;
    }

    // Check file size
    if (file.size > maxSize) {
        errorElement.textContent = 'File size must not exceed 2MB';
        fileInput.value = '';
        return false;
    }

    return true;
}
</script>
<script>
    // Flag to track changes in any form
    let isFormDirty = false;

    // Select all forms on the page
    const forms = document.querySelectorAll('form');

    // Loop through each form
    forms.forEach(form => {
        const inputs = form.querySelectorAll('input, select, textarea');

        // Attach 'input' event listeners to each form's inputs
        inputs.forEach(input => {
            input.addEventListener('input', () => {
                isFormDirty = true;
                // alert("Form has unsaved changes!"); // Just to test that the event is triggered
            });
        });

        // Reset the flag when any form is submitted
        form.addEventListener('submit', () => {
            isFormDirty = false;
        });
    });

    // Warn user before they leave the page if any form has unsaved changes
    window.addEventListener('beforeunload', (event) => {
        if (isFormDirty) {
            event.preventDefault();
            event.returnValue = 'You have unsaved changes, do you really want to leave?';
        }
    });
</script>
<script>
    document.querySelectorAll('.word-limit').forEach(function (field) {
        const limit = parseInt(field.getAttribute('data-limit'));
        let feedback;

        // Create feedback element if not already present
        if (field.nextElementSibling && field.nextElementSibling.classList.contains('word-count-feedback')) {
            feedback = field.nextElementSibling;
        } else {
            feedback = document.createElement('small');
            feedback.classList.add('text-muted', 'word-count-feedback');
            field.parentNode.appendChild(feedback);
        }

        const updateWordCount = () => {
            let words = field.value.trim().split(/\s+/).filter(word => word.length > 0);
            if (words.length > limit) {
                // Trim to limit
                field.value = words.slice(0, limit).join(' ');
                words = words.slice(0, limit);
            }

            feedback.textContent = `${words.length}/${limit} words`;
        };

        // Listen to input and paste
        field.addEventListener('input', updateWordCount);
        field.addEventListener('paste', function (e) {
            // Delay so value is available
            setTimeout(updateWordCount, 0);
        });

        // Initialize on page load
        updateWordCount();
    });
</script>

</div>
@endsection
