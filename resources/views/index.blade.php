@extends("skeleton.main")

@section("content")
<section>
  <div class="container py-5">
    <div class="row">
      <div class="col-12">
        <h1 class="text-center">XParser v.0.0.1</h1>
      </div>
    </div>
  </div>
</section>

<section>
  <div class="container ">
    <div class="row">
      <div class="col-12">
        <form class="mx-auto" style="max-width:500px">
          <div class="form-group">
            <label for="link">Link to Page</label>
            <input type="text" class="form-control" id="link" aria-describedby="link" placeholder="Enter link" value="http://dkpridonskoy.ru/ковчег-2/">
          </div>

          <div class="form-group">
            <label for="link">XPath</label>
            <input type="text" class="form-control" id="xpath" aria-describedby="xpath" placeholder="Enter XPath" value="//h2">
          </div>

          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#parser-modal">
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
