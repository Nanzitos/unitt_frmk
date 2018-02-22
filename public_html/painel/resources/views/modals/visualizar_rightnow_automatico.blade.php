<div class="modal fade" id="popup-rightnow">
<div class="modal-dialog" style="width: 100%; margin: 0px; margin-left: 0px; margin-right: 0px;">
		<div class="modal-content">
			<div class="modal-header" style="padding: 0;border: 0;">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="margin: 10px 40px 0;font-size: 40px;">×</span></button>
			</div>
			<div class="modal-body">

				<!-- TOTAL -->
				<div class="card-block" style="display: inline-block;width: 100%;padding: 0;">
					<div class="table-responsive">
						<div class="table-responsive" style="overflow-y: auto;">
							<table class="table table-bordered table-striped m-b-0 responsive m-b-0" style="font-size: 10px;">
								<thead>
									<tr>
										<th><b>COST</b></th>
										<th><b>REV</b></th>
										<th><b>COST/REV</b></th>
										<th><b>PCM</b></th>
										<th><b>Share</b></th>
										<th><b>LAST PCM</b></th>
									</tr>
								</thead>
								<tbody>
									@foreach( $Model['total'] AS $key => $valT )
									@if( $valT['marca'] == 'Total' )
									<tr>
										<td><b>R$ {{ $valT['cost'] }}</b></td>
										<td><b>R$ {{ $valT['rev'] }}</b></td>
										<td><b>{{ $valT['costRev'] }}</b></td>
										<td><b>R$ {{ $valT['pcm'] }}</b></td>
										<td><b>{{ $valT['share'] }}</b></td>
										<td>
										@foreach ( $Model['lastPcm'] as $pcm ) 
										<b>{{ $pcm['pcm'] }}</b>
										@endforeach
										</td>
									</tr>
									@endif
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<!-- Canais -->
				<div class="card-block" style="display: inline-block;width: 12%;padding: 0;">
					<div class="table-responsive">
						<div class="table-responsive" style="overflow-y: auto;">
							<table class="table table-bordered table-striped m-b-0 responsive m-b-0" style="font-size: 10px;">
								<thead>
									<tr>
										<th style="text-align: center; color: #000;"><b>Hora: {{ $Model['hora'] }}</b></th>
									</tr>
									<tr>
										<th><b>Canal</b></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="total"><b>TOTAL</b></td>
									</tr>
									@foreach( $Model['canal'] AS $key => $val )
									@if( $val['marca'] == 1 )
									<tr>
										<td><b>{{ $val['source'] }}</b></td>
									</tr>
									@endif
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<!-- Marca 1 -->
				<div class="card-block" style="display: inline-block;width: 29%;padding: 0;">
					<div class="table-responsive">
						<div class="table-responsive" style="overflow-y: auto;">
							<table class="table table-bordered table-striped m-b-0 responsive m-b-0" style="font-size: 10px;">
								<thead>
									<tr>
										<th colspan="3" style="text-align: center; background: #cfe2f3; color: #000;">
											@foreach( $Model['total'] AS $key => $valT )
											@if( $valT['marca'] == 'Total Slimcaps' )
											<b>Slimcaps Share: {{ $valT['share'] }}% PCM: R$ {{ $valT['pcm'] }}</b>
											@endif
											@endforeach
										</th>
									</tr>
									<tr>
										<th><b>Cost</b></th>
										<th><b>Rev</b></th>
										<th><b>Cost/Rev</b></th>
									</tr>
								</thead>
								<tbody>							
									@foreach( $Model['total'] AS $key => $valT )
									@if( $valT['marca'] == 'Total Slimcaps' )
									<tr>
										<td class="total">R$ {{ $valT['cost'] }}</td>
										<td class="total">R$ {{ $valT['rev'] }}</td>
										<td class="total">{{ $valT['costRev'] }}</td>
									</tr>
									@endif
									@endforeach

									@foreach( $Model['canal'] AS $key => $val )
									@if( $val['marca'] == 1 )
									<tr>
										<td>R$ {{ $val['cost'] }}</td>
										<td>R$ {{ $val['rev'] }}</td>
										<td>{{ $val['costRev'] }}</td>
									</tr>
									@endif
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<!-- Marca 3 -->
				<div class="card-block" style="display: inline-block;width: 29%;padding: 0;">
					<div class="table-responsive">
						<div class="table-responsive" style="overflow-y: auto;">
							<table class="table table-bordered table-striped m-b-0 responsive m-b-0" style="font-size: 10px;">
								<thead>
									<tr>
										<th colspan="3" style="text-align: center; background: #f4cccc; color: #000;">
											@foreach( $Model['total'] AS $key => $valT )
											@if( $valT['marca'] == 'Total Haircaps' )
											<b>Haircaps Share: {{ $valT['share'] }}% PCM: R$ {{ $valT['pcm'] }}</b>
											@endif
											@endforeach
										</th>
									</tr>
									<tr>
										<th><b>Cost</b></th>
										<th><b>Rev</b></th>
										<th><b>Cost/Rev</b></th>
									</tr>
								</thead>
								<tbody>
									@foreach( $Model['total'] AS $key => $valT )
									@if( $valT['marca'] == 'Total Haircaps' )
									<tr>
										<td class="total">R$ {{ $valT['cost'] }}</td>
										<td class="total">R$ {{ $valT['rev'] }}</td>
										<td class="total">{{ $valT['costRev'] }}</td>
									</tr>
									@endif
									@endforeach

									@foreach( $Model['canal'] AS $key => $val )
									@if( $val['marca'] == 3 )
									<tr>
										<td>R$ {{ $val['cost'] }}</td>
										<td>R$ {{ $val['rev'] }}</td>
										<td>{{ $val['costRev'] }}</td>
									</tr>
									@endif
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<!-- Marca 4 -->
				<div class="card-block" style="display: inline-block;width: 29%;padding: 0;">
					<div class="table-responsive">
						<div class="table-responsive" style="overflow-y: auto;">
							<table class="table table-bordered table-striped m-b-0 responsive m-b-0" style="font-size: 10px;">
								<thead>
									<tr>
										<th colspan="3" style="text-align: center; background: #f9cb9c; color: #000;">
											@foreach($Model['total'] AS $key => $valT)
											@if($valT['marca'] == 'Total MyBeautyCaps')
											<b>MyBeautyCaps Share: {{ $valT['share'] }}% PCM: R$ {{ $valT['pcm'] }}</b>
											@endif
											@endforeach
										</th>
									</tr>
									<tr>
										<th><b>Cost</b></th>
										<th><b>Rev</b></th>
										<th><b>Cost/Rev</b></th>
									</tr>
								</thead>
								<tbody>
									@foreach( $Model['total'] AS $key => $valT )
									@if( $valT['marca'] == 'Total MyBeautyCaps' )
									<tr>
										<td class="total">R$ {{ $valT['cost'] }}</td>
										<td class="total">R$ {{ $valT['rev'] }}</td>
										<td class="total">{{ $valT['costRev'] }}</td>
									</tr>
									@endif
									@endforeach

									@foreach( $Model['canal'] AS $key => $val )
									@if( $val['marca'] == 4 )
									<tr>
										<td>R$ {{ $val['cost'] }}</td>
										<td>R$ {{ $val['rev'] }}</td>
										<td>{{ $val['costRev'] }}</td>
									</tr>
									@endif
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<!-- Canais -->
				<div class="card-block" style="display: inline-block;width: 12%;padding: 0;float: left;padding-top: 20px;margin-right: 4px;">
					<div class="table-responsive">
						<div class="table-responsive" style="overflow-y: auto;">
							<table class="table table-bordered table-striped m-b-0 responsive m-b-0" style="font-size: 10px;">
								<thead>
									<tr>
										<th style="text-align: center; color: #000;"><b>Hora: {{ $Model['hora'] }}</b></th>
									</tr>
									<tr>
										<th><b>Canal</b></th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="total"><b>TOTAL</b></td>
									</tr>
									@foreach( $Model['canal'] AS $key => $val )
									@if( $val['marca'] == 1 )
									<tr>
										<td><b>{{ $val['source'] }}</b></td>
									</tr>
									@endif
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<!-- Marca 5 -->
				<div class="card-block" style="display: inline-block;width: 29%;padding: 20px 0 0 0;">
					<div class="table-responsive">
						<div class="table-responsive" style="overflow-y: auto;">
							<table class="table table-bordered table-striped m-b-0 responsive m-b-0" style="font-size: 10px;">
								<thead>
									<tr>
										<th colspan="3" style="text-align: center; background: #a64d79; color: #000;">
											@foreach( $Model['total'] AS $key => $valT )
											@if( $valT['marca'] == 'Total Platinum4ever' )
											<b>Platinum4ever Share: {{ $valT['share'] }}% PCM: R$ {{ $valT['pcm'] }}</b>
											@endif
											@endforeach
										</th>
									</tr>
									<tr>
										<th><b>Cost</b></th>
										<th><b>Rev</b></th>
										<th><b>Cost/Rev</b></th>
									</tr>
								</thead>
								<tbody>
									@foreach( $Model['total'] AS $key => $valT )
									@if( $valT['marca'] == 'Total Platinum4ever' )
									<tr>
										<td class="total">R$ {{ $valT['cost'] }}</td>
										<td class="total">R$ {{ $valT['rev'] }}</td>
										<td class="total">{{ $valT['costRev'] }}</td>
									</tr>
									@endif
									@endforeach

									@foreach( $Model['canal'] AS $key => $val )
									@if( $val['marca'] == 5 )
									<tr>
										<td>R$ {{ $val['cost'] }}</td>
										<td>R$ {{ $val['rev'] }}</td>
										<td>{{ $val['costRev'] }}</td>
									</tr>
									@endif
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<!-- Marca 6 -->
				<div class="card-block" style="display: inline-block;width: 29%;padding: 20px 0 0 0;">
					<div class="table-responsive">
						<div class="table-responsive" style="overflow-y: auto;">
							<table class="table table-bordered table-striped m-b-0 responsive m-b-0" style="font-size: 10px;">
								<thead>
									<tr>
										<th colspan="3" style="text-align: center; background: #00ffff; color: #000;">
											@foreach($Model['total'] AS $key => $valT)
											@if($valT['marca'] == 'Total BeYoung')
											<b>BeYoung Share: {{ $valT['share'] }}% PCM: R$ {{ $valT['pcm'] }}</b>
											@endif
											@endforeach
										</th>
									</tr>
									<tr>
										<th><b>Cost</b></th>
										<th><b>Rev</b></th>
										<th><b>Cost/Rev</b></th>
									</tr>
								</thead>
								<tbody>
									@foreach( $Model['total'] AS $key => $valT )
									@if( $valT['marca'] == 'Total BeYoung' )
									<tr>
										<td class="total">R$ {{ $valT['cost'] }}</td>
										<td class="total">R$ {{ $valT['rev'] }}</td>
										<td class="total">{{ $valT['costRev'] }}</td>
									</tr>
									@endif
									@endforeach

									@foreach( $Model['canal'] AS $key => $val )
									@if( $val['marca'] == 6 )
									<tr>
										<td>R$ {{ $val['cost'] }}</td>
										<td>R$ {{ $val['rev'] }}</td>
										<td>{{ $val['costRev'] }}</td>
									</tr>
									@endif
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>