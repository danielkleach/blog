@extends('layout.master')

@section('content')
    <table class="table table-striped table-bordered table-hover dataTable dtr-inline" id="posts-table" role="grid">
        <thead>
            <tr role="row">
                <th>Title</th>
                <th>Subject</th>
                <th>Date</th>
                <th>Published</th>
                <th>Actions</th>
            </tr>
        </thead>
    </table>
@endsection

@section('scripts')
    <script src="/js/vendors/sweet-alert/sweetalert.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#posts-table').DataTable({
                order: [[ 2, "desc"]],
                processing: true,
                serverSide: true,
                ajax: '{{ route('posts.data') }}',
                columnDefs: [
                    { orderSequence: [ "desc", "asc"], targets: '_all' }
                ],
                columns: [
                    { data: "title", name: "title"},
                    { data: "subject.name", name: "subject.name"},
                    { data: null, name: "date",
                        "render": function (data, type, full, meta) {
                            return moment(data.date).format("LL");
                        }
                    },
                    { data: null, name: "published",
                        searchable: false,
                        "render": function (data, type, full, meta) {
                            if (data.published) {
                                return 'Yes';
                            } else {
                                return 'No';
                            }
                        }
                    },
                    { data: null, name: "actions",
                        searchable: false,
                        sortable: false,
                        "render": function (data, type, full, meta) {
                            if (data.published) {
                                return `<a href="/posts/${data.slug}/unpublish" class="btn btn-outline btn-default btn-sm confirm"><i class="fa fa-ban"></i>Unpublish</a>
                                       <a href="/posts/${data.slug}/edit" class="btn btn-outline btn-default btn-sm"><i class="fa fa-edit"></i>Edit</a>`;
                            } else {
                                return `<a href="/posts/${data.slug}/publish" class="btn btn-outline btn-default btn-sm confirm"><i class="fa fa-check"></i>Publish</a>
                                       <a href="/posts/${data.slug}/edit" class="btn btn-outline btn-default btn-sm"><i class="fa fa-edit"></i>Edit</a>`;
                            }
                        }
                    }
                ],
                pageLength: 10,
                responsive: true,
                dom: '<"html5buttons"B>lTfgitp',
                buttons: []
            });

            $('body').on('click', '.confirm', function(e) {
                var url = $(this).attr('href');
                e.preventDefault();
                swal({
                    title: "Confirmation",
                    text: "Are you sure?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes",
                    closeOnConfirm: false
                }, function (isConfirm) {
                    if (!isConfirm) return;
                    $.ajax({
                        url: url,
                        success: function (data) {
                            if (data.status == 'Failure') {
                                swal("Error!", "Failed", "error");
                            } else {
                                swal("Done!", "Success", "success");
                            }
                            if (data.redirect) {
                                window.location = data.redirect;
                            } else {
                                setTimeout(location.reload.bind(location), 750);
                            }
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            console.log('error');
                            swal("Error!", "Please try again", "error");
                        }
                    });
                });
            });
        });
    </script>
@endsection