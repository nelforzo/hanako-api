<script src="{{asset('css/forms.css')}}"></script> 
<div class="container">
<div>
  <p class="title">new user</p>
</div>
<div>
  <form method="POST" action="create">
    @csrf
    first name<br>
    <input type="text" name="first_name" id="first_name"><br>
    last name<br>
    <input type="text" name="last_name" id="last_name"><br>
    first name (kana)<br>
    <input type="text" name="first_name_kana" id="first_name_kana"><br>
    last name (kana) <br>
    <input type="text" name="last_name_kana" id="last_name_kana"><br>
    mail address<br>
    <input type="text" name="mail_address" id="mail_address"><br>
    @error('mail_address')
    <span class="error">{{$message}}</span>
    @enderror
    password<br>
    <input type="password" name="password" id="password"><br>
    @error('password')
    <span class="error">{{$message}}</span>
    @enderror
    password confirmation<br>
    <input type="password" name="password_confirmation" id="password_confirmation"><br>
    @error('password_confirmation')
    <span class="error">{{$message}}</span>
    @enderror
    <button type="submit">create new user</button>
  </form>
</div>
</div>
