
          <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text h-100 selected-icon"></span>
        </div>

          {!!Form::text('category_icon',null,array('class'=>'form-control iconpicker','placeholder'=>'Select Category Icons','autocomplete'=>'off','required')) !!} 
    </div>

<link rel="stylesheet" type="text/css" href="{{ asset('public/css/bootstrap.min.css') }}">

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">

<script src="{{ asset('public/js/bootstrap.min.js')}}"></script>

<script async src="{{ asset('public/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('public/js/jquery-3.3.1.min.js')}}"></script>

<script src="{{asset('public/dist/iconpicker.js')}}"></script>



<script type="text/javascript">
     


     (async () => {
         
            const response = await fetch(@json(url('public/dist/iconsets/bootstrap5.json')))
            const result = await response.json()


            const iconpicker = new Iconpicker(document.querySelector(".iconpicker"), {
                icons: result,
                showSelectedIn: document.querySelector(".selected-icon"),
                searchable: true,
                selectedClass: "selected",
                containerClass: "my-picker",
                hideOnSelect: true,
                fade: true,
                defaultValue: 'bi-alarm',
                valueFormat: val => `bi ${val}`
            });

            iconpicker.set() // Set as empty
            iconpicker.set('bi-alarm') // Reset with a value
        })()
        

</script>


