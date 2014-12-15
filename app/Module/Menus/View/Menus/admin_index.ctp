<div class="menu-admin-index">
	<table id="example" class="table table-striped table-bordered"
		cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>Menu Name</th>
				<th>Editable</th>
				<th style="width: 120px">Action</th>
			</tr>
		</thead>

		<tfoot>
			<tr>
				<th>Menu Name</th>
				<th>Editable</th>
				<th style="width: 120px">Action</th>
			</tr>
		</tfoot>
	</table>
</div>

<script type="text/javascript">
$(document).ready(function() {

    $('#example').dataTable( {
        processing: true,
        serverSide: true,
        ajax: {
            url: '/admin/menus/menus/index',
            type: 'post',
            data: function ( data ) {
                data.actions = [
                	{ 	data: 'name', 
                    	target: '/admin/menus/menuitems/index/:id'
                    },
                    { 	data: 'action', 
                    	target: {
                        	edit: '/admin/menus/menus/edit/:id', 
                            delete: '/admin/menus/menus/delete/:id'
                        },
                    	htmlClass: {
							edit: 'fa fa-pencil',
							delete: 'fa fa-trash-o',
                    	}
                    }
                ];
            }
        },
        columns: [
            { 	data: 'name', 
                name: 'name' , 
            },
            { 	data: 'editable', 
                name: 'editable' 
            },
            { 	data: 'action', 
                name: 'action', 
                searchable : false, 
                orderable : false, 
            },
        ]
    });
	
});
</script>