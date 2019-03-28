@extends("skeleton.main")

@section("content")
<section>
  <div class="container py-5">
    <div class="row">
      <div class="col-12">
        <h1 class="text-center">XParser v.0.0.2</h1>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="container ">
    <div class="row">
      <div class="col-12">
        <form class="mx-auto" style="max-width:500px" method="POST" action="{{route("parser")}}" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="exampleFormControlFile1">Links file (*.txt, one line - one link)</label>
            <input type="file" class="form-control-file" name="links" id="exampleFormControlFile1">
          </div>
          <div class="form-group">
            <label for="link">Email</label>
            <input type="text" class="form-control email" name="email" aria-describedby="email" placeholder="Enter your email" value="">
          </div>
          <div class="prop_wrapper">
            <div class="row prop_line">
              <div class="form-group col-xs-12 col-md-6">
                <label for="link">Prop name</label>
                <input type="text" class="form-control xpath_name" name="xpath[0][name]" aria-describedby="xpath" placeholder="Enter XPath" value="Title">
              </div>
              <div class="form-group col-xs-12 col-md-5">
                <label for="link">Prop XPath</label>
                <input type="text" class="form-control xpath_val" name="xpath[0][value]" aria-describedby="xpath" placeholder="Enter XPath" value="//h2">
              </div>
              <div class="form-group col-xs-12 col-md-1">
                <div class="">
                  <label for="link">&nbsp;</label>
                  <button type="button" class="btn btn-primary plus">+</button>
                </div>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-primary" >
            get DATA
          </button>
        </form>
      </div>
    </div>
  </div>
</section>

<section class="modals ">
  <!-- Modal -->
<div class="modal fade" id="parser-modal" tabindex="-1" role="dialog" aria-labelledby="parser-modal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
</section>
@endsection

@section("bottom")
@parent
<script type="text/javascript">
  $(".plus").click(function(e){
    var add = $(this).closest(".prop_line").clone();

    //xpath[0][value]
    $(add).find(".xpath_val").prop("name","xpath["+$(".prop_line").length+"][value]");
    $(add).find(".xpath_name").prop("name","xpath["+$(".prop_line").length+"][name]");

    $(this).closest(".prop_line").parent().append(add);
  });
  $(document).ready(function(){
    $("#parser-modal" ).on('show.bs.modal', function(){
        $.post( "{{ route("parser") }}", { link: $("#link").val(), xpath: $("#xpath").val(),_token:$("meta[name=_token]").prop("content") } )
        .done(function(data){
          $("#parser-modal .modal-body" ).html(data);
        });
    });
  })
</script>
@endsection
