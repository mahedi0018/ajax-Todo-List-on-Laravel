<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
	<br>
		<div class="container">
			<div class="row">
				<div class="col-lg-offset-3 col-lg-6">
					<div class="panel panel-default">
					  <div class="panel-heading">
					    <h3 class="panel-title">Ajax Todo List  <a href="#" id="addNew" class="pull-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus" aria-hidden="true"></i> </a></h3>
					  </div>
					  <div class="panel-body" id="item_div">
					   <ul class="list-group item-list">

					   @foreach ($items as $item)
					     <li class="list-group-item ourItem" data-toggle="modal" id="list_id" data-target="#myModal">{{$item->item}}<br />
					      <input type="hidden" id="itemId" value="{{$item->id}}"><br /> 
					     </li>
					    @endforeach

					   </ul>
					  </div>
					</div>
				</div>

				<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="title">Add Item</h4>
				      </div>
				      <div class="modal-body">
				        <p><input type="text" placeholder="Write item here" id="addText" class="form-control"></p>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-warning" id="delete" data-dismiss="modal" style="display: none;">Delete</button>
				        <button type="button" class="btn btn-primary" id="saveChanges" style="display: none;"> Save changes
				        </button>
				        <button type="button" class="btn btn-primary" id="addButton" data-dismiss="modal">Add Item</button>
				      </div>
				    </div><!-- /.modal-content -->
				  </div><!-- /.modal-dialog -->
				</div><!-- /.modal -->
			</div>
		</div>
{{csrf_field()}}
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"
	 integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
     crossorigin="anonymous"></script>	

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	<script>
		$(document).ready(function() {
			 $(document).on('click', '.ourItem', function(event) {
					/* Act on the event */
					$('#title').text('Edit Item');
					var text = $(this).text();
					$('#addText').val(text);
					$('#delete').show('400');
					$('#saveChanges').show('400');
					$('#addButton').hide('400');
					var item_id = $(this).find('input').val();
					$('#list_id').val(item_id);

					
				});
			
			$(document).on('click', '#addNew', function(event) {
				$('#title').text('Add New Item');
				$('#addText').val("");
				$('#delete').hide('400');
				$('#saveChanges').hide('400');
				$('#addButton').show('400');	
			});
			$('#addButton').click(function(event) {
			  	var text = $('#addText').val();
			 	$.post('list', {'text': text,'_token':$('input[name=_token]').val()}, function(data) {
			 		console.log(data);
			 		$('#item_div').load(location.href + ' #item_div');
			 		
			 	});
			});
			$('#delete').click(function(event) {
				var id = $('#list_id').val();
				$.post('delete', {'id': id,'_token':$('input[name=_token]').val()}, function(data) {
					$('#item_div').load(location.href + ' #item_div');
					console.log(data);
				});
				
			});
			
		});
		
	</script>
</body>
</html>