@extends('layouts.app')

@section('content')

<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
<div class="container">
    
            <form action="{{url('st_store')}}"  method="post">
                @csrf
            <fieldset>
                <legend>{{ $title }}</legend>
                <div class="mb-3">
                <label for="disabledTextInput" class="form-label">Student name</label>
                <input type="text" name="name" id="name" value="@if($students){{$students->name}}@endif"  class="form-control" placeholder="Student Name">
                </div>

                <div class="mb-3">
                <label for="disabledTextInput" class="form-label">Father Name</label>
                <input type="text" name="fathername" value="@if($students){{$students->fathername}}@endif" id="fathername" class="form-control" placeholder="Father Name">
                </div>
                <div class="mb-3">
                <label for="disabledTextInput" class="form-label">Mother Name</label>
                <input type="text" name="mothername" value="@if($students){{$students->mothername}}@endif" id="mothername" class="form-control" placeholder="Mother Name">
                </div>

                <div class="mb-3">
                <label for="disabledSelect" class="form-label">Old Class</label>
                <select id="oldclass" name="oldclass" value="@if($students){{$students->oldclass}}@endif" class="form-select">
                    <option>9th</option>
                    <option>10th</option>
                    <option>11th</option>
                    <option>12th</option>
                </select>

                <div class="mb-3">
                <label for="disabledTextInput" class="form-label">city</label>
                <input type="text" name="city" value="@if($students){{$students->city}}@endif" id="city" class="form-control" placeholder="city">
                </div>

              
               
                <button type="submit" class="btn btn-primary">Submit</button>
            </fieldset>
            </form>

</div>
</div>
@endsection



