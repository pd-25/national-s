
    <script>
        Notiflix.Notify.Init({});
        Notiflix.Confirm.Init({});
        Notiflix.Loading.Init({});

        
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
                $.ajax({
                    url: "{{route('attendance.studentsListUsingSessionClassSection')}}",
                    type: 'Post',
                    data:{
                        session_id:session_id,
                        class_id:class_id,
                        section_id:section_id,
                         _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        $.each(data, function(index, item) {
                            $('#student_id_bind').append('<option value="' + item.student_details.id + '">' + item.student_details.student_name + ' (' + item.student_details.admission_number + ') </option>');
                        });
                    },
                    error: function() {
                        console.error('Error fetching sections');
                    }
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
                        if(data.length == 1){
                            $.each(data, function(index, item) {
                                $('#section_id').append('<option value="' + item.id + '" ' + (item.id == data[0].id ? 'selected' : '') + '>' + item.section_name + '</option>');
                            });
                            getAllStudent();
                        }else{
                            $.each(data, function(index, item) {
                                $('#section_id').append('<option value="' + item.id + '">' + item.section_name + '</option>');
                            });
                        }
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
                            $('#section_id_modal').append('<option value="' + item.id + '">' + item.section_name + '</option>');
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
                            $('#modal_previous_section_id').append('<option value="' + item.id + '">' + item.section_name + '</option>');
                        });
                        // if(data.length == 1){
                        //     $.each(data, function(index, item) {
                        //         $('#modal_previous_section_id').append('<option value="' + item.id + '" ' + (item.id == data[0].id ? 'selected' : '') + '>' + item.section_name + '</option>');
                        //     });
                        //     getAllStudent();
                        // }else{
                        //     $.each(data, function(index, item) {
                        //         $('#modal_previous_section_id').append('<option value="' + item.id + '">' + item.section_name + '</option>');
                        //     });
                        // }
                    },
                    error: function() {
                        console.error('Error fetching sections');
                    }
                });
            }
        });

    </script>