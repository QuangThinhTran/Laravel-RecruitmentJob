<div class="modal fade" id="modalReportReview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ Route('admin.replied.report.review') }}" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Phản hồi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label" style="font-weight: bold;">Nội dung : </label>
                    </div>
                    <textarea name="content" cols="60" rows="4" required></textarea>
                    <div id="replied_ticket_report"></div>
                    <input type="hidden" name="admin_id" value="{{ Auth::user()->id }}">
                </div>
                <div class="modal-footer">
                    <div class="toggle focus">
                        <input type="checkbox" name="deleteReview" value="true">
                        <span class="slider focus"></span>
                        <span class="label"></span>
                    </div>

                    <button type="submit" class="btn btn-primary" style="position:absolute;right:14px;">Phản hồi</button>
                </div>
            </form>
        </div>
    </div>
</div>
<style>
    .modal-footer{
        justify-content:space-around;
    }
    /* .feather-check { color: white; width: 30px; height: 30px; } */
    .checked-icon {
        display: block;
        opacity: 0;
    }

    /* .rad-icon { opacity: 0; background-color: transparent; border: 2px solid white; height: 20px; width: 20px; border-radius: 50%; margin: 5px auto; display: block; } */



    .checkbox {
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

    .check {
        border-radius: 3px;
        transition: all 0.4s;
    }

    .checkbox.on .check {
        background-color: #4287f5;
    }

    .checkbox.on .checked-icon {
        opacity: 1;
        text-align: center;
        animation-name: eh;
        animation-duration: 0.3s;
    }

    .checkbox .checked-icon {
        transition: opacity 0.3s ease-out;
    }

    .toggle {
        position: relative;
        left: -203px;
        width: 50px;
        height: 24px;
        display: inline-block;
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

    .toggle .slider {
        background-color: #4287f5;
    }

    .toggle.on .slider {
        background-color: red;
    }

    .toggle.on .slider:before {
        transform: translateX(26px);
        box-shadow: 0px 0px 5px 2px rgba(0, 0, 0, 0.2);
    }

    .toggle .label {
        position: absolute;
        left: 64px;
        top: 4px;
        vertical-align: middle;
        width: 170%;
        font-size: 14px;
    }

    .checkbox .label {
        position: absolute;
        left: 50px;
        top: 4px;
        vertical-align: middle;
    }

    input[type="checkbox"] {
        height: 100%;
        width: 100%;
        opacity: 0;
        position: absolute;
        z-index: 100;
        cursor: pointer;
        vertical-align: middle;
    }

    .toggle.focus .slider,
    .checkbox.focus .check {
        box-shadow: 0px 0px 0px 2px #bababa;
        transition: all 0.4s;
    }

    .focus .label {
        text-shadow: 0px 0px 3px #bababa;
        transition: all 0.4s;
    }
</style>
<script>
    feather.replace();

    $(document).ready(function(){
        $('.toggle input[type="checkbox"]').click(function(){
            $(this).parent().toggleClass('on');
            if ($(this).parent().hasClass('on')) {
                $(this).parent().children('.label').text('Xoá đánh giá')
            } else {
                $(this).parent().children('.label').text('')
            }
        });

        $('input').focusin (function() {
            $(this).parent().addClass('focus');
        });
        $('input').focusout (function() {
            $(this).parent().removeClass('focus');
        });
    });
</script>
