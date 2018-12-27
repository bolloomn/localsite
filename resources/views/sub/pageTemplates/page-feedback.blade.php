@extends('sub.layouts.site')
@section('meta')
    <title>Санад хүсэлт, өргөдөл, гомдол</title>
    <meta name="title" content="Санад хүсэлт, өргөдөл, гомдол">
    <meta name="description" content="Санад хүсэлт, өргөдөл, гомдол">
    <meta name="keywords" content="Санад хүсэлт, өргөдөл, гомдол">
@endsection
@section('content')
    <div class="row" style="background: #262b49;">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{asset('')}}">Нүүр хуудас</a><hex></hex></li>
                    <li class="breadcrumb-item active" aria-current="page">Санал хүсэлт, өргөдөл, гомдол</li>
                </ol>
                <div class="back-history"><a href="javascript:history.back(-1)">Өмнөх хуудас руу буцах</a></div>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="container content-box">
            <div class="row">
                <div class="col-sm-9">
                    <div class="posts-blog row">
                        <ul class="feedlist">
                        @php $i=1; @endphp
                        @foreach($feedlist as $feed)
                            <li class="@if($i%2 == 1) row_odd @else row_even @endif">
                                <div class="sanal">
                                    <span class="badge badge-primary"><i class="fab fa-internet-explorer"></i> </span>
                                    @if($feed->type == 0)
                                    <span class="badge badge-warning">Санал хүсэлт</span>
                                    @elseif($feed->type == 1)
                                        <span class="badge badge-info">Өргөдөл</span>
                                    @elseif($feed->type == 2)
                                        <span class="badge badge-danger">Гомдол</span>
                                    @elseif($feed->type == 3)
                                        <span class="badge badge-dark">Бусад</span>
                                    @endif
                                    @if(is_null($feed->reply))
                                    <div class="float-right badge badge-secondary">  <i class="fa fa-sync-alt fa-spin"></i> &nbsp;Хүлээж авсан </div>
                                    @else
                                        <div class="float-right badge badge-success"><i class="fa fa-check"></i>   &nbsp;Хариулсан </div>
                                    @endif
                                </div>
                                <div class="row" style="padding: 10px 0 5px;">
                                    @if($feed->image)
                                    <div class="col-sm-11">
                                    <strong>{{$feed->name}}:</strong> {{$feed->content}}
                                    </div>
                                    <div class="col-sm-1">
                                            <img src="{{asset('uploads/'.$feed->image)}}" class="w-100">
                                    </div>
                                    @else
                                        <div class="col-sm-12">
                                            <strong>{{$feed->name}}:</strong> {{$feed->content}}
                                        </div>
                                    @endif
                                </div>
                                @if($feed->reply)
                                    <div class="row" style="    margin-bottom: 10px;    padding: 10px 0;    background: rgba(71, 177, 255, 0.1);">
                                        <div class="col-sm-1" style="text-align: right"><i class="fa fa-retweet"></i> </div>
                                        <div class="col-sm-11">{{$feed->reply}}</div>
                                    </div>
                                @endif
                                <span class="cdate"><i class="far fa-calendar-alt"></i> {{$feed->created_at}}</span>
                                <span class="ips"><i class="fa fa-map-pin"></i> {{$feed->ip}}</span>
                            </li>
                        @php $i++ @endphp
                        @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <h3 class="head row"><span>Шүүлтүүр</span></h3>
                    <div class="left-side-filter">
                        <form method="get" action="{{asset('feedback')}}">
                        <div class="layout">
                            <label>Төлөв:
                            <select name="status" class="form-control-sm form-control">
                                <option value="">- сонгох -</option>
                                <option value="0">Хүлээж авсан</option>
                                <option value="1">Хариулсан</option>
                            </select> </label>
                        </div>
                        <div class="layout">
                            <label>Төрөл:
                                <select name="type" class="form-control-sm form-control">
                                    <option value="">Бүгд</option>
                                    <option value="0">Санал хүсэлт</option>
                                    <option value="1">Өргөдөл</option>
                                    <option value="2">Гомдол</option>
                                    <option value="3">Бусад</option>
                                </select>
                            </label>
                        </div>
                        <div class="layout"><label>Эхлэх огноо:
                                <input type="date" name="bdate" class="form-control-sm form-control"></label></div>
                        <div class="layout"><label>Дуусах огноо:
                                <input type="date" name="edate" class="form-control-sm form-control"></label></div>
                        <div class="layout text-right">
                            <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-filter"></i> Шүүх</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="background: rgba(38, 43, 73, 0.03)">
        <div class="container holboos">
            <a href=""><img src="{{ asset('main/sub/images/icons/suld.png')}}"> Аймгийн засаг даргын тамгын газар</a>
            <a href=""><img src="{{ asset('main/sub/images/icons/suld.png')}}"> Монгол улсын ерөнхийлөгчийн тамгын газар</a>
            <a href=""><img src="{{ asset('main/sub/images/icons/suld.png')}}"> Монгол улсын засгийн газар</a>
            <a href=""><img src="{{ asset('main/sub/images/icons/suld.png')}}"> Монгол улсын их хурал</a>
            <a href=""><img src="{{ asset('main/sub/images/icons/avilga.png')}}"> Авлигатай тэмцэх газар</a>
            <a href=""><img src="{{ asset('main/sub/images/icons/soyombo.png')}}"> Эрх зүйн мэдээллийн нэгдсэн сан</a>
        </div>
    </div>
@endsection