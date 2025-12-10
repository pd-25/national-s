<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@php
    $user = auth()->guard('admin')->user();
@endphp
<script>
    $(document).ready(function() {
        var LoggedInUser = @json($user);
        var menuAuthrisePermission = LoggedInUser.role_permission || [];
        $("li[id]").hide();
        menuAuthrisePermission.forEach(function(key) {
            $("#" + key).show();
            $("#" + key).parents("ul").closest("li").show();
        });
    });

    Notiflix.Notify.init({
        position: 'right-top',
        timeout: 2500,
        clickToClose: true,
    });

    Notiflix.Confirm.init({
        titleColor: "#000",
        okButtonBackground: "#dc3545",
        cancelButtonBackground: "#808080",
    });

    document.addEventListener('DOMContentLoaded', function() {
        var showConfirmButtons = document.querySelectorAll('.show_confirm');
        showConfirmButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                var form = button.closest('form');
                var name = button.getAttribute('data-name');
                event.preventDefault();
                swal({
                        title: "Delete Confirmation",
                        text: "Once deleted, you will not be able to recover this data file!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            form.submit();
                        } else {
                            swal("Your data file is safe!");
                        }
                    });
            });
        });

        $('#fullscreenBtn').click(function() {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen().then(() => {
                    $('#fullscreenIcon').removeClass('bi-arrows-fullscreen').addClass(
                        'bi-fullscreen-exit');
                });
            } else {
                document.exitFullscreen().then(() => {
                    $('#fullscreenIcon').removeClass('bi-fullscreen-exit').addClass(
                        'bi-arrows-fullscreen');
                });
            }
        });
    });

    function reload() {
        window.location.reload();
    }

    function getStudent() {
        var session_id = $('#session_id').val();
        var class_id = $('#class_id').val();
        var section_id = $('#section_id').val();

        $('#student_id_bind').empty();
        $('#student_id_bind').append('<option value="">--Select Student--</option>');

        if (session_id && class_id && section_id) {
            return new Promise(function(resolve, reject) {
                $.ajax({
                    url: "{{ route('attendance.studentsListUsingSessionClassSection') }}",
                    type: 'Post',
                    data: {
                        session_id: session_id,
                        class_id: class_id,
                        section_id: section_id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        $.each(data, function(index, item) {
                            $('#student_id_bind').append('<option value="' + item
                                .student_details.id + '">' + item.student_details
                                .student_name + ' (' + item.student_details
                                .admission_number + ') </option>');
                        });
                        $('.js-example-basic-single').select2();
                        resolve();
                    },
                    error: function(err) {
                        console.error('Error fetching sections:', err.responseText);
                    }
                });
            });
        }
    };

    $('#class_id').change(function() {
        var classId = $(this).val();
        $('#section_id').empty();
        $('#section_id').append('<option value="">Select Section</option>');
        if (classId) {
            $.ajax({
                url: '/admin/get-arms-by-class-id/' + classId,
                type: 'GET',
                success: function(data) {
                    if (data.length == 1) {
                        $.each(data, function(index, item) {
                            $('#section_id').append('<option value="' + item.id +
                                '" selected>' + item.section_name + '</option>');
                        });
                        getStudent();
                        GetFeeSettingsData();
                    } else {
                        $.each(data, function(index, item) {
                            $('#section_id').append('<option value="' + item.id + '">' +
                                item.section_name + '</option>');
                        });
                    }
                    $(document).trigger('sectionsLoaded');
                },
                error: function() {
                    console.error('Error fetching sections');
                }
            });
        }
    });

    $('#class_id_modal').change(function() {
        var classId = $(this).val();
        $('#section_id_modal').empty();
        $('#section_id_modal').append('<option value="">Select Section</option>');
        if (classId) {
            $.ajax({
                url: '/admin/get-arms-by-class-id/' + classId,
                type: 'GET',
                success: function(data) {
                    $.each(data, function(index, item) {
                        $('#section_id_modal').append('<option value="' + item.id + '">' +
                            item.section_name + '</option>');
                    });
                },
                error: function() {
                    console.error('Error fetching sections');
                }
            });
        }
    });

    $('#modal_previous_class_id').change(function() {
        var classId = $(this).val();
        $('#modal_previous_section_id').empty();
        $('#modal_previous_section_id').append('<option value="">Select Section</option>');
        if (classId) {
            $.ajax({
                url: '/admin/get-arms-by-class-id/' + classId,
                type: 'GET',
                success: function(data) {
                    $.each(data, function(index, item) {
                        $('#modal_previous_section_id').append('<option value="' + item.id +
                            '">' + item.section_name + '</option>');
                    });
                },
                error: function() {
                    console.error('Error fetching sections');
                }
            });
        }
    });

    function myShowPassword() {
        var x = $(".showPassword");
        var currentType = x.attr("type");
        if (currentType === "password") {
            x.attr("type", "text");
        } else {
            x.attr("type", "password");
        }
    }

    function generatePassword() {
        var name = $('#student_name').val();
        if (name == null || name == '') {
            alert("Please Enter the student name");
            return;
        }
        var admissionNumber = "{{ generateAdmissionNumber() }}"

        const cleanName = name.replace(/\s+/g, '').toLowerCase();
        let namePart = cleanName.slice(0, 3);
        if (namePart.length < 3) {
            namePart = namePart.padEnd(3, 'x'); // pad with 'x'
        }
        let admStr = admissionNumber.toString();
        if (admStr.length >= 4) {
            admStr = admStr.slice(-4);
        } else {
            admStr = admStr.padStart(4, '0'); // pad with leading zeros
        }
        const randomChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()';
        let randomPart = '';
        for (let i = 0; i < 3; i++) {
            randomPart += randomChars.charAt(Math.floor(Math.random() * randomChars.length));
        }
        let password = namePart + admStr + randomPart;
        if (password.length < 8) {
            while (password.length < 8) {
                password += randomChars.charAt(Math.floor(Math.random() * randomChars.length));
            }
        }
        $("#password").val(password);
        $("#password_confirmation").val(password);
        return password;
    }

    function safeParse(value) {
        var parsed = parseFloat(value);
        return isNaN(parsed) ? 0 : parsed;
    }
</script>
