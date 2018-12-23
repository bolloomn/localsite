<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('uploads/'.$info->favicon)}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('uploads/'.$info->favicon) }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('uploads/'.$info->favicon) }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('uploads/'.$info->favicon) }}">
    <link rel="shortcut icon" href="{{ asset('uploads/'.$info->favicon) }}">
    @yield('meta')
    <style>
        :root{
            --MainColor: {{$info->config['main']['main_color']['hex']}};
            --SecondColor: {{$info->config['main']['parent_color']['hex']}};
        }
    </style>
    <link href="{{ asset('main/sub/css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('main/sub/css/bootstrap-grid.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('main/sub/css/customs.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('main/sub/css/scroll.style.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
    <script src="{{ asset('main/sub/js/jquery-2.1.1.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('main/sub/js/jquery.scrollbar.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script type="text/javascript" language="javascript">
        $(document).ready(function(){
            /**Scroll bar launch**/
            $('.scrollbar-inner').scrollbar();
            $('.scrollbar-inner.iltod_scroll').css("height","360px");
            /**Back to Top**/
            $('.back-to-top').click(function(){
                $('html, body').animate({
                    scrollTop: $('body').offset().top}, 600);
                return false;
            });
            /**Scrolled show items**/
            var scrolleds = false;
            $(window).scroll(function () {
                if (250 < $(window).scrollTop() && !scrolleds) {
                    $('.back-to-top').addClass('show');
                    $('.menu-line').addClass('fixed');
                    scrolleds = true;
                }
                if (250 > $(window).scrollTop() && scrolleds) {
                    $('.back-to-top').removeClass('show');
                    $('.menu-line').removeClass('fixed');
                    scrolleds = false;
                }
            });
        });
    </script>
</head>
<body>
<div class="wrapper">
    <div class="row top-line">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <ul class="top-contact">
                        <li><a href="tel:{{$info->config['contact']['phone']}}"><i class="fa fa-phone"></i> {{$info->config['contact']['phone']}}</a></li>
                        <li><a href="mailto:{{$info->config['contact']['email']}}"><i class="fa fa-envelope"></i> {{$info->config['contact']['email']}}</a></li>
                    </ul>
                </div>
                <div class="col-sm-6">
                    <ul class="top-menu">
                        <li><a href="#" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-link"></i> Бусад сумдууд</a></li>
                        <li><a href="#"><i class="fa fa-archive"></i> Архив</a></li>
                        <li><a href="#"><i class="fa fa-paper-plane"></i> Холбоо барих</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row menu-line">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 col-9">
                    <a href="{{asset('')}}">
                    <img class="logo" width="100%" src="{{ asset('uploads/'.$info->logo) }}">
                    </a>
                </div>
                <div class="col-sm-9 col-3">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto">
                                <?php foreach($info->menu as $mn){ ?>
                                <?php if($mn->children){ ?>
                                <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="{{$mn->link}}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" @if($mn->blank == 1) target="_blank" @endif><?php echo $mn->name; ?></a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <?php foreach($mn->children as $child){ ?>
                                        <?php if($child->children){ ?>
                                            <li class="nav-item dropdown">
                                                @if($child->type == 2)
                                                    <a class="dropdown-item" href="{{asset('category/'.$child->type_id)}}"><?php echo $child->name; ?></a>
                                                @else
                                                <a class="dropdown-item" href="{{$child->link}}" @if($child->blank == 1) target="_blank" @endif><?php echo $child->name; ?></a>
                                                @endif
                                                <ul>
                                                    <?php foreach($child->children as $subchuld){ ?>
                                                    <li class="nav-item">
                                                        <a class="dropdown-item" href="{{$subchuld->link}}" @if($subchuld->blank == 1) target="_blank" @endif><?php echo $subchuld->name; ?></a>
                                                    </li>
                                                    <?php } ?>
                                                </ul>
                                            </li>
                                        <?php }else{ ?>
                                        <li class="nav-item">
                                            @if($child->type == 2)
                                                <a class="dropdown-item" href="{{asset('category/'.$child->type_id)}}"><?php echo $child->name; ?></a>
                                            @elseif($child->type == 4)
                                                <a class="dropdown-item" href="{{asset('files/'.$child->type_id)}}"><?php echo $child->name; ?></a>
                                            @else
                                                <a class="dropdown-item" href="{{$child->link}}" @if($child->blank == 1) target="_blank" @endif><?php echo $child->name; ?></a>
                                            @endif
                                        </li>
                                            <?php } ?>
                                        <?php } ?>
                                    </ul>
                                </li>
                                <?php }else{ ?>
                                    <li class="nav-item"><a class="nav-link" href="{{$mn->link}}" @if($mn->blank == 1) target="_blank" @endif><?php echo $mn->name; ?></a></li>
                                    <?php } ?>
                                <?php } ?>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    @yield('content')

    <div class="row footer">
        <div class="container">
            <div class="row contact">
                <div class="col-sm-4">
                    <h4 class="row">Холбоо барих</h4>
                    <div class="intro-footer">
                        {{$info->config['meta']['description']}}
                    </div>
                    <p><a href="https://www.google.com/maps/place/Bayan-Ovoo/@'{{$info->config['contact']['latitude']}}','{{$info->config['contact']['longitude']}}','{{$info->config['contact']['zoom']}}'z/data=!4m5!3m4!1s0x5de82b9fa35922cf:0x336e835dbda1e4ec!8m2!3d47.7855583!4d112.1169004" target="_blank"><i class="fa fa-map-marker-alt"></i>{{$info->config['contact']['address']}}</a></p>
                    <p><a href="tel:{{$info->config['contact']['phone']}}" target="_top"><i class="fa fa-phone"></i> {{$info->config['contact']['phone']}}</a></p>
                    <p><a href="mailto:{{$info->config['contact']['email']}}" target="_top"><i class="far fa-envelope"></i> {{$info->config['contact']['email']}}</a></p>
                    <ul class="social ml-auto">
                        @if(!is_null($info->config['socail']['facebook']))<li><a target="_blank" href="{{$info->config['socail']['facebook']}}"><i class="fab fa-facebook-f"></i></a></li>@endif
                            @if(!is_null($info->config['socail']['twitter']))<li><a target="_blank" href="{{$info->config['socail']['twitter']}}"><i class="fab fa-twitter"></i></a></li>@endif
                            @if(!is_null($info->config['socail']['youtube']))<li><a target="_blank" href="{{$info->config['socail']['youtube']}}"><i class="fab fa-youtube"></i></a></li>@endif
                            @if(!is_null($info->config['socail']['google']))<li><a target="_blank" href="{{$info->config['socail']['google']}}"><i class="fab fa-google-plus"></i></a></li>@endif
                    </ul>
                </div>
                <div class="col-sm-1"></div>
                <div class="col-sm-7">
                    <h4 class="row"> Санал хүсэлт, өргөдөл, гомдол</h4>
                    <form method="post" action="{{asset('urgudul_save')}}" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-6">
                            <div class="layout">
                                <select class="form-feedback" name="type">
                                    <option value="0">Санал хүсэлт</option>
                                    <option value="1">Өргөдөл</option>
                                    <option value="2">Гомдол</option>
                                    <option value="3">Бусад</option>
                                </select>
                            </div>
                            <div class="layout"><input class="form-feedback" name="your_name" type="text" placeholder="Таны нэр *" required></div>
                            <div class="layout"><input class="form-feedback" name="your_phone" type="text" placeholder="Таны утас *" required></div>
                            <div class="layout"><input class="form-feedback" name="your_email" type="text" placeholder="Таны цахим шуудан"></div>
                            </div>
                            <div class="col-sm-6">
                            <div class="layout">
                                <textarea style="min-height: 90px;" name="your_message" class="form-feedback" placeholder="Зурвас бичих...*" required></textarea></div>
                                <div class="layout">
                                <a href="javascript:addImage();" class="attach_btn">
                                    <i class="far fa-plus-square"></i> нэмэлт зураг хавсаргах</a>
                                <input style="display: none;" class="image-pp" type="file" name="image"></div>
                            <div class="layout">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-sm btn-outline-primary">
                                    <i class="fa fa-paper-plane"></i>&nbsp; &nbsp;Илгээх</button>
                                <button title="Цэвэрлэх" type="reset" class="btn btn-sm btn-outline-secondary"><i class="fa fa-redo"></i> </button>
                            </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row copyright">
                <div class="col-sm-12 text-center">
                    Зохиогчийн бүх эрх хуулиар хамгаалагдсан © 2018  <strong>{{$info->config['main']['copyright']}}</strong>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="back-to-top">
    <!-- back to top start -->
    <i class="fa fa-rocket"></i>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content sumd">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Сумдын холбоос</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="row">
                @foreach($info->subDomain as $domain)
                    @if(!$domain->id == 0)
                        <li class="col-sm-6">
                        <a href="{{$domain->domain}}"><img src="{{ asset('uploads/'.$domain->favicon)}}"> {{$domain->name}}</a>
                        </li>
                    @endif
                @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<script>
    addImage = function(){
        $(".image-pp").click();
    }
</script>
</body>
</html>
