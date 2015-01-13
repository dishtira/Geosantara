@extends('template/BaseTemplate')

@section('content')
<div class="col-md-12">
	<div class="table-responsive" style="overflow-x:none;">
	    @if($clues == null || $clues->count() <=0 )
	    <div class="form-group">
	        <label>There is no clue yet</label>
	    </div>
	    @else
	    <table class="table table-striped table-bordered table-hover" id="dataTableClues">
	        <thead>
	            <tr>  
	                <th>Clue ID</th>
	                <th>Clue</th>
	                <th>Answer</th>
	                <th>Action</th>
	            </tr>
	        </thead>
	        <tbody>
	        <?php
	            foreach ($clues as $clue)
	            {
	        ?>
	            <tr class="odd gradeX">
	                <td> <?= $clue->ClueID ?></td>
	                <td> <?= $clue->Clue ?> </td>
	                <td> <?= $clue->Answer ?> </td>
	                <td>
	                    <a href="{{ URL::to('admin/editClue/'.$clue->ClueID) }}"><button class="btn btn-primary"><i class="fa fa-edit"></i> Edit</button></a>
	                    <a href="{{ URL::to('admin/deleteClue/'.$clue->ClueID) }}"> <button class="btn btn-danger"><i class="fa fa-eraser"></i> Delete</button></a>
	                </td>
	            </tr>
	        <?php

	            }
	        ?>                                           
	        </tbody>
	    </table>
	    @endif
	    <a href=" {{ URL::route('addClue') }} "><button type="submit" class="btn btn-success"><i class="fa fa-plus-square"></i> Add Clue</button></a>
	</div>
</div>
@stop

@section('javascript')
<script type="text/javascript">
$(document).ready(function () {
	$('#dataTableClues').dataTable();
});
</script>
@stop