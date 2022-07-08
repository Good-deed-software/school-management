<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2>{{$title}}</h2>
                <div class="d-flex flex-row-reverse"><button
                        class="btn btn-sm btn-pill btn-outline-primary font-weight-bolder" id="createNewUser"><i
                            class="fas fa-plus"></i><a href="{{route('teacher_form')}}">add data </a></button></div>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table" id="teachertable">
                            <thead class="font-weight-bold text-center">
                                <tr>
                                    <th>Id</th>
                                    <th>TeachersName</th>
                                    <th>FathersName</th>
                                    <th>MothersName</th>
                                    <th>Address</th>
                                    <th>Email</th>
                                    <th>MobileNum</th>
                                    
                                    <th style="width:90px;">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                {{-- @foreach ($teachers as $r_teacher)
                                    <tr>
                                <td>{{$r_teacher->id}}</td>
                                <td>{{$r_teacher->TeacherName}}</td>
                                <td>{{$r_teacher->FatherName}}</td>
                                <td>{{$r_teacher->MotherName}}</td>
                                <td>{{$r_teacher->Address}}</td>
                                <td>{{$r_teacher->Email}}</td>
                                <td>{{$r_teacher->MobileNum}}</td>
                                <td>
                                    <div class="btn btn-success editUser" data-id="{{$r_teacher->id}}">Edit</div>
                                    <div class="btn btn-danger deleteUser" data-id="{{$r_teacher->id}}">Delete</div>
                                </td>
                                </tr>
                                @endforeach --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal-->

@push('scripts')
<script>
    $('document').ready(function () {
        // success alert
        function swal_success() {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Your work has been saved',
                showConfirmButton: false,
                timer: 1000
            })
        }
        // error alert
        function swal_error() {
            Swal.fire({
                position: 'centered',
                icon: 'error',
                title: 'Something goes wrong !',
                showConfirmButton: true,
            })
        }
        // table serverside
        var table = $('#teachertable').DataTable({
        processing: false,
            serverSide: true,
            ordering: false,
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf'
            ],
            ajax: "{{ route('teacher.index') }}",
            columns: [
                {   
                    data: 'id',
                    name: 'id'
                },
                {   
                    data: 'teachername',
                    name: 'teachername'
                },
                {
                    data: 'fathername',
                    name: 'fathername'
                },
                {
                    data: 'mothername',
                    name: 'mothername'
                },
                {
                    data: 'address',
                    name: 'address'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'mobilenumber',
                    name: 'mobilenumber'
                },

                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
        
        // csrf token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // initialize btn add
        $('#createNewUser').click(function () {
            $('#saveBtn').val("create user");
            $('#teacher_id').val('');
            $('#formTeacher').trigger("reset");
           // $('#modal-teacher').modal('show');
        });
       
         // initialize btn edit
         $('body').on('click', '.editUser', function () {
            var teacher_id = $(this).data('id');
            $.get("{{route('teacher.index')}}" + '/' + teacher_id + '/edit', function (data) {
               // $('#saveBtn').val("edit-user");
               // $('#modal-user').modal('show');
                $('#teacher_id').val(data.id);
               
            })
        });
        
      
        // initialize btn delete
        $('body').on('click', '.deleteUser', function () {
            var teacher_id = $(this).data("id");

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{route('teachers_data')}}" + '/' + teacher_id,
                        success: function (data) {
                            swal_success();
                            table.draw();
                        },
                        error: function (data) {
                            swal_error();
                        }
                    });
                }
            })
        });

        // statusing


    });

</script>
@endpush
