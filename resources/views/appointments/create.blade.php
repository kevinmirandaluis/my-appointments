@extends('layouts.panel')

@section('content')
<div class="card shadow">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Registrar Nueva Cita</h3>
            </div>
            <div class="col text-right">
              <a href="{{ url('patients')}}" class="btn btn-sm btn-default">
              	Cancelar y Volver
              </a>
            </div>
          </div>
        </div>
     <div class="card-body">
      @if ($errors->any())
      <div class="alert alert-danger" role="alert">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
      <form action="{{url('appointments')}}" method="post">
        @csrf

        <div class="form-group">
          <label for="description">Descripcion</label>
          <input name="description" value="{{ old ('description')}}" type="text" class="form-control" id="description" placeholder="Describe brevemente la consulta" required>
        </div>

         <div class="form-row">
         <div class="form-group col-md-6">
           <label for="specialty">Especialidad</label>
              <select name="specialty_id" id="specialty" class="form-control" required>
                <option value="">Seleccionar Especialidad</option>
                @foreach($specialties as $specialty)
                <option value="{{ $specialty->id }}" @if(old('specialty_id')==$specialty->id) selected @endif> {{ $specialty->name}}</option>
                @endforeach
        </select>
    </div>
    <div class="form-group col-md-6">
    <label for="email">Médico</label>
        <select name="doctor_id" id="doctor" class="form-control" required>
          @foreach($doctors as $doctor)
                <option value="{{ $doctor->id }}" @if(old('doctor_id') == $doctor->id) selected @endif> {{ $doctor->name}}</option>
                @endforeach
        </select>
    </div>
  </div>

       <div class="form-group">
        <label for="dni">Fecha</label>
        <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
        </div>
        <input  name= "scheduled_date" class="form-control datepicker" id="date" placeholder="Select date" type="text" value="{{ old('scheduled_date', date('Y-m-d')) }}" data-date-format="yyyy-mm-dd" data-date-start-date="{{ date ('Y-m-d')}}"  data-date-end-date="+30d">
    </div>
       </div>

       <div class="form-group">
        <label for="address">Hora de Atencion</label>
        <div id="hours">
          @if ($intervals)
            @foreach($intervals['morning'] as $key => $interval)
              <div class="custom-control custom-radio mb-3">
                <input name="scheduled_time" value="{{ $interval['start'] }}" class="custom-control-input" id="intervalMorning{{ $key }}" type="radio" required>
                <label class="custom-control-label" for="intervalMorning{{ $key }}">{{ $interval['start'] }} - {{ $interval['end'] }}</label>
              </div>
            @endforeach
            @foreach($intervals['afternoon'] as $interval)
              <div class="custom-control custom-radio mb-3">
                <input type="radio" id="intervalAfternoon{{ $key }}" name="scheduled_time" value="{{ $interval['start'] }}" class="custom-control-input" required>
                <label class="custom-control-label" for="intervalAfternoon{{ $key }}">{{ $interval['start'] }} - {{ $interval['end'] }}</label>
              </div>
            @endforeach  
          @else
          <div class="alert alert-info" role="alert">
          Selecciona un medico y una fecha, para ver sus horas disponibles.
        </div>
          @endif
        </div>
       </div>

       <div class="form-group">
        <label for="type">Tipo de Consulta</label> 
       <div class="custom-control custom-radio mb-3">
       <input type="radio" name="type" class="custom-control-input" id="type1" 
       @if(old('type') == 'Consulta') checked @endif value="Consulta">
       <label class="custom-control-label" for="type1">Consulta</label>
      </div>  

      <div class="custom-control custom-radio mb-3">
        <input type="radio" name="type" class="custom-control-input" id="type2"
        @if(old('type') == 'Examen') checked @endif value="Examen">
       <label class="custom-control-label" for="type2">Examen</label>
      </div>  

       <div class="custom-control custom-radio mb-3">
        <input type="radio" name="type" class="custom-control-input" id="type3"
        @if(old('type') == 'Operacion') checked @endif value="Operacion">
       <label class="custom-control-label" for="type3">Operacion</label>
      </div>  
        </div>
       <button type="submit" class="btn btn-primary">Guardar</button>
     </form>
     </div>
    </div>
@endsection

@section('scripts')
  <script src="{{ asset('/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('/js/appointments/create.js') }}"></script>
@endsection