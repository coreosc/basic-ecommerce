@extends('layouts.app')

@section('content')
    <checkout inline-template deliveries-json='{!! $deliveries->toJson() !!}'
              my-addresses-json='{!! $myAddresses->toJson() !!}'>
        <div class="container">
            <div class="row">

                <div class="col-md-6">

                </div>
                <div class="col-md-3">
                    Cena przy płatności z góry
                </div>
                <div class="col-md-3">
                    Cena przy płatności przy odbiorze
                </div>
                @foreach($deliveries as $delivery)
                    <div class="col-md-6">
                        {{ $delivery['name'] }}
                    </div>
                    <div class="col-md-3">
                        {{ $delivery['price'] }}
                        <input name="delivery" type="radio" v-on:click="selectDelivery({{$delivery['id']}})"/>
                    </div>
                    <div class="col-md-3">
                        @if($delivery['cod'] == true)
                            {{ $delivery['price_cod'] +  $delivery['price']}}
                            <input name="delivery" type="radio" v-on:click="selectDelivery({{$delivery['id']}})"/>
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="row" v-if="delivery && deliveries[delivery]['type'] == 'local_address'">
                <div class="col-md-12">
                    <h3>Wybierz punkt odbioru</h3>

                    @foreach($localStorages as $storage)
                        <div class="col-md-3 panel panel-default">
                            <div class="panel-heading">{{$storage['name']}}</div>
                            <div class="panel-body">
                                {{$storage['street']}}
                                {{$storage['street_number']}}
                                {{$storage['flat_number']}}<br/>
                                {{$storage['post_code']}}
                                {{$storage['city']}}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>


            <div class="row" v-if="delivery && deliveries[delivery]['type'] == 'full_address'">
                <div class="col-md-12" v-if="myAddresses.length">
                    <h3>Wybierz adres</h3>

                    <div class="col-md-3 panel panel-default" v-for="address in myAddresses">
                        <div class="panel-heading">@{{address['first_name']}} @{{address['last_name']}}</div>
                        <div class="panel-body">
                            @{{address['street']}}
                            @{{address['street_number']}}
                            @{{address['flat_number']}}<br/>
                            @{{address['post_code']}}
                            @{{address['city']}}
                        </div>
                    </div>

                    <div class="col-md-3 panel panel-default">
                        <div class="panel-body">
                            <button>Dodaj nowy adres</button>
                        </div>
                    </div>

                </div>

                <div class="col-md-8 col-md-offset-2" v-if="!myAddresses.length">
                    <div class="panel panel-default">
                        <div class="panel-heading">Adres dostawy</div>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" method="POST">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                    <label for="first_name" class="col-md-4 control-label">Imię</label>

                                    <div class="col-md-6">
                                        <input id="first_name" type="text" class="form-control" name="first_name"
                                               value="{{ old('first_name') }}" required autofocus>

                                        @if ($errors->has('first_name'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                    <label for="last_name" class="col-md-4 control-label">Nazwisko</label>

                                    <div class="col-md-6">
                                        <input id="last_name" type="text" class="form-control" name="last_name"
                                               value="{{ old('last_name') }}" required autofocus>

                                        @if ($errors->has('last_name'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group{{ $errors->has('street') ? ' has-error' : '' }}">
                                    <label for="street" class="col-md-4 control-label">Ulica</label>

                                    <div class="col-md-6">
                                        <input id="street" type="text" class="form-control" name="street"
                                               value="{{ old('street') }}" required>

                                        @if ($errors->has('street'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('street') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('street_number') ? ' has-error' : '' }}">
                                    <label for="street_number" class="col-md-4 control-label">Nr ulicy</label>

                                    <div class="col-md-6">
                                        <input id="street_number" type="text" class="form-control" name="street_number"
                                               value="{{ old('street_number') }}" required>

                                        @if ($errors->has('street_number'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('street_number') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('flat_number') ? ' has-error' : '' }}">
                                    <label for="flat_number" class="col-md-4 control-label">Nr domu <br/><sup>(opcjonalnie)</sup></label>

                                    <div class="col-md-6">
                                        <input id="flat_number" type="text" class="form-control" name="flat_number"
                                               value="{{ old('flat_number') }}"/>

                                        @if ($errors->has('flat_number'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('flat_number') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('post_code') ? ' has-error' : '' }}">
                                    <label for="post_code" class="col-md-4 control-label">Kod pocztowy</label>

                                    <div class="col-md-6">
                                        <input id="post_code" type="text" class="form-control" name="post_code"
                                               value="{{ old('post_code') }}" required>

                                        @if ($errors->has('post_code'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('post_code') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                    <label for="city" class="col-md-4 control-label">Miasto</label>

                                    <div class="col-md-6">
                                        <input id="city" type="text" class="form-control" name="city"
                                               value="{{ old('city') }}" required>

                                        @if ($errors->has('city'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('city') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                    <label for="phone" class="col-md-4 control-label">Telefon</label>

                                    <div class="col-md-6">
                                        <input id="phone" type="text" class="form-control" name="phone"
                                               value="{{ old('phone') }}" required>

                                        @if ($errors->has('phone'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <a class="btn btn-primary" @click="upsertDeliveryAddress()">
                                            Dodaj adres
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </checkout>
@endsection