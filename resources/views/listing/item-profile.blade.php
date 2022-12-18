{{-- @extends('layouts.app')
@section('content') --}}

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">   
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<style>
.form-section{
display: none;
}

.form-section.current{
display: inline;
}
.parsley-errors-list{
color:red;
}

</style>

<div class="container">
    <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">

                    <div class="nav nav-fill my-3">
                        <label class="nav-link shadow-sm mb-3 step0    border ml-2 ">Step One</label>
                        <label class="nav-link shadow-sm mb-3 step1   border ml-2 " >Step Two</label>
                        <label class="nav-link shadow-sm mb-3 step2   border ml-2 " >Step Three</label>
                      </div>

                    <form method="POST" action='/post' class="index">
                        @csrf
                        <div class="form-section">
                            <div class="row">
                                <div class="col-sm mb-3">
                                        <label>Transaction Number</label>
                                        <input type="text" class="form-control" name="transaction_number">                                          
                                </div>
                                <div class="col-sm mb-3">
                                        <label>Purchase Date</label>
                                        <input type="text" class="form-control"
                                            name="purchase_date">                        
                                </div>
                                
                                <div class="col-sm mb-3">
                                        <label>Purchase Price</label>
                                        <input type="text" class="form-control"
                                            name="purchase_price">                                     
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm mb-3">

                                        <label>Inventory Number</label>
                                        <input type="text" class="form-control"
                                            name="inventory_number">                                       
                                </div>

                                <div class="col-sm mb-3">

                                        <label>Type</label>
                                        <input type="text" class="form-control"
                                            name="type">                                        
                                </div>
                                <div class="col-sm mb-3">

                                        <label> Salvage Value</label>
                                        <input type="text" class="form-control"
                                            name="salvage_value">              
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm mb-3">

                                        <label>Serial Number</label>
                                        <input type="text" class="form-control"
                                            name="serial_number">
                                </div>
                                <div class="col-sm mb-3">

                                    <label>Classification</label>
                                        <input type="text" class="form-control"
                                            name="classification">
                                </div>
                                <div class="col-sm mb-3">

                                        <label>Lifespan</label>
                                        <input type="text" class="form-control"
                                            name="lifespan">                                       
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm mb-3">

                                        <label>Department</label>
                                        <input type="text" class="form-control"
                                            name="department">

                                    
                                </div>
                                <div class="col-sm mb-3">

                                        <label>Quantity</label>
                                        <input type="text" class="form-control"
                                            name="quantity">

                                   
                                </div>
                                <div class="col-sm mb-3">

                                    <label>Annual Operating
                                            Cost</label>
                                        <input type="text" class="form-control"
                                            name="annual_operating_cost">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm mb-3">

                                        <label>Year</label>
                                        <input type="text" class="form-control"
                                            name="year">

                                    
                                </div>
                                <div class="col-sm mb-3">
                                        <label>Replacement Value</label>
                                        <input type="text" class="form-control"
                                            name="replacement_value">               
                                </div>
                                <div class="col-sm mb-3">
                                    
                                        <label>Inventoried By</label>
                                        <input type="text" class="form-control"
                                            placeholder="name">

                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm mb-3">
                                        <label>Title</label>
                                        <input type="text" class="form-control"
                                            name="title">

                                  
                                </div>
                                <div class="col-sm mb-3">
                                        <label>Trade in Value</label>
                                        <input type="text" class="form-control"
                                            name="trade_in_value">
                                   
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm mb-3">
                                        <label>Body</label>
                                        <input type="text" class="form-control"
                                            name="body">
                                   
                                </div>
                                <div class="col-sm mb-3">
                                        <label>Present Value</label>
                                        <input type="text" class="form-control"
                                            name="present_value">
                                    
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-10 mb-3">
                                        <label for="exampleFormControlTextarea1">Comments</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="comments"></textarea>
                                    
                                </div>
                            </div>
                            <div class="col-20">
                                    <label for="exampleFormControlTextarea1">Notes</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="notes"></textarea>
                                
                            </div>
                        </div>     
                        {{-- //page 2  --}}
                            <div class="form-section row">
                                    <div class="col-sm mb-3">
                                          <label >Transaction Number</label>
                                          <input type="text" class="form-control" >
                                    </div>
                                    
                                    <div class="col-sm mb-3">
                                          <label>Purchase Date</label>
                                          <input type="text" class="form-control" >

                                            <div class="col-sm mb-3">
                                                <label>Type</label>
                                                <input type="text" class="form-control" >
                                            </div>  
                                            <div class="col-sm mb-3">
                                                <label>Classification</label>
                                                <input type="text" class="form-control" >
                                            </div>  
                                            <div class="col-sm mb-3">
                                                <label>Quantity</label>
                                                <input type="text" class="form-control" >
                                            </div>  
                                            <div class="col-sm mb-3">
                                                <label>Replacement Value</label>
                                                <input type="text" class="form-control" >
                                            </div>  
                                            <div class="col-sm mb-3">
                                                <label>Trade in Value</label>
                                                <input type="text" class="form-control" >
                                            </div>
                                            <div class="col-sm mb-3">
                                                <label>Present Value</label>
                                                <input type="text" class="form-control" >
                                            </div>
                                    <div class="col-sm mb-3">

                                          <label>Purchase Price</label>
                                          <input type="text" class="form-control" >
                                        </div>
                                    </div>
                            </div>                                   
                                  {{-- //page 3  --}}
                            <div class="form-section row">
                                    <div class="col-sm mb-3">
                                          <label>Inventory Number</label>
                                          <input type="text" class="form-control" >
                                    </div>
                                    <div class="col-sm mb-3">
                                          <label>Classifications</label>
                                          <input type="text" class="form-control" >
                                    </div>
                                  <div class="row">
                                    <div class="col-sm mb-3">
                                          <label>Model</label>
                                          <input type="text" class="form-control" >
                                    </div>
                                    <div class="col-sm mb-3">
                                          <label>Type</label>
                                          <input type="text" class="form-control" >
                                    </div>
                                  </div> 
                                <div class="container col-md-6">
                                        <label for="Image" class="form-label">Upload File</label>
                                        <input class="form-control" type="file" id="formFile" onchange="preview()">
                                </div>
                            </div>
                            <div class="form-navigation mt-3">
                                <button type="button" class="previous btn btn-primary float-left">&lt; Previous</button>
                                <button type="button" class="next btn btn-primary float-right">Next &gt;</button>
                                <button type="submit" class="btn btn-success float-right">Submit</button>
                             </div>
                    </form>
                </div>
            </div>
    </div>
</div>

<script>

$(function(){
    var $sections=$('.form-section');

    function navigateTo(index){

        $sections.removeClass('current').eq(index).addClass('current');

        $('.form-navigation .previous').toggle(index>0);
        var atTheEnd = index >= $sections.length - 1;
        $('.form-navigation .next').toggle(!atTheEnd);
        $('.form-navigation [Type=submit]').toggle(atTheEnd);

 
        const step= document.querySelector('.step'+index);
        step.style.backgroundColor="#17a2b8";
        step.style.color="white";



    }

    function curIndex(){

        return $sections.index($sections.filter('.current'));
    }

    $('.form-navigation .previous').click(function(){
        navigateTo(curIndex() - 1);
    });

    $('.form-navigation .next').click(function(){
        $('.index').parsley().whenValidate({
            group:'block-'+curIndex()
        }).done(function(){
            navigateTo(curIndex()+1);
        });

    });

    $sections.each(function(index,section){
        $(section).find(':input').attr('data-parsley-group','block-'+index);
    });


    navigateTo(0);



});


</script>

    
{{-- @endsection --}}
