@extends('backend.layouts.htmlheader')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb justify-content-center">
        {!!$breadcrumbarr!!}
    </ol>
</nav>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
                @if(Session::get('success')!='')
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong>   {{Session::get('success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
                @if(session('delete'))
                    <div class="alert alert-warning" role="alert">
                       {{ session('delete') }}
                       <strong>Success!</strong>   {{Session::get('success')}}
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            <div class="card">
                <div class="card-header text-white card-header-main">{{ __('List of Office') }}</div>

                <div class="row"><div class="col-sm-9"></div><div class="col-sm-3 mt-3"><a href="{{route('masteradmin.createoffice')}}" id="addlogobtn" class="btn btn-flat btn-point btn-sm btn-success"><i class="fas fa-plus"></i>&nbsp;Add New Record</a></div> </div>


                <div class="card-body">
                    <table id="datatable_view" class="table table-striped drag_tab1">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Order No</th>
                        <th width="280px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                    $i=0;
                    @endphp
                    @foreach ($datas as $key => $result)
                    <tr>
        
                        <td name="{{$result->office_sub[0]->title ?? ''}}" id="{{\Crypt::encryptString($result->id)}}" class="SNum1 sortnum_{{$i}} officer_id-{{\Crypt::encryptString($result->id)}}">{{ $loop->iteration }}</td>
                        <td>{{$result->office_sub[0]->title ?? ''}}</td>
                        <td>{{$result->orderno ?? ''}}</td>
                        <td>
                            <a class="btn btn-primary btn-sm-default" href="{{ route('masteradmin.editoffice',\Crypt::encryptString($result->id)) }}">Edit</a>
                            <a class="btn btn-danger btn-sm-default" href="{{ route('masteradmin.deleteoffice',\Crypt::encryptString($result->id)) }}">Delete</a>
                        </td>
                    </tr>
                     <!-- $i++; -->
                    @endforeach
                    </tbody>
                    </table>

                </div>
            </div> <!--card2 -->

        </div>
    </div>
</div>
@endsection

@section('page_scripts')
<script>
     $( document ).ready(function() {
    $(".alert").fadeTo(2000, 500).slideUp(500, function() {
      $(".alert").slideUp(500);
    });

    $('.alert').alert();
    $(".drag_tab1").sortable({
         handle: function(e) {
      console.log('Handled');
    },
    items: 'tr:not(:first)',
    connectWith: 'div.bin',
    helper: 'clone',
    start: function (e, ui) {
       $(this).addClass('draggigtr1');
    },
    stop: function (e, ui) {
        $(this).removeClass('draggigtr1');
        var rowCount1 = $('#datatable_view tr').length;
        var num1 =$('.SNum1').text();
        var digits1 = num1.toString().split('');
        var realDigits1 = digits1.map(Number);
        var movement1 = ui.position.top - ui.originalPosition.top > 0 ? "down" : "up";
        console.log("Stopped"+movement1+realDigits1+' '+rowCount1);
        realDigits1.sort(function(a, b) {
            return a - b;
        });
        var k=0;
        var officer_id1=0;
        var names1='';

        var action_url1='';

        var usertype1=$("#usertype_id").val();
        
        var action_url1 = "/masteradmin/Orderchangeofficelist_form";

        $('.SNum1').each(function () {
            officer_id1=$(this).attr('id');
            names1=$(this).attr('name');
            k++;
            $.ajax({
                url: action_url1,
                type: 'get',
                data: {
                    'id': officer_id1,
                    'val':k,
                    'names':names1
                },
                dataType: 'json',
                success: function(result1) {
                     /*alert(result1);*/
                            window.location.reload();



                }
            });

            $(this).text(k);
            console.log(officer_id1+' id');
        });


    }
});
});
</script>
@endsection