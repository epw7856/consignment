@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class="col-md-12">
                <div class="jumbotron-fluid">
                <h1 class="display-4 text-center">Admin Dashboard</h1>
              </div>
      </div>
      
        <div class="col-md-12">

           <span style="display:block; height: 20px;"></span>
          <div class="row justify-content-center align-items-center">
                    <h5>Current Date Filter: @php if (is_null($date)||($date=='All Time')||($date=='default')){ echo "None"; } else if ($date=='Current Month'){ echo Illuminate\Support\Carbon::now()->format('M'); echo " "; echo Illuminate\Support\Carbon::now()->format('Y');} else if ($date=='Current Year'){ echo Illuminate\Support\Carbon::now()->format('Y');}  else if ($date=='Current Week'){ echo "&nbsp"; echo Illuminate\Support\Carbon::now()->startOfWeek()->format('M d Y'); echo "&nbsp&nbspto&nbsp&nbsp"; echo Illuminate\Support\Carbon::now()->endOfWeek()->format('M d Y');} @endphp</h5>
                    <span style="display:block; width: 60px;"></span><h5>Current Customer Filter: @php if (is_null($customer)||($customer=='default')){ echo "None"; } else { echo $customer;} @endphp</h5>
          </div>



            <div>
                <span style="display:block; height: 20px;"></span>
                <div class="row align-items-center justify-content-center">
                  
                  <div class="col-md-3">

                    <div class="card border-success mb-3 text-center font-weight-bold" style="max-width: 20rem;">
                      <div class="card-header">Items Sold</div>
                      <div class="card-body">
                        <h4 class="card-title">@php if (!empty($sold)){ echo count($sold); } else { echo "0"; } @endphp</h4>
                      </div>
                    </div>

                  </div>

                  <div class="col-md-3">

                    <div class="card border-success mb-3 text-center font-weight-bold" style="max-width: 20rem;">
                      <div class="card-header">Gross Amount Sold</div>
                      <div class="card-body">
                        <h4 class="card-title">$@php echo number_format($amt, 2) @endphp</h4>
                      </div>
                    </div>
                     
                  </div>
                  
                  <div class="col-md-3">

                    <div class="card border-success mb-3 text-center font-weight-bold" style="max-width: 20rem;">
                      <div class="card-header">Sell Through %</div>
                      <div class="card-body">
                        <h4 class="card-title">@php echo number_format($sellthru, 1) @endphp%</h4>
                      </div>
                    </div>

                  </div>
              
                 
                 
                  <!--<div class="col-md-4"></div>-->
                  <div class="col-md-3">

                    <div class="card border-success mb-3 text-center font-weight-bold" style="max-width: 20rem;">
                      <div class="card-header">Total Consignment Profit</div>
                      <div class="card-body">
                        <h4 class="card-title">$@php echo number_format($profit, 2) @endphp</h4>
                      </div>
                    </div>
                    
                  </div>
                </div></div>
              
                
                </div>
            </div><span style="display:block; height: 20px;"></span>

          
          <form class="horizontal" method="GET" action="{{ url('/home-admin') }}" >
           
              <div class="row">
                <div class="col-sm-3">
                  <h5 style="position: relative;top: 50%;transform: translateY(-50%);">Filter By Date and Customer: </h5>
                  
                </div>
                <div class="col-md-2">

                  <select name="filterDate" class="form-control">
                    <option value="default">Select Date</option>
                    <option value="All Time">All Time</option>
                    <option value="Current Week">Current Week</option>
                    <option value="Current Month">Current Month</option>
                    <option value="Current Year">Current Year</option>
                  </select>
                  
                </div>

                <div class="col-md-3">
                  <select name="filterCustomer" class="form-control">
                      <option value="default">Select Customer</option>
                       <option value="All Customers">All Customers</option>
                    @foreach($cust as $cust)
                      <option value="{{ $cust->name }}">{{ $cust->name }}</option>
                    @endforeach
                  </select>
                </div>

                <button type="submit" class="btn btn-secondary btn-md">Filter</button>
              </div>
            
          </form>

            <span style="display:block; height: 30px;"></span>
            <div class="row">
                  <div class="col-md-16 col-lg-16">
                    @if(session('info'))
                    <div class="alert alert-success">
                      {{session('info')}}
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="alert alert-danger">
                      {{session('error')}}
                    </div>
                    @endif
                  </div>
            </div>
            <span style="display:block; height: 20px;"></span>


                <form class="horizontal" method="POST" action="{{ url('/insert') }}" >
                {{csrf_field()}}
                  <fieldset>
                    <div class="card-header"><h2>Add New Inventory Item</h2><span style="display:block; height: 20px;"></span>
                    <div class="row">
                    <div class="col-md-16 col-lg-16">
                    @if(count($errors) > 0)
                      @foreach($errors->all() as $error)
                        <div class="alert alert-danger">
                          {{$error}}
                        </div>
                      @endforeach
                    @endif
                    </div>
                    </div>


                    <div class="row">
                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="customerID1">Cust ID</label>
                          <input type="text" name="custid" class="form-control" id="customerID1" aria-describedby="emailHelp" placeholder="Cust ID">           
                        </div>
                      </div>

                      <div class="col-md-1">
                        <div class="form-group">
                          <label for="sku1">SKU</label>
                          <input type="text" name="sku" class="form-control" id="sku1" aria-describedby="emailHelp" placeholder="SKU">           
                        </div>
                      </div>

                      <div class="col-md-1">
                        <div class="form-group">
                          <label for="loc1">Loc</label>
                          <input type="text" name="loc" class="form-control" id="loc1" aria-describedby="emailHelp" placeholder="Loc">           
                        </div>
                      </div>

                      <div class="col-md-8">
                        <div class="form-group">
                          <label for="title1">Item Title</label>
                          <input type="text" name="title" class="form-control" id="title1" aria-describedby="emailHelp" placeholder="Item Title">
                        </div>
                      </div>

                    </div>

                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="received1">Date Received</label>
                          <input type="text" name="received" class="form-control datepicker" id="received1" aria-describedby="emailHelp" placeholder="mm/dd/yyyy">
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="listed1">Date Listed</label>
                          <input type="text" name="listed" class="form-control datepicker" id="listed1" aria-describedby="emailHelp" placeholder="mm/dd/yyyy">
                        </div>
                      </div>

                      <div class="col-md-1">
                        <div class="form-group">
                          <label for="qty1">Qty</label>
                          <input type="text" name="qty" class="form-control" id="qty1" aria-describedby="emailHelp" placeholder="Qty">      
                        </div>
                      </div>

                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="platform1">Platform</label>
                          <input type="text" name="platform" class="form-control" id="platform1" aria-describedby="emailHelp" placeholder="Platform">
                        </div>
                      </div>

                      <div class="col-md-2">
                        <div class="form-group">
                          <label for="status1">Status</label>
                          <div class="row">
                            <input type="radio" name="status" id="r1" value="LISTED"/>LISTED
                          </div>
                          <div class="row">
                            <input type="radio" name="status" id="r2" value="BUNDLE"/>BUNDLE
                          </div>
                        </div>
                      </div>
                    </div>

                    
                    </fieldset>
                    <span style="display:block; height: 10px;"></span>
                    *Note: Item ID will be created automatically
                    <span style="display:block; height:20px;"></span>
                    <button type="submit" class="btn col-md-1 btn-primary">Submit</button>
                    <button type="button" onclick="clearFields()" class="btn col-md-1 btn-secondary">Clear</button>
                   </form>
                  </fieldset>
                

              <span style="display:block; height: 50px;"></span>

                <div class="card-header border"><h2>Active Inventory</h2></div>
                          @if(!empty($listed))
                            @if(count($listed)>0)
                            <table class="specialTable">
                              <col width="5.5%"> <!-- Cust ID -->
                              <col width="4.5%"> <!-- SKU -->
                              <col width="4.5%"> <!-- LOC -->
                              <col width="13.75%"> <!-- Item ID -->
                              <col width="32.45%"> <!-- Item Title -->
                              <col width="8.35%"> <!-- Listed -->
                              <col width="4.0%"> <!-- Qty -->
                              <col width="7.25%"> <!-- Platform -->
                              <col width="6.90%"> <!-- Status -->
                              <col width="11.80%"> <!-- Action -->
                              <thead>
                                <tr>
                                  <th><div class="sorting"><a href="#" id="link" data-column="0" data-direction="0">Cust ID</a></div></th>
                                  <th><div class="sorting"><a href="#" id="link" data-column="1" data-direction="0">SKU</a></div></th>
                                  <th><div class="sorting"><a href="#" id="link" data-column="2" data-direction="0">Loc</a></div></th>
                                  <th><div class="sorting"><a href="#" id="link" data-column="3" data-direction="0">Item ID</a></div></th>
                                  <th><div class="sorting"><a href="#" id="link" data-column="4" data-direction="0">Item Title</a></div></th>
                                  <th><div class="sorting"><a href="#" id="link" data-column="5" data-direction="0">Listed</a></div></th>
                                  <th><div class="sorting"><a href="#" id="link" data-column="6" data-direction="0">Qty</a></div></th>
                                  <th><div class="sorting"><a href="#" id="link" data-column="7" data-direction="0">Platform</a></div></th>
                                  <th><div class="sorting"><a href="#" id="link" data-column="8" data-direction="0">Status</a></div></th>
                                  <th>Action</th>
                                  
                                </tr>
                              </thead>
                            </table>
                            
                            <div class="span3 border">
                            <table id="table1" class="table table-fixed table-striped tablesorter">
                              <col width="5.5%"> <!-- Cust ID -->
                              <col width="4.5%"> <!-- SKU -->
                              <col width="4.5%"> <!-- LOC -->
                              <col width="13.75%"> <!-- Item ID -->
                              <col width="32.45%"> <!-- Item Title -->
                              <col width="8.35%"> <!-- Listed -->
                              <col width="4.0%"> <!-- Qty -->
                              <col width="7.25%"> <!-- Platform -->
                              <col width="6.90%"> <!-- Status -->
                              <col width="11.80%"> <!-- Action -->
                              <thead>
                                  <tr style="display:none;">
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                      <th></th>
                                  </tr>
                              </thead>
                              <tbody>
                                      @foreach($listed->all() as $listed)
                                  <tr>
                                  <td>{{ $listed->custid }}</td>
                                  <td>{{ $listed->sku }}</td>
                                  <td>{{ $listed->loc }}</td>
                                  <td>{{ $listed->itemid }}</td>
                                  <td class="specialtd">{{ $listed->title }}</td>
                                  <td>@php 
                                        echo App\Http\Controllers\UserController::dtform($listed->listed, "Y-m-d", "-", "/");
                                      @endphp</td>
                                  <td>{{ $listed->qty }}</td>
                                  <td>{{ $listed->platform }}</td>
                                  <td>{{ $listed->status }}</td>
                                  <td>
                                    <a href='{{ url("/update/{$listed->itemid}") }}' class="label label-success">Update |</a>
                                    <a href='{{ url("/delete/{$listed->itemid}") }}' class="label label-danger">Delete</a>
                                  </td>
                                  </tr> 
                                      @endforeach
                              </tbody>
                            </table>
                            </div>
                            @else
                              <span style="display:block; height: 20px;"></span>
                              <h6>No Active Inventory to show!</h6>
                            @endif
                          @else
                              <h6>No Active Inventory to show!</h6>
                          @endif


                            <span style="display:block; height: 50px;"></span>
                            

            </div>
      </div>
</div>
<script src="{{ url('js/clearFields.js') }}"></script>
<script src="{{ url('js/calendar.js') }}"></script>
<script src="{{ url('js/sortInventoryTable.js') }}"></script>
@endsection
