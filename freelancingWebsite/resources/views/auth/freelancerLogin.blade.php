<html>
    <head>
<style>
/* all */
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap");

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}

:root {
  --main-blue: #71b7e6;
  --main-purple: #9b59b6;
  --main-grey: #ccc;
  --sub-grey: #d9d9d9;
}

body {
  display: flex;
  height: 80vh;
  justify-content: center; /*center vertically */
  align-items: center; /* center horizontally */
  padding: 10px;
}
/* container and form  linear-gradient(135deg, var(--main-blue), var(--main-purple))*/
.container {
    margin-top: 200px;
    border:1px solid #eee ;

  max-width: 700px;
  width: 100%;
  background: #fff;
  padding: 25px 30px;
  border-radius: 5px;
}
.container .title {
  font-size: 25px;
  font-weight: 500;
  position: relative;
}

.container .title::before {
  content: "";
  position: absolute;
  height: 3.5px;
  width: 30px;
  background: linear-gradient(135deg, var(--main-blue), var(--main-purple));
  left: 0;
  bottom: 0;
}

.container form .user__details {
  display: block;
  margin: 20px 0 12px 0;
}
/* inside the form user details */
form .user__details .input__box {
  width: 100%;
  margin-bottom: 15px;
}

.user__details .input__box .details {
  font-weight: 500;
  margin-bottom: 5px;
  display: block;
}
option{
    width:50%;
}

.user__details .input__box input ,.user__details .input__box select{
  height: 45px;
  width: 100%;
  outline: none;
  border-radius: 5px;
  border: 1px solid var(--main-grey);
  padding-left: 15px;
  font-size: 16px;
  border-bottom-width: 2px;
  transition: all 0.3s ease;
}
.text-danger{
    color:red;
    font-size: 12px;


}



.user__details .input__box input:focus,
.user__details .input__box select:focus,
.user__details .input__box input:valid,
.user__details .input__box select:valid,
 {
  border-color: var(--main-purple);
}

/* inside the form gender details */

form .gender__details .gender__title {
  font-size: 20px;
  font-weight: 500;
}

form .gender__details .category {
  display: flex;
  width: 80%;
  margin: 15px 0;
  justify-content: space-between;
}

.gender__details .category label {
  display: flex;
  align-items: center;
}

.gender__details .category .dot {
  height: 18px;
  width: 18px;
  background: var(--sub-grey);
  border-radius: 50%;
  margin: 10px;
  border: 5px solid transparent;
  transition: all 0.3s ease;
}

#dot-1:checked ~ .category .one,
#dot-2:checked ~ .category .two,
#dot-3:checked ~ .category .three {
  border-color: var(--sub-grey);
  background: var(--main-purple);
}

form input[type="radio"] {
  display: none;
}

/* submit button */
form .button {
  height: 45px;
  margin: 45px 0;
  display: flex;
  justify-content: space-between;
}

form .button button {
  height: 100%;
  width: 100%;
  outline: none;
  color: #fff;
  margin-right:20px;
  border: none;
  font-size: 18px;
  font-weight: 500;
  border-radius: 5px;
  background: linear-gradient(135deg, var(--main-blue), var(--main-purple));
  transition: all 0.3s ease;
}

form .button button:hover {
  background: linear-gradient(-135deg, var(--main-blue), var(--main-purple));
}

@media only screen and (max-width: 584px) {
  .container {
    max-width: 100%;
  }

  form .user__details .input__box {
    margin-bottom: 15px;
    width: 100%;
  }

  form .gender__details .category {
    width: 100%;
  }

  .container form .user__details {
    max-height: 300px;
    overflow-y: scroll;
  }

  .user__details::-webkit-scrollbar {
    width: 0;
  }
}

</style>
    </head>
    <body>
        <div class="container">
            <div class="title">Login</div>
            <form method="POST" action="{{ route('login.freelancer') }}">

                @csrf
              <div class="user__details">

                <div class="input__box">
                    <span class="details">Email</span>
                    <input type="email"  name="email"  value="{{old ('email')}}" placeholder="johnsmith@hotmail.com" required style="width: 100%">
                    @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                  </div>



                <div class="input__box">
                  <span class="details">Password</span>
                  <input type="password"  name="password" placeholder="********" required>
                  @if ($errors->has('password'))
                  <span class="text-danger">{{ $errors->first('password') }}</span>
              @endif
                </div>

                <span style="font-size: 12px;color:#aaa;padding-top:20px">you  dont  have account yet  <a href="{{route('register')}}">sign up</a> </span>


              <div class="button">
                <button type="submit"  name="submit" >Login</button>
              </div>
            </form>
          </div>

    </body>
</html>

