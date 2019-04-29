<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('main/volunteer/images/favicon.png')}}">
    @yield('meta')
    <link rel="stylesheet" href="{{asset('main/volunteer/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('main/volunteer/fontawesome/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('main/volunteer/style.css')}}">
    {{--Font--}}
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">

</head>
<body>
<div class="header">
    <div class="container">
        <div class="row">
        <div class="col-sm-5"><img src="{{asset('main/volunteer/images/logo.png')}}" title="Volunteer | Сайн дурынхан"/></div>
        <div class="col-sm-7">
            <ul class="volunteerForum m-0">
                <li><a href="#" data-toggle="modal" data-target="#LoginForm">Нэвтрэх</a></li>
                <li><a href="{{asset("register")}}">Бүртгүүлэх</a></li>
            </ul>
            <nav class="navbar navbar-expand-lg navbar-dark p-0">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{asset("")}}">Эхлэл</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{asset("volunteer")}}">Сайн дурын ажлууд</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{asset("people")}}">Сайн дурынхан</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{asset("contact")}}">Холбогдох</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        </div>
    </div>
</div>
@yield('content')
<footer class="p-5">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <h3 class="head-title">Бидний <strong>тухай</strong></h3>
            </div>
            <div class="col-sm-4">
                <h3 class="head-title">Шинэ <strong>үйл явдал</strong></h3>
                <div class="row post">
                    <div class="col-sm-4">
                        <div class="thumb" style="background-image:url('https://images.pexels.com/photos/433142/pexels-photo-433142.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500');"></div>
                    </div>
                    <div class="col-sm-8">
                        <div class="event_start"><span class="mr-1">Зарлагдсан:</span> 2019-02-31 08:00</div>
                        <a href="#">Бүх нийтийн их цэвэрлэгээтэй өдөр 02.31 #сайн дурынхан</a>
                    </div>
                </div>
                <div class="row post">
                    <div class="col-sm-4">
                        <div class="thumb" style="background-image:url('https://images.pexels.com/photos/433142/pexels-photo-433142.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500');"></div>
                    </div>
                    <div class="col-sm-8">
                        <div class="event_start"><span class="mr-1">Зарлагдсан:</span> 2019-02-31 08:00</div>
                        <a href="#">Бүх нийтийн их цэвэрлэгээтэй өдөр 02.31 #сайн дурынхан их цэвэрлэгээтэй өдөр 02.31 #сайн дурынхан</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <h3 class="head-title">Эрэлттэй <strong>түлхүүр үгс</strong></h3>
                <ul class="tags">
                    <li><a href="#">мод тарих</a></li>
                    <li><a href="#">сайн дурынхан</a></li>
                    <li><a href="#">үйл явдал</a></li>
                    <li><a href="#">цэвэрлэх</a></li>
                    <li><a href="#">зураг</a></li>
                    <li><a href="#">тусламж</a></li>
                    <li><a href="#">ахмад настан</a></li>
                    <li><a href="#">хүүхэд</a></li>
                    <li><a href="#">ажилгүйдэл</a></li>
                    <li><a href="#">сайн дурын ажил</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<div class="footer-bottom">
    <div class="container text-center">
        <!--Copyright-->
        <div class="copyright">Бүх эрх хуулиар хамгаалагдсан <strong>© 2018</strong> | Хуулбарлахыг хориглоно. Баянхонгор аймгийн Засаг Даргын Тамгын Газар</div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="LoginForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-16" id="exampleModalCenterTitle">Нэвтрэх</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="font-12 rounded" method="post" action="{{asset('loginUser')}}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Нэвтрэх нэр:</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Нууц үг:</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Нэвтрэх</button>
                    <div class="registerOr"><span>эсвэл</span></div>
                    <button type="button" class="facebookBTN"><i class="fab fa-facebook-square"></i> Фэйсбүүк</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Javascript --}}

<script type="text/javascript" src="{{ asset('main/volunteer/js/jquery-2.1.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('main/volunteer/js/bootstrap.js') }}"></script>
<script type="text/javascript" src='http://code.jquery.com/jquery-1.8.3.js'></script>
<script type="text/javascript" src="{{ asset('main/volunteer/js/script.js') }}"></script>

</body>
</html>
