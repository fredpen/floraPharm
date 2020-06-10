<div>
    <div>Welcome,  <b>{{$user->first_name}}</b></div>
    <div>click on this <a href="{{url('/forget-password/'.$token. '?email=' . urlencode($user->email))}}">link</a> to proceed</div>


</div>
