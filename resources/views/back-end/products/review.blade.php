@extends('back-end.layouts.master')
@section('content')
    <div class="col-sm-10 col-sm-offset-2 col-md-10 col-md-offset-2" style="margin-top: 20px;">
        <header style="color: #5bc0de">Nhận xét sản phẩm {{$product->name}}</header>
        <div class="row">
            <div class="panel-body" style="font-size: 12px;">
                <div class="table-responsive">
                    @foreach($reviews as $review)
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Hình ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Thời điểm tạo</th>
                            <th>Người nhận xét</th>
                            <th>Email</th>
                            <th>Đánh giá</th>
                            <th>Admin xử lý</th>
                            <th>Thời điểm xử lý</th>
                            <th>Trạng thái</th>
                            <th>Actions</th>
                            {{--<th>Giá bán trước đó</th>
                            <th>Giá bán sau update</th>
                            <th>Số lượng trước </th>
                            <th>Số lượng sau update</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th><img src="{!!url('/images/phone/'.$product->images)!!}" alt="{{$product->images}}" width="50" height="40"> </th>
                                <th>
                                    {{$product->name}}
                                </th>
                                <th>
                                    {{$product->created_at}}
                                </th>
                                <th>{{$review->customer_name}}</th>
                                <th>{{$review->customer_email}}</th>
                                <th>{{$review->customer_rating}} sao</th>
                                <th>{{$review->name}}</th>
                                <th>{{$review->updated_at}}</th>
                                <th>
                                    @if($review->status == 0)
                                        <span style="color: #d9534f;">Chưa xác thực</span>
                                        @elseif($review->status == 1)
                                        <span style="color: #398439">Đã xác thực</span>
                                        @else
                                        <span style="color: #25b4cb">Đã đăng lên</span>
                                    @endif
                                </th>
                                <th> <a class="btn btn-success" href="{{url('admin/sanpham/review/'.$product->id.'/'.$review->id)}}">Đăng lên</a></th>
                            <tr>

                            <tr>
                                <th colspan="8">
                                    <span style="color: #316ac5"> Nội dung nhận xét:</span> <span style="color: red;">{{$review->review}}
                                    </span>
                                </th>
                            </tr>
                        </tbody>

                    </table>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection