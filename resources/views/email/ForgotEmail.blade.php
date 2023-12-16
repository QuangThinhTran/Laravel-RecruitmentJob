<div style="font-family:Lato,'Hiragino Sans','\0030d2\0030e9\0030ae\0030ce\0089d2\0030b4\0030b7\0030c3\0030af','Hiragino Kaku Gothic ProN','\0030d2\0030e9\0030ae\0030ce\0089d2\0030b4 Pro W3','Helvetica Neue',Helvetica,Arial,'\0030e1\0030a4\0030ea\0030aa',Meiryo,'\00ff2d\00ff33 \00ff30\0030b4\0030b7\0030c3\0030af',sans-serif;font-size:16px; line-height:1.5; font-weight:400; margin:40px 0; text-align: center;">
    <p>Xin chào {{ $email }}. Email này dùng để giúp bạn lấy lại mật khẩu tài khoản đã bị mất</p>
    <p>Vui lòng click vào link dưới đây để đặt lại mật khẩu</p>
    <button style="background-color: #128c54;color: #fff;border: none;outline: none;padding: 10px 30px">
        <a href="{{ env('APP_URL')}}/?{{customer_code=$customer->customer_code&name_store=$storeName}}" style="color: white">Đặt lại mật khẩu</a></button>
</div>
