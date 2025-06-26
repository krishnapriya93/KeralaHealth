@extends('backend.layouts.htmlheader')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb justify-content-center">
        {!! $breadcrumbarr !!}
    </ol>
</nav>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <!-- <div><a class="btn btn-primary btn-sm" id="addarticle">Add BOD</a></div> -->
            @if (Session::get('success') != '')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if (session('delete'))
            <div class="alert alert-warning" role="alert">
                {{ session('delete') }}
                <strong>Success!</strong> {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="card">

                <div class="card-header text-white card-header-main">{{ __('List of Board of directors') }}</div>
                <div class="row">
                    <div class="col-sm-9"></div>
                    <div class="col-sm-3 mt-3"><a href="{{route('siteadmin.CreateBOD')}}" id="addlogobtn" class="btn btn-flat btn-point btn-sm btn-success"><i class="fas fa-plus"></i>&nbsp;Add New Record</a></div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-12 py-3">
                            <div class="table-reponsive">
                                <table id="datatable_view" class="table  table-striped h6" style="width:100%">
                                    <thead>
                                        <tr class="tablehead py-1 ">
                                            <th class="tabsm">No</th>
                                            <th class="tabsm">Title</th>
                                            <th class="tabsm">Designation</th>
                                            <th class="tabsm" width="280px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $result)
                                       
                                        <tr class="table-sm">
                                            <td class="tabsm">{{ $loop->iteration }}</td>
                                            <td class="tabsm">
                                                @foreach ($result->bodsub as $dt)
                                                {{ $dt->name }}
                                                <br>
                                                @endforeach
                                            </td>
                                            <td class="tabsm">
                                                @foreach ($result->designation as $designations)
                                                {{$designations->des_sub[0]->title}}
                                                <br>
                                                @endforeach
                                            </td>
                                            <td class="tabsm">
                                                <a class="btn btn-primary btn-sm"
                                                    href="{{ route('siteadmin.editBOD', \Crypt::encryptString($result->id)) }}">Edit</a>
                                                <a class="btn btn-danger btn-sm"
                                                 href="{{ route('siteadmin.deleteBOD', \Crypt::encryptString($result->id)) }}">Delete</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!--card2 -->
        </div><!-- .col-12 -->
    </div><!-- .row -->
</div><!-- .container -->
@endsection
@section('page_scripts')
<script>
    $(document).ready(function() {
        $(".selecttag").select2({
            width: '100%',
            tags: true,
        });
        if ($('#Errval').val() != 1) {
            $("#entry_div").hide();

        }
        if ($('#EditF').val() == 'E') {
            $("#entry_div").show();
            $("#datatable_div").hide();


        } else {
            if ($('#Errval').val() != 1 && $('#EditF').val() != 'E') {
                $("#entry_div").hide();
            }
        }
        // validation in LAng.
        $('#language').on('keyup', function(e) {
            var testres = engtitle('#language', this.value);
            if (!testres) {
                $('.titleerr').text("Not Allowed ");

                $('.titleerr').show();

            } else {
                $('.titleerr').hide();
            }
        });
        $('#addarticle').on('click', function(e) {
            if ($('#entry_div').css('display') == 'none') {
                $('#entry_div').show();
            } else {
                $('#entry_div').hide();
            }


        });
        // validation in class icon
        $('#icon_class').on('keyup', function(e) {
            var testres = iconclasscheck('#icon_class', this.value);
            if (!testres) {
                $('.iconerr').text("Not Allowed ");

                $('.iconerr').show();

            } else {
                $('.iconerr').hide();
            }
        });


        //append lang
        /* $(".radioval").click(function () {

          var val=$(this).attr('value');
          var check =  $(this).prop('checked');

          if(check)
          {

              if($(this).attr('value') != '') {
                  $('.div_lan1').show();
                  $('.div_lan2').show();
                  $('#div'+val).show();
                  $('#div_alt'+val).show()
                  $('#div_poster'+val).show();
                  $('#div_sub'+val).show();
                  $('#div_content'+val).show();
             }

             else {

                  $('#div'+val).hide();
                  $('#div_poster'+val).hide();
                  $('#div_sub'+val).hide();
                  $('#div_content'+val).hide();
                  $('#div_alt'+val).hide();
             }

          }else{

               $('#div'+val).hide();
               $('#div_sub'+val).hide();
               $('#div_poster'+val).hide();
               $('.div_lan1').hide();
               $('.div_lan2').hide();
               $('#div_alt').hide()
               $('#div_content').hide()
               $("#sel_lang"+val).prop('checked', false);
          }


         });*/
        $(".alert").fadeTo(2000, 2000).slideUp(2000, function() {
            $(".alert").slideUp(2000);
        });

        $('.alert').alert();
    });
</script>
@endsection