## Mô tả  sơ lược về dự án
Đây là dự án Website tìm việc làm FindingJob PHP Laravel nơi mọi người có thể giúp mọi người:
+ Tìm việc làm phù hợp với chuyên ngành (Quản lý thông tin cá nhân, tìm kiếm việc làm, công ty, v.v...)
+ Giúp nhà tuyển dụng đăng bài tuyển dụng tìm kiếm ứng viên phù hợp (Quản lý bài viết, quản lý thông tin công ty, tìm kiếm ứng cử viên, v.v...)
+ Quản lý Website (Quản lý tài khoản, quản lý bài viết, v.v...)

## Sơ lược về hệ thống

### Vai trò người dùng:
 + Ứng cử viên
 + Nhà tuyển dụng   
 + Admin

### Chức năng chính
 + Đăng nhập/ Đăng ký
 + Quản lý thông tin cá nhân
 + Quản lý bài tuyển dụng
 + Quản lý tài khoản
 + Đánh giá, báo cáo ứng cử viên, nhà tuyển dụng,  
 + Liên hệ với Admin Website
 + Phản hồi người dùng
 + Đăng nhập bằng Google/Linkedin

### Đặc biệt
Vào 9h sáng T2 hàng tuần, hệ thống sẽ gửi mail tất cả người dùng : 
 + Ứng cử viên : tất cả bài viết phù hợp với chuyên ngành của người đó ở tuần trước
 + Nhà tuyển dụng : danh sách ứng cử viên đã ứng tuyển vào mỗi bài tuyển dụng ở tuần trước
 + Admin : tổng số lượng tất cả bài viết ở tuần trước (đã phê duyệt, chưa phê duyệt)

## Tác giả
### Backend : Trần Lê Quang Thịnh
 + linkedin : https://www.linkedin.com/in/quang-thinh-tran-le-aaaa44258/
 + email : tranlequangthinh24122002@gmail.com
   
### Frontend : Nguyễn Tuấn Nguyên
 + linkedin : https://www.linkedin.com/in/nguyên-nguyễn-6a59b1282
 + email : Nguyentuannguyen.tnt@gmail.com

### Mọi ý kiến đóng góp hoặc thắc mắc bạn có thể liên hệ chúng tôi qua Mail hoặc Linkedin. Xin cảm ơn

## Cấu hình dự án
- PHP : 8.1
- Laravel/framework : 10.0
- MySQL : 5.7
- Composer : 2.5.2

### Thiết lập .env

```sh
Tạo thêm file .env sau đó copy nội dung file .env.example vào file .env rồi vào terminal nhập lệnh : 
composer install
```

### Generate key

```sh
php artisan key:generate
```

### Config env và cache

```sh
php artisan config
```

### Khởi tạo Database

```sh
php artisan migrate
```

### Thiết lập Data

```sh
php artisan set-database
```

### Run unit test

```sh
php artisan test
```

### Đăng nhập

```sh
username : admin
password : 12345678
```
