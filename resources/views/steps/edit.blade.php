@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Step
        </h1>
        {{--<h1 class="pull-left">
            Step
        </h1>
        <div class="pull-right">
            <!-- Version Field -->
            <div class="btn-group">
                <button type="button" class="btn btn-default">Version</button>
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Version 1</a></li>
                    <li><a href="#">Version 2</a></li>
                    <li><a href="#">Version 3</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Version Default</a></li>
                </ul>
            </div>

            <!-- Language Field -->
            <div class="btn-group">
                <button type="button" class="btn btn-default">Language</button>
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Language 1</a></li>
                    <li><a href="#">Language 2</a></li>
                    <li><a href="#">Language 3</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Language Default</a></li>
                </ul>
            </div>
        </div>
        <div class="clearfix"></div>--}}
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($step, ['route' => ['steps.update', $step->id], 'method' => 'patch']) !!}

                        @include('steps.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection