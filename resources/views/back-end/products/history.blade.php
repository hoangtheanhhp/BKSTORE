@extends('back-end.layouts.master')
@section('content')
    <div class="col-sm-9 col-sm-offset-2 col-md-9 col-md-offset-2" style="margin-top: 20px;">
        <header style="color: #5bc0de">Lịch sử sản phẩm {{$product->name}}</header>
    <div class="row">
    <div class="panel-body" style="font-size: 12px;">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Thời điểm tạo</th>
                    <th>Người tạo</th>
                    <th>Thời điểm update</th>
                    <th>Người update</th>
                    {{--<th>Giá bán trước đó</th>
                    <th>Giá bán sau update</th>
                    <th>Số lượng trước </th>
                    <th>Số lượng sau update</th>--}}
                </tr>
                </thead>
                <tbody>
                @foreach($adminPros as $row)
                    <tr>
                        <th><img src="{!!url('images/phone/'.$product->images)!!}" alt="iphone" width="50" height="40"> </th>
                        <th>
                            {{$product->name}}
                        </th>
                        <th>
                            {{$product->created_at}}
                        </th>
                        <th> {{$admin}}</th>
                        <th>{{$row->pivot->updated_at}}</th>
                        <th>{{$row->name}}</th>
                    <tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
    </div>
@endsection