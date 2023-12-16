@extends('admin.dashboard.layout')
@section('content')
    @include('sweetalert::alert')
    <link href="{{ url('profile/demo/demo.css')  }}" rel="stylesheet"/>
    <link href="{{ url('profile/css/paper-dashboard.css?v=2.0.1')  }}" rel="stylesheet"/>
    <link href="{{ url('profile/css/bootstrap.min.css')  }}" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <div class="content">
        <form id="type-create" method="post">
            <div class="d-flex">
                <input type="text" class="form-control" id="content" style="width: 30%" required>
                <button class="btn btn-outline-primary" type="submit" style="margin-left: 10px;margin-top: 0">Thêm thông
                    tin
                </button>
            </div>
        </form>
    </div>

    <div class="content" style="margin-top: 5px">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Thông tin thêm</h4>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead class=" text-primary">
                            <th>Nội dung</th>
                            <th class="text-center">Chức năng</th>
                            </thead>
                            <tbody id="data">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('modal.type.edit')
<script src="{{ url('profile/js/core/jquery.min.js') }}"></script>
<script src="{{ url('profile/js/core/popper.min.js') }}"></script>
<script src="{{ url('profile/js/core/bootstrap.min.js') }}"></script>
<script src="{{ url('profile/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
<!-- Chart JS -->
<script src="{{ url('profile/js/plugins/chartjs.min.js') }}"></script>
<!--  Notifications Plugin    -->
<script src="{{ url('profile/js/plugins/bootstrap-notify.js') }}"></script>

<script src="{{ url('profile/demo/demo.js')  }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.2/js/toastr.min.js"></script>
<script>
    $(document).ready(function () {
        load_data()

        function load_data() {
            var _li = '';
            $.get('{{ Route('dashboard.information') }}', function (res) {
                var data = res.data;
                data.forEach(function (item) {
                    _li += '<tr>';
                    _li += '<td>' + item.content + '</td>'
                    _li += '<td class="text-center">';
                    _li += '<button class="btn btn-outline-danger" id="btn-delete" value="' + item.id + '">Xoá</button>';
                    _li += '<button class="btn btn-outline-warning" type="submit" data-toggle="modal" style="margin: 5px" data-target="#modalEdit" id="btn-edit" value="' + item.id + '">Sửa'
                    _li += '</td>';
                    _li += '</tr>';
                    $('#data').html(_li)
                })
            })
        }

        $('#type-create').submit(function (e) {
            e.preventDefault();
            var value = {
                content: $("#content").val(),
                _token: "{{ csrf_token() }}"
            }
            $.ajax({
                url: '{{ Route('type.create') }}',
                type: 'POST',
                data: value,
                success: function (res) {
                    if (res.result == false) {
                        toastr.error(res.message);
                        load_data()
                    }
                    load_data()
                }
            })
        })

        $('#data').on('click', '#btn-delete', function (e) {
            e.preventDefault()
            var value = {
                id: $(this).attr("value"),
                _token: "{{ csrf_token() }}"
            }
            $.ajax({
                url: '{{ Route('type.delete') }}',
                type: 'POST',
                data: value,
                success: function () {
                    load_data()
                }
            })
        })

        $('#data').on('click', '#btn-edit', function (e) {
            e.preventDefault()
            var _li = '';
            _li += '<input type="hidden" name="id" value="' + $(this).attr("value") + '">'
            $('#type-data').html(_li)
        })
    });
</script>
