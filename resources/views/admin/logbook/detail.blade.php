@extends('layouts.dashboard')
@section('content')
<div class="container py-5">

  @extends('layouts.dashboard')
@section('content')


<div class="container py-4">
    <a href="{{ route('admin.logbook.index') }}"> < Kembali</a>
      <p><img src="/assets/img/kupu.jpg" class="rounded-circle" width="50" height="50" style="object-fit:cover"/> Rizka Amelia - 203200117</></p> 
    <div class="col-md mb-4 mb-md-0">
        <div class="accordion mt-3" id="accordionExample">
          <div class="card accordion-item active">
            <h2 class="accordion-header" id="headingOne">
              <button
                type="button"
                class="accordion-button"
                data-bs-toggle="collapse"
                data-bs-target="#accordionOne"
                aria-expanded="true"
                aria-controls="accordionOne"
              >
                Accordion Item 1
              </button>
            </h2>

            <div
              id="accordionOne"
              class="accordion-collapse collapse show"
              data-bs-parent="#accordionExample"
            >
              <div class="accordion-body">
                Lemon drops chocolate cake gummies carrot cake chupa chups muffin topping. Sesame snaps icing
                marzipan gummi bears macaroon dragée danish caramels powder. Bear claw dragée pastry topping
                soufflé. Wafer gummi bears marshmallow pastry pie.
              </div>
            </div>
          </div>
          <div class="card accordion-item">
            <h2 class="accordion-header" id="headingTwo">
              <button
                type="button"
                class="accordion-button collapsed"
                data-bs-toggle="collapse"
                data-bs-target="#accordionTwo"
                aria-expanded="false"
                aria-controls="accordionTwo"
              >
                Accordion Item 2
              </button>
            </h2>
            <div
              id="accordionTwo"
              class="accordion-collapse collapse"
              aria-labelledby="headingTwo"
              data-bs-parent="#accordionExample"
            >
              <div class="accordion-body">
                Dessert ice cream donut oat cake jelly-o pie sugar plum cheesecake. Bear claw dragée oat cake
                dragée ice cream halvah tootsie roll. Danish cake oat cake pie macaroon tart donut gummies.
                Jelly beans candy canes carrot cake. Fruitcake chocolate chupa chups.
              </div>
            </div>
          </div>
          <div class="card accordion-item">
            <h2 class="accordion-header" id="headingThree">
              <button
                type="button"
                class="accordion-button collapsed"
                data-bs-toggle="collapse"
                data-bs-target="#accordionThree"
                aria-expanded="false"
                aria-controls="accordionThree"
              >
                Accordion Item 3
              </button>
            </h2>
            <div
              id="accordionThree"
              class="accordion-collapse collapse"
              aria-labelledby="headingThree"
              data-bs-parent="#accordionExample"
            >
              <div class="accordion-body">
                Oat cake toffee chocolate bar jujubes. Marshmallow brownie lemon drops cheesecake. Bonbon
                gingerbread marshmallow sweet jelly beans muffin. Sweet roll bear claw candy canes oat cake
                dragée caramels. Ice cream wafer danish cookie caramels muffin.
              </div>
            </div>
          </div>
        </div>
      
</div>

























@endsection
    
   
   
@endsection