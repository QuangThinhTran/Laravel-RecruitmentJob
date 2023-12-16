@extends('company.layout')
@section('content')
    @include('sweetalert::alert')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    {{--    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}
    <script src="https://unpkg.com/feather-icons"></script>
    <div class="row g-4 mb-4" id="post">
        @foreach($posts as $post)
            <div class="col-12 col-lg-4">
                <div class="app-card app-card-basic d-flex flex-column align-items-start shadow-sm">
                    <div class="app-card-header p-3 border-bottom-1 ">
                        <div class="row align-items-center gx-3">
                            <div class="row">
                                <div class="col-auto">
                                    <div class="app-icon-holder">
                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip"
                                          @if($post->status == 0) title="Chưa phê duyệt" @else title="Đã phê duyệt"  @endif >
                                         <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-receipt"
                                              @if($post->status == 0) style="color:red" @endif
                                              fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                  d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27zm.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0l-.509-.51z"/>
                                            <path fill-rule="evenodd"
                                                  d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5z"/>
                                        </svg>
                                    </span>

                                    </div>
                                </div>
                                <div class="col-auto" style="position: absolute;left: 80%;">
                                    <a class="btn btn-light" role="button" data-toggle="dropdown"
                                       aria-expanded="false"><i class="fas fa-bars"></i></a>
                                    <div class="dropdown-menu">
                                        <a class="ml-3" href="{{ Route('company.storage',['id' => $post->id]) }}"
                                           style="text-decoration: none; color: black">Chi tiết bài viết</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <h3 class="app-card-title"> {{ $post->title }}</h3>
                            </div>
                        </div>
                        <!--//row-->
                    </div>
                    <!--//app-card-header-->
                    <div class="app-card-body px-4">
                        <div class="intro">
                            <p style="font-size: 14px;display: -webkit-box;max-height: 3.2rem;-webkit-box-orient: vertical;overflow: hidden;
                                text-overflow: ellipsis;white-space: normal;-webkit-line-clamp: 2;line-height: 1.6rem;">{{ $post->description}}</p>
                        </div>
                    </div>
                    <div class="app-card-footer p-4 mt-auto">
                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Khôi phục">
                                 <button class="btn btn-outline-success" id="btn-restore" value="{{ $post->id }}">
                                <span><i class="fas fa-redo"></i></span>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {

            $('#post').on('click', '#btn-restore', function (e) {
                e.preventDefault();
                var data = {
                    'id': $(this).val(),
                    '_token': '{{ csrf_token() }}'
                }

                Swal.fire({
                    title: 'Bạn muốn khôi phục bài viết?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Không',
                    confirmButtonText: 'Có',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ Route('post.restore') }}',
                            type: 'POST',
                            data: data,
                            success: function () {
                                window.location.reload('{{ Route('company.history') }}');
                            }
                        })
                        Swal.fire(
                            'Khôi phục thành công!',
                        )
                    }
                })

            })

        });

    </script>
@endsection
