<h1>please verify your account first.</h1>
<form action="{{route('verification.send')}}" method="post">
    @csrf
You did not active your email yet, please <button type="submit">active your email</button> to do this action.
</form>
