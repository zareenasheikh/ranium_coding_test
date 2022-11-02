<style>
.dropdown-menu{
    left: -150px !important;
}
    
</style>

<div class="row">
    <div>
        <hr class="top-line">
        <div class="d-flex col-md-10 justify-content-between">
            <a href="{{url('/home')}}"><div class="title"><i class="fab fa-google"></i> Asteroid - Neo Stats
 </div></a>
            <div class="d-flex float-end">
                <div class="setting mx-3" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-cog"></i>
                </div>


                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="{{url('/home')}}">Home</a>
                   

                </div>
                
                

{{-- <div class="btn-group">

<div class="profile mx-1 dropdown-toggle"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<img class="profile-img"
src="{{asset('public/images/user_icon.png')}}" alt="" width="25px">
</div>
<div class="dropdown-menu">
<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
document.getElementById('logout-form').submit();">Logout</a>

</div>
</div> --}}
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>



      </div>
  </div>
  
  
  
</div>
</div>