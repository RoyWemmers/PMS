@extends('layouts.app')

@section('content')
    <div id="create-project" class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <form class="form" action="" method="POST">
                        @csrf
                        <div class="card-header">
                            Project:
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-lg-3" for="projectname">Project Name: </label>
                                <div class="col-lg-9">
                                    <input class="form-control" type="text" id="projectname" name="projectname" placeholder="Enter Name..">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3" for="customer-select">Customer: </label>
                                <div class="col-lg-9">
                                    <select name="customerid" id="customer-select" class="form-control">
                                        @if(isset($customers[0]))
                                            @foreach($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->companyname }}</option>
                                            @endforeach
                                        @else
                                            <option disabled value="">No Customers Available</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3" for="budget">Budget</label>
                                <div class="input-group col-lg-9">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">€</div>
                                    </div>
                                    <input class="form-control" name="budget" id="budget" type="number" placeholder="Enter Budget.." step="0.01">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-lg-3" for="comments">Description</label>
                                <div class="col-lg-9">
                                    <textarea name="comments" id="comments" class="form-control" cols="30" rows="10" placeholder="Enter project description.."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-success">Create Project</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer')

@endsection
