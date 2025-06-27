@extends('backend.layouts.htmlheader')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb justify-content-center">
        {!!$breadcrumbarr!!}
    </ol>
</nav>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 pb-5">
            <div class="row">
                <div class="col-sm-9"></div>
                <div class="col-sm-3 mt-3"><a href="{{route('createarticle')}}" id="addlogobtn" class="btn btn-flat btn-point btn-sm btn-success"><i class="fas fa-plus"></i>&nbsp;Add New Record</a></div>
            </div>

            <div class="card" id="datatable_div">
                <div class="card-header text-white card-header-main">{{ __('List of Article') }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 py-3">
                            <div class="table-reponsive">
                                <table id="datatable_view" class="table  table-striped h6">
                                    <thead>
                                        <tr class="tablehead py-1 ">
                                            <th class="tabsm">No</th>
                                            <th class="tabsm">Type</th>
                                            <th class="tabsm">Title</th>
                                            <th class="tabsm">Subtitle</th>
                                            <th class="tabsm">Status</th>
                                            <th class="tabsm" width="280px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $resultArticle)
                                        @php
                                        $officeIdInArticle = $resultArticle->officeId;
                                        @endphp
                                        <tr class="table-sm">
                                            <td class="tabsm">{{ $loop->iteration }}</td>

                                            <td class="tabsm">
                                                {{ $resultArticle->articletypeval->articletype_sub[0]->title }}
                                            </td>

                                            <td class="tabsm">
                                                @foreach($resultArticle->articleval_sub as $dt)
                                                {{ $dt->title }}<br>
                                                @endforeach
                                            </td>

                                            <td class="tabsm">
                                                @foreach($resultArticle->articleval_sub as $dt1)
                                                {{ strip_tags($dt1->subtitle) }}<br>
                                                @endforeach
                                            </td>

                                            <td class="tabsm">
                                                @if ($resultArticle->status_id == 1)
                                                <a href="{{ route('siteadmin.statusarticle', \Crypt::encryptString($resultArticle->id)) }}"
                                                    class="main-btn info-btn rounded-full btn-hover btn-sm-default">
                                                    Active
                                                </a>
                                                @else
                                                <a href="{{ route('siteadmin.statusarticle', \Crypt::encryptString($resultArticle->id)) }}"
                                                    class="main-btn deactive-btn rounded-full btn-hover btn-sm-default">
                                                    Deactive
                                                </a>
                                                @endif
                                            </td>

                                            <td class="tabsm">
                                                <a href="{{ route('editarticle', \Crypt::encryptString($resultArticle->id)) }}"
                                                    class="btn btn-primary btn-sm">
                                                    Edit
                                                </a>

                                                <a href="{{ route('deletearticle', \Crypt::encryptString($resultArticle->id)) }}"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this item?');">
                                                    Delete
                                                </a>

                                                <!-- Button trigger modal -->
                                                <button type="button"
                                                    class="btn btn-warning mt-2 px-2 open-submenu-modal"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal"
                                                    data-article-id="{{ $resultArticle->id }}"
                                                    data-office-id="{{ $officeIdInArticle }}"
                                                    data-id="{{ $resultArticle->id }}">
                                                    Update sub menu
                                                </button>
                                                @if($resultArticle->submenu)
                                                    <i class="fas fa-check-circle text-success" title="Has submenu"></i>
                                                @else
                                                    <i class="fas fa-times-circle text-danger" title="No submenu"></i>
                                                @endif

                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div><!--reponsive -->
                        </div><!--col-12 -->
                    </div><!--row -->
                </div><!--card body -->
            </div> <!--card header -->
        </div><!-- card -->
    </div><!-- .row -->
</div><!-- .container -->
<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('siteadmin.updateSubmenus') }}" method="POST" id="submenuForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Submenus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="submenuList">
                        <!-- Example checkboxes (replace dynamically with JS or server-side data) -->
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="submenus[]" value="1" id="submenu1">
                            <label class="form-check-label" for="submenu1">Submenu 1</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="submenus[]" value="2" id="submenu2">
                            <label class="form-check-label" for="submenu2">Submenu 2</label>
                        </div>
                    </div>
                    <input type="hidden" name="office_id" id="modalOfficeId" />
                    <input type="hidden" name="article_id" id="modalarticleId" />
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection
@section('page_scripts')
<script>
    $(document).ready(function() {

        var sbu_view_edit = $('#sbu_view_edit').val();

        if (sbu_view_edit == 2) {
            $(".usertype_div").show();
        }


        $(".selecttag").select2({
            width: '100%',
            tags: true,
        });

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
        var edit = $('#edit_f').val();
        $('.postererr1').hide();
        $('.postererr2').hide();

        if (edit == 'E') {
            var hidden_id = $('.radioval').val();
            $('#datatable_div').hide();
            var value = '#preview-image-before-upload' + hidden_id;
            // alert(value);
            $('.preview_poster').show();
            let reader = new FileReader();

            reader.onload = (e) => {

                $(value).attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
            // $(".poster")[0].reset();
            $('.preview_poster').show();
        } else {

            $('.preview_poster').hide();
        }
        //poster view
        $('.poster').change(function() {

            var i = $(this).attr('rel');

            var value = '#preview-image-before-upload' + i;
            //    alert(value);
            $('.preview_poster').show();
            let reader = new FileReader();

            reader.onload = (e) => {

                $(value).attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
            // $(".poster")[0].reset();
        });
        //Restricted
        $("#restricted").click(function() {
            $(".usertype_div").show();
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
        $(".alert").fadeTo(5000, 5000).slideUp(5000, function() {
            $(".alert").slideUp(10000);
        });

        $('.alert').alert();
    });

    // Open modal on button click
    $('.open-submenu-modal').on('click', function() {
        var officeId = $(this).data('office-id');
       
        var articleId = $(this).data('article-id');
        var article_Id = $(this).data('id');
        $('#modalOfficeId').val(officeId); // Store in hidden field if needed
        $('#modalarticleId').val(article_Id);
        // Show modal
        $('#exampleModal').modal('show');

        // Load submenu list via AJAX
        $.ajax({
            url: '{{ route("siteadmin.getsubmenus") }}',
            type: 'GET',
            data: {
                office_id: officeId,
                articleId: articleId
            },
            success: function(response) {
                $('#submenuList').html(response);
            },
            error: function() {
                $('#submenuList').html('<p class="text-danger">Failed to load submenus.</p>');
            }
        });
    });

    $('#submenuForm').on('submit', function(e) {
        e.preventDefault(); // prevent default form submission

        let form = $(this);
        let url = "{{ route('siteadmin.updateSubmenus') }}"; // Laravel route
        let formData = form.serialize();

        $.ajax({
            url: url,
            method: 'POST',
            data: formData,
            success: function(response) {
                alert('Submenus updated successfully!');
                $('#exampleModal').modal('hide');
                   // Load submenu section again via AJAX
                $('#submenuList').load(location.href + ' #submenuList > *');
                // Optionally refresh part of your page or update the UI
            },
            error: function(xhr) {
                let errors = xhr.responseJSON?.errors;
                if (errors) {
                    alert(Object.values(errors).join("\n"));
                } else {
                    alert('Something went wrong.');
                }
            }
        });
    });
</script>
@endsection