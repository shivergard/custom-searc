@extends((\Config::get('custom-search.extend_view') ? \Config::get('custom-search.extend_view') : 'custom-search::app'))

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Shivergard\CustomSearch</div>
				<div class="panel-body">
					 <form role="form">
					 	<div class="form-group">
					      <label for="usr">Search:</label>
					      <input type="text" class="autocomplete form-control" id="search" placeholder="Search by specialty, condition, topic, or name" >
					    </div>
					  </form>
				</div>
			</div>
		</div>

		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Results</div>
				<div class="panel-body">
					<div class="row">
					   <div class="col-md-8">
					        <div>Div 1 text</div>
					        <div>Div 2 text</div>
					   </div>
					   <div class="col-md-4">
					        <img src="test.png" class="img-responsive"/>
					   </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.devbridge-autocomplete/1.2.7/jquery.devbridge-autocomplete.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/mustache.js/2.0.0/mustache.min.js"></script>

<script type="text/javascript">
    // Initialize ajax autocomplete:
    $('#search').autocomplete({
        serviceUrl: '{{ action('\Shivergard\CustomSearch\CustomSearchController@listFields') }}',
        minChars: 1,

        onSelect: function(suggestion) {
        	request = {
        		category: suggestion.data.category ,
        		id : suggestion.data.id
        	};   
        	window.ajaxCall(request);        
        },
        showNoSuggestionNotice: false,
        noSuggestionNotice: 'Sorry, no matching results',
        groupBy: 'category'
    });


    window.ajaxCall = function (request){
    	$.ajax({
		  dataType: "json",
		  url: "{{action("\Shivergard\CustomSearch\CustomSearchController@getInstance")}}",
		  data: request,
		  success: window.ajaxSuccess
		});
    };

    window.ajaxSuccess = function(data){
    	Mustache.render("{{title}} spends {{calc}}", view);
    	console.log(data);
    }
</script>
@endsection


@section('styles')
<style type="text/css">
.autocomplete-suggestions { border: 1px solid #999; background: #FFF; overflow: auto; }
.autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
.autocomplete-selected { background: #F0F0F0; }
.autocomplete-suggestions strong { font-weight: normal; color: #3399FF; }
.autocomplete-group { padding: 2px 5px; }
.autocomplete-group strong { display: block; border-bottom: 1px solid #000; }
</style>
@endsection