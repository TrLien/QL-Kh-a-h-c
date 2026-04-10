#  MINI PROJECT – COURSE MANAGEMENT SYSTEM

##  Giới thiệu

Hệ thống quản lý khóa học trực tuyến được xây dựng bằng **Laravel Framework**.
Cho phép quản lý khóa học, bài học và học viên đăng ký.

---

##  Chức năng chính

###  Quản lý khóa học

* Thêm / sửa / xóa khóa học
* Upload ảnh
* Tự tạo slug
* Soft delete + khôi phục
* Phân trang
* Hiển thị số bài học

###  Quản lý bài học (Lesson)

* Thêm bài học vào khóa học
* Sắp xếp theo thứ tự
* Xóa bài học

###  Quản lý đăng ký (Enrollment)

* Đăng ký học viên
* Không cho đăng ký trùng
* Hiển thị số lượng học viên theo khóa

---

## Công nghệ sử dụng

* Laravel (MVC)
* Eloquent ORM
* Blade Template
* Bootstrap 5
* MySQL

---

##  Cấu trúc Database

* courses
* lessons
* students
* enrollments

Quan hệ:

* Course → hasMany → Lesson
* Course → hasMany → Enrollment
* Student → belongsToMany → Course

---

##  Hướng dẫn cài đặt

### 1. Clone project

```bash
git clone <link-github>
cd course_project
```

---

### 2. Cài thư viện

```bash
composer install
```

---

### 3. Cấu hình database

Mở file `.env`:

```env
DB_DATABASE=course_db
DB_USERNAME=root
DB_PASSWORD=
```

---

### 4. Tạo database

Vào phpMyAdmin tạo database:

```
course_db
```

---

### 5. Chạy migration

```bash
php artisan migrate
```

---

### 6. Tạo thư mục upload ảnh

```bash
mkdir public/images
```

---

### 7. Chạy server

```bash
php artisan serve
```

---

##  Truy cập hệ thống

* Trang chủ: http://127.0.0.1:8000
* Courses: http://127.0.0.1:8000/courses
* Enrollments: http://127.0.0.1:8000/enrollments

---

##  Tính năng nâng cao

* Tìm kiếm khóa học
* Lọc theo trạng thái
* Scope (published, price range)
* Eager Loading tránh N+1 query

---

##  Giao diện

* Layout master + sidebar
* Component:

  * Alert
  * Badge trạng thái
* Giao diện Bootstrap đẹp, dễ dùng


---

##  Ghi chú

* Không sử dụng SQL thuần
* Sử dụng Eloquent ORM
* Áp dụng đầy đủ MVC

---
