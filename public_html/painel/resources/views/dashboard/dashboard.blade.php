@extends('layouts.master')

@section('main')
<div class="main-content">
	<div class="m-x-n-g m-t-n-g overflow-hidden">
	  <div class="card m-b-0 bg-primary-dark text-white p-a-md no-border">
	    <h4 class="m-t-0">
	      <span class="pull-right">$ 82,560.00 This week</span>
	      <span>Activity</span>
	      </h4>
	    <div class="chart dashboard-line labels-white" style="height:300px"></div>
	  </div>
	  <div class="card bg-white no-border">
	    <div class="row text-center">
	      <div class="col-sm-3 col-xs-6 p-t p-b">
	        <h4 class="m-t-0 m-b-0">$ 89.34</h4>
	        <small class="text-muted bold">Daily Sales</small>
	      </div>
	      <div class="col-sm-3 col-xs-6 p-t p-b">
	        <h4 class="m-t-0 m-b-0">$ 498.00</h4>
	        <small class="text-muted bold">Weekly Sales</small>
	      </div>
	      <div class="col-sm-3 col-xs-6 p-t p-b">
	        <h4 class="m-t-0 m-b-0">$ 34,903</h4>
	        <small class="text-muted bold">Monthly Sales</small>
	      </div>
	      <div class="col-sm-3 col-xs-6 p-t p-b">
	        <h4 class="m-t-0 m-b-0">$ 98,343.49</h4>
	        <small class="text-muted bold">Yearly Sales</small>
	      </div>
	    </div>
	  </div>
	</div>
</div>
@stop