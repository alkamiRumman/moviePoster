<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><b>Title List</b></h3>
				<a href="<?= titles_url('add') ?>" class="btn btn-primary pull-right">Add New Title</a>
			</div>
			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-striped table-bordered serverSide-table dtr-inline"
						   style="width: 100% !important;">
						<thead>
						<tr>
							<th>Poster</th>
							<th>Title</th>
							<th>Year</th>
							<th>Genre</th>
							<th>Director(s)</th>
							<th>Actors</th>
							<th>Country</th>
							<th>Writer(s)</th>
							<th>Rated</th>
							<th>Released Date</th>
							<th>Runtime</th>
							<th>Language</th>
							<th>Type</th>
							<th>imdb ID</th>
							<th>Awards</th>
							<th>Production</th>
							<th>Plot</th>
							<th>Actions</th>
						</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
	var Table, selectedIDs = [];
	window.onload = function () {
		geTableData();
	};

	function geTableData() {
		Table = $('.serverSide-table').DataTable({
			order: [[1, "ASC"]],
			// stateSave: true,
			"columnDefs": [
				{
					"render": function (data, type, row) {
						console.log(row.id);
						if (data != 'N/A') {
							return '<img src="' + data + '" width="90" class="thumbnail" style="margin: 0 auto" id="poster"' +
									'onclick="loadPopup(\'<?= titles_url("view/") ?>'+ row.id+'\')">';
						}else {
							return '<img src="<?= base_url('images/noImage.png') ?>" width="90" class="thumbnail" style="margin: 0 auto" id="poster"' +
									'onclick="loadPopup(\'<?= titles_url("view/") ?>'+ row.id+'\')">';
						}
					},
					"targets": 0
				},
				{
					"targets": [2, 6, 7, 8, 9, 10, 11, 11, 12, 13, 14, 15, 16],
					"visible": false
				},
				{
					"render": function (data, type, row) {
						// console.log(data);
						return JSON.parse(data);
					},
					"targets": 3
				}
			],
			'aoColumns': [{mData: "poster"}, {mData: "title"}, {mData: "ReleaseYear"}, {mData: "genre"}, {mData: "director"},
				{mData: "actors"}, {mData: "country"}, {mData: "writer"}, {mData: "rated"}, {mData: "released"}
				, {mData: "runtime"}, {mData: "language"}, {mData: "type"}, {mData: "imdbID"}, {mData: "awards"}
				, {mData: "production"}, {mData: "plot"}, {mData: "actions", bSortable: false}],
			"aLengthMenu": [[25, 50, 100, 200, 500, 1000, -1], [25, 50, 100, 200, 500, 1000, "all"]],
			"iDisplayLength": 25,
			'bProcessing': true,
			"language": {
				processing: '<div><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading Please Wait...</span></div>'
			},
			'bServerSide': true,
			'sAjaxSource': '<?= titles_url('getTitles' ) ?>',
			'fnServerData': function (sSource, aoData, fnCallback) {
				$.ajax({
					'dataType': 'json',
					'type': 'POST',
					'url': sSource,
					'data': aoData,
					'success': function (d, e, f) {
						//console.log(f);
						fnCallback(d, e, f);
					},
					error: function (jqXHR, textStatus, errorThrown) {
						console.log(jqXHR);
						if (jqXHR.jqXHRstatusText)
							alert(jqXHR.jqXHRstatusText);
					}
				});
			},
			"fnFooterCallback": function (nRow, aaData, iStart, iEnd, aiDisplay) {
				// console.log(nRow);
			},
			select: {
				style: 'multi',
				selector: 'td:first-child'
			},
			dom: '<"top"B<"pull-right"l>>irtp',
			//dom: 'Blfrtip',
			buttons: [
				'copy', 'csv', 'excel', {
					extend: 'colvis',
					text: 'Column Visibility',
					collectionLayout: 'two-column'
				}
			]
		});
		yadcf.init(Table, [
			{column_number: 1, filter_default_label: "Type...", filter_type: "text"},
			{column_number: 2, filter_default_label: "Type..", filter_type: "text"},
			{column_number: 3, filter_default_label: "Type...", filter_type: "text"},
			{column_number: 4, filter_default_label: "Type...", filter_type: "text"},
			{column_number: 5, filter_default_label: "Type...", filter_type: "text"},
			{column_number: 6, filter_default_label: "Type...", filter_type: "text"},
			{column_number: 7, filter_default_label: "Type...", filter_type: "text"},
			{column_number: 8, filter_default_label: "Type...", filter_type: "text"},
			{column_number: 9, filter_default_label: "Type...", filter_type: "text"},
			{column_number: 10, filter_default_label: "Type...", filter_type: "text"},
			{column_number: 11, filter_default_label: "Type...", filter_type: "text"},
			{column_number: 12, filter_default_label: "Type...", filter_type: "text"},
			{column_number: 13, filter_default_label: "Type...", filter_type: "text"},
			{column_number: 14, filter_default_label: "Type...", filter_type: "text"},
			{column_number: 15, filter_default_label: "Type...", filter_type: "text"}
		], "header");
	}

</script>
