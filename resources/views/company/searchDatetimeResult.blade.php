@extends('company.layout')
@section('content')
    @include('company.search')
    @include('sweetalert::alert')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
{{--<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>--}}
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="shortcut icon" href="favicon.ico">
    <div class="row g-4 mb-4 mt-2" id="post">
        @foreach($all_post as $post)
                <div class="col-12 col-lg-4">
                    <div class="app-card app-card-basic d-flex flex-column align-items-start shadow-sm">
                        <div class="app-card-header p-3 border-bottom-1 ">
                            <div class="row align-items-center gx-3">
                                <div class="row">
                                    <div class="col-auto">
                                    <div class="app-icon-holder">
                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" @if($post->status == 0) title="Chưa phê duyệt" @else title="Đã phê duyệt"  @endif >
                                         <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-receipt" @if($post->status == 0) style="color:red" @endif
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
                                        <a class="ml-3" href="{{ Route('post.detail',['id' => $post->id]) }}" style="text-decoration: none; color: black">Chi tiết bài viết</a>
                                        @if($post->status != 0)
                                            <form action="{{ Route('company.applied.post') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ Auth::user()->role_id }}">
                                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                                <button type="submit" class="dropdown-item" data-toggle="modal">
                                                    Danh sách ứng tuyển
                                                </button>
                                            </form>
                                        @endif
                                        <a class="ml-3" href="{{ Route('post.edit',['id' => $post->id]) }}" style="text-decoration: none; color: black">Chỉnh sửa bài viết</a>
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
                        @if($post->approved_date != null)
                            <div class="app-card-footer p-4 mt-auto">
                                <div class="col-auto">
                                    @if($post->status != 0)
                                        <div class="toggle focus @if($post->status != 1) on @endif ">
                                            <input type="checkbox" value="{{ $post->id }}">
                                            <span class="slider focus"></span>
                                            @if($post->status != 1)
                                                <span class="label">Ẩn bài viết</span>
                                            @else
                                                <span class="label">Hiện bài viết</span>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                                <span tabindex="0" data-toggle="tooltip" title="Xóa bài viết">
                                    <button class="btn btn-danger" id="btn-delete" value="{{ $post->id }}" style="position: absolute;left: 81%;bottom: 25px;"><span><i class="far fa-trash-alt" style="color: #dcdfe5;"></i></span></button>
                                </span>
                            </div>
                        @endif
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

            $('#post').on('click', '#btn-delete', function (e) {
                e.preventDefault();
                var data = {
                    'id': $(this).val(),
                    'role_id': '{{ Auth::user()->role_id }}',
                    '_token': '{{ csrf_token() }}'
                }

                Swal.fire({
                    title: 'Bạn muốn xoá bài viết?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Không',
                    confirmButtonText: 'Có',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ Route('post.delete') }}',
                            type: 'POST',
                            data: data,
                            success: function () {
                                window.location.reload('{{ Route('company.index') }}');
                            }
                        })
                        Swal.fire(
                            'Đã xoá thành công!',
                        )
                    }
                })

            })

            $('.toggle input[type="checkbox"]').click(function () {
                $(this).parent().toggleClass('on')
                if ($(this).parent().hasClass('on')) {
                    var value = {
                        'id' : $(this).val(),
                        '_token': '{{ csrf_token() }}',
                        'status': 2
                    }
                    $.ajax({
                        url: '{{ Route('post.status') }}',
                        type: 'GET',
                        data: value,
                        success: function (res){

                        }
                    })
                    $(this).parent().children('.label').text('Ẩn bài viết')
                } else {
                    var value = {
                        'id' : $(this).val(),
                        '_token': '{{ csrf_token() }}',
                        'status': 1
                    }
                    $.ajax({
                        url: '{{ Route('post.status') }}',
                        type: 'GET',
                        data: value,
                        success: function (res){

                        }
                    })

                    $(this).parent().children('.label').text('Hiện bài viết')
                }
            });
            $('input').focusin(function () {
                $(this).parent().addClass('focus');
            });
            $('input').focusout(function () {
                $(this).parent().removeClass('focus');
            });
        });

    </script>
    <style>
        @keyframes eh {
            0% {transform: scale(0%)};
        100% {transform: scale(100%)};
        }

        /* .feather-check { color: white; width: 30px; height: 30px; } */
        .checked-icon { display: block; opacity: 0;}
        /* .rad-icon { opacity: 0; background-color: transparent; border: 2px solid white; height: 20px; width: 20px; border-radius: 50%; margin: 5px auto; display: block; } */

        * {
            box-sizing: border-box;
            -moz-box-sizing:border-box;
            -webkit-box-sizing:border-box;
            -o-box-sizing:border-box;
            word-wrap: break-word;
        }
        .checkbox{
            width: 30px;
            height: 30px;
            position: relative;
            display: block;
        }

        .check {
            position: absolute;
            height: 100%;
            width: 100%;
            background-color: #e3eefa;
        }
        .check { border-radius: 3px; transition: all 0.4s; }

        .checkbox.on .check{ background-color: #4287f5; }
        .checkbox.on .checked-icon {
            opacity: 1;
            text-align: center;
            animation-name: eh;
            animation-duration: 0.3s;
        }

        .checkbox .checked-icon { transition: opacity 0.3s ease-out; }

        .toggle {
            position: relative;
            width: 50px;
            height: 24px;
            display: inline-block;
            left: -16px;
        }

        .toggle .slider {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            transition: 0.4s;
            border-radius: 34px;
        }

        .toggle .slider:before {
            position: absolute;
            content: "";
            height: 20px;
            width: 20px;
            left: 4px;
            bottom: 2px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
            box-shadow: 0px 0px 5px 2px rgba(0, 0, 0, 0.05);
        }

        .toggle .slider { background-color: #4287f5; }
        .toggle.on .slider { background-color: red; }
        .toggle.on .slider:before { transform: translateX(26px); box-shadow: 0px 0px 5px 2px rgba(0, 0, 0, 0.2); }

        .toggle .label { position: absolute; left: 64px; top: 4px; vertical-align: middle;width: 170%;font-size: 14px; }
        .checkbox .label { position: absolute; left: 50px; top: 4px; vertical-align: middle; }

        input[type="checkbox"] { height: 100%; width: 100%; opacity: 0; position: absolute; z-index: 100; cursor: pointer; vertical-align: middle;}

        .toggle.focus .slider, .checkbox.focus .check { box-shadow: 0px 0px 0px 2px #bababa; transition: all 0.4s; }
        .focus .label { text-shadow: 0px 0px 3px #bababa; transition: all 0.4s; }

    </style>
@endsection
