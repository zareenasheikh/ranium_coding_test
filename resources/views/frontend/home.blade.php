@extends('layouts.app')
@section('title',"Tech mahindra job opportunity and code test")
<!-- ................Add meta ................ -->


@section('meta')
@endsection

<!-- ................custom css................. -->

@section('customStyle')
<style type="text/css">
    body {
        position: relative;
    }
</style>
@endsection

<!-- ................Add css link................. -->

@push('style')


@endpush

@section('content')


<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
  }

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}

.justify-content-between{
    margin-bottom: 20px;
}

.table-bordered .m-auto{

    margin-top: 30px;
}

.margin_content{

    margin: 0 auto;
}

</style>

<div class="container">
    @include('layouts.header')

    <div class="row  mt-5">
        @if ($errors->has('msg'))
<span class="alert alert-danger" >
<strong>{{ $errors->first('msg') }}</strong>
</span>                             
@endif
       <div class="col-md-10 margin_content" >

        <div class=" justify-content-between" >


           <div class="row">
             <div class="col-md-3">
                <label for="" class="col-form-label">Start Date</label>
                {!!Form::text('start_date',Request::input('start_date'),array('class'=>'form-control datepicker-here','autocomplete'=>'off','data-language'=>'en','data-date-format'=>'yyyy-mm-dd','id'=>'start_date_id')) !!} 
            </div>
            <div class="col-md-3">
                <label for="" class="col-form-label">End Date</label>
                {!!Form::text('end_date',Request::input('end_date'),array('class'=>'form-control datepicker-here','autocomplete'=>'off','data-language'=>'en','data-date-format'=>'yyyy-mm-dd','id'=>'end_date_id')) !!} 
            </div>
            <div class="col-md-3">
               <button class="btn btn-success" style="margin-top: 35px;" id="getPrice">Submit</button>
           </div>
       </div>

   </div>


   <div class="container-fluid">

     <nav class="mb-5">
      <div class="nav nav-tabs" id="nav-tab" role="tablist">

        <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">View</button>

        <button class="nav-link " id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Chart View</button>

    </div>
</nav>




</div>


<div class="tab-content" id="nav-tabContent">

  <div class="tab-pane fade show active me-lg-4" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">



    <table class="table table-striped table-hover table-bordered m-auto" >
        <thead>
            <tr>
                <th scope="col">Sr.</th>
                <th scope="col">Date</th>
                <th scope="col">Fastest Asteroid (km/h)</th>
                <th scope="col">Closest Asteroid (km)</th>
                <th scope="col">Average Size (km)</th>

            </tr>
        </thead>
        <tbody>
           @if(!empty($records))
           @foreach($records as $index=>$data)
           <tr class="deleteRow">
            <th scope="row">{{$index+1}}</th>
            <td class="m-auto" >{{ $data->date }}</td>
            <td class="m-auto" >{{ $data->velocity }}</td>
            <td class="m-auto" >{{ $data->distance }}</td>
            <td class="m-auto" >{{ $data->average_size }}</td>

        </tr>
        @endforeach
        @endif

    </tbody>
</table>

</div>


<div class="tab-pane fade  me-lg-5" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
  <canvas id="lineChart"></canvas>
</div>

</div>




</div>
</div>
</div>





@endsection

<!-- ................push new js link................. -->

@push('js')

<script src="{{asset('public/js/validation.js')}}"></script>

<script src="{{ asset('public/js/Chart.min.js') }}"></script>


<script type="text/javascript">

     function encodeQuery(data) {
            let ret = [];
            for (let d in data)
            if (data[d]) {
                ret.push(encodeURIComponent(d) + '=' + encodeURIComponent(data[d]));
            }
            return ret.join('&');
        }


// ....................
$(document).on('click', '#getPrice', function(e) {


 var start_date_cls=$("#start_date_id").val();
 var end_date_cls=$("#end_date_id").val();



            if(start_date_cls){
              var start_date = start_date_cls;
            }else{
              var start_date = '{{ \Request::input('start_date') }}';
            }

   if(end_date_cls){
              var end_date = end_date_cls;
            }else{
              var end_date = '{{ \Request::input('end_date') }}';
            }

          

  var postParam = {
                'start_date': start_date,
                'end_date': end_date,
               

}
    var querystring = encodeQuery(postParam);


var urls = @json(url('/home/'))+'?'+querystring;

urls=urls.toLowerCase(urls);

history.pushState('', '', urls)
location.href =urls;

})


// ....................

$(document).on('click', '.subcategory_cls', function(e) {



             if($(this).is(':checked')){
              var subcategory_cls = $(this).val();
            }else{
              var subcategory_cls = '';
            }


          var category_cls = $('#product_cats_id').val();


              if(!category_cls){
                var category_cls = '{{ \Request::input('category') }}';
              }


               if($('.brand_cls').is(':checked')){
              var brand_cls = $('input[name=brand]:checked').val();
            }
            else{
              var brand_cls = '{{ \Request::input('brand') }}';
            }



var sorting_cls = $('.sorting_cls').val()

if (!sorting_cls) {
var sorting_cls = '{{ \Request::input('sort') }}';
}


var keyword_cls = $('.keyword_cls').val();

          if(!keyword_cls){
                var keyword_cls = '{{ \Request::input('keyword') }}';
              }


  var postParam = {
                'category': category_cls,
                'subcategory': subcategory_cls,
                'brand': brand_cls,
                'keyword':keyword_cls,
                'sort':sorting_cls,

}
    var querystring = encodeQuery(postParam);


// var urls= {!! json_encode(url('/')) !!} +'/' +'{{ \Request::segment(1) }}' +'/' +'{{ \Request::segment(2) }}'+'?'+querystring;

var urls = @json(url('/order/'.Request::segment(2)))+'?'+querystring;

urls=urls.toLowerCase(urls);

history.pushState('', '', urls)
location.href =urls;

})


</script>



<script>
   var ctxL = document.getElementById("lineChart").getContext('2d');
   var myLineChart = new Chart(ctxL, {
      type: 'line',
      data: {
        labels: @json($asteroid_date),


        datasets: [{
          label: "Date Wise",
          data:@json($total_asteroid),




          backgroundColor: [
          'rgb(199 242 255)',
          ],
          borderColor: [
          'rgb(131 230 251)',
          ],
          borderWidth: 2
      },

      ]
  },


  options: {
    responsive: true
}
});

</script>
@endpush


