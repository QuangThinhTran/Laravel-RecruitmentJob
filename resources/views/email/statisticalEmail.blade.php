<div id="email" style="width:600px;margin: auto;background:white;">
    <table role="presentation" border="0" align="right" cellspacing="0">
        <tr>
            <td>
                <a href="#"
                   style="font-size: 9px; text-transform:uppercase; letter-spacing: 1px; color: #99ACC2;  font-family:Arial;">View
                    in Browser</a>
            </td>
        </tr>
    </table>

    <!-- Header -->
    <table role="presentation" border="0" width="100%" cellspacing="0">
        <tr>
            <td bgcolor="#00A4BD" align="center" style="color: white;">
                <img alt="Flower"
                     src="https://hs-8886753.f.hubspotemail.net/hs/hsstatic/TemplateAssets/static-1.60/img/hs_default_template_images/email_dnd_template_images/ThankYou-Flower.png"
                     width="150px">
                <h1 style="font-size: 52px; margin:0 0 20px 0; font-family:Arial;"> Welcome finding job!</h1>
        </tr>
        </td>
    </table>
    <!-- Body 2-->

    <div style="font-size:14px; line-height:1.8; font-weight:400;color:#2d383c; text-align:center;margin-top:8px; ">
        <div style="font-size:16px; line-height:1.8; font-weight:400; margin:0; color:#2d383c;">
            Từ ngày {{$start_date}} đến ngày {{$end_date}}
        </div>
        <br>
        <div style="font-size:13px;color:#2d383c; line-height:1.8; font-weight:400; margin:0 0 12px;text-align: left">
            <span>
                Tổng số bài viết
            </span>
            <span style="float: right">
                {{ $sum }}
            </span>
        </div>
        <hr style="opacity: 0.3;width: auto;">
        <div style="font-size:13px;color:#2d383c; line-height:1.8; font-weight:400; margin:0 0 12px;text-align: left">
            <span>
                Những bài viết chưa được phê duyệt
            </span>
            <span style="float: right">
                {{ $not_approved }}
            </span>
        </div>
        <hr style="opacity: 0.3;width: auto;">
        <div style="font-size:13px;color:#2d383c; line-height:1.8; font-weight:400; margin:0 0 12px;text-align: left">
            <span>
                Những bài viết đã được phê duyệt
            </span>
            <span style="float: right">
                {{ $approved }}
            </span>
        </div>
        <hr style="opacity: 0.3;width: auto;">

        <div
            style="font-family:Lato,'Hiragino Sans','\0030d2\0030e9\0030ae\0030ce\0089d2\0030b4\0030b7\0030c3\0030af','Hiragino Kaku Gothic ProN','\0030d2\0030e9\0030ae\0030ce\0089d2\0030b4 Pro W3','Helvetica Neue',Helvetica,Arial,'\0030e1\0030a4\0030ea\0030aa',Meiryo,'\00ff2d\00ff33 \00ff30\0030b4\0030b7\0030c3\0030af',sans-serif;font-size:16px; line-height:1.5; font-weight:400; margin:40px 0; text-align: center;"
            align="center;">
            <button style="background-color: #4284e4;color: #fff;border: none;outline: none;padding: 10px 30px">
                <a style="padding: 0 12px; color:white;text-decoration: none"
                   href="{{ env('APP_DOMAIN')}}/user/user-login">Xem chi tiết</a></button>
        </div>
        <div style="margin:36px 0 24px;padding:0">
            <hr style="background-color:#d0d6da;min-height:1px;width:120px;margin:0 auto;border:none">
            <br style="margin:0; padding:0;">
        </div>
    </div>
</div>
