<!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <title>Accept your review</title>
    </head>
    <body>
    <p>Hello {{$review->customer_name}}</p>
    <p>Click <a href="{{url('/detail/'.$review->pro_id.'/'.$review->id.'/'.$review->token)}}">here</a> to accept your review
    </p>
    </body>
    </html>