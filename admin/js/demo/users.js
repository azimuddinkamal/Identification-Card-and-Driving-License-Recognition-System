// Call the dataTables jQuery plugin
$(document).ready(function () {
    $('#recordForm')[0].reset();
	$('#userTable').DataTable({
    "ajax": {
        url: "..//..//..//ajax//ajax.php",
        type: "POST",   // you can probably remove this
        datatype: 'json',   // you can probably remove this
		data: { 'ajaxcall': 'usertable' },
	},
    columns: [
        { 'data': 'id' },
		{ 'data': 'user_type' },
		{ 'data': 'username' },
		{ 'data': 'date_created' },
		{ 'data': 'time_created' },
		{ 'data': 'update' },
		]
	});

    //Display Add User Modal
	$('#adduserrecord').click(function(){
		$('#recordForm')[0].reset();
		$('#recordModal').modal('show');
		$('#datecreated').removeAttr('required');
		$('#timecreated').removeAttr('required');
		$('#datecreated').attr('hidden','');
		$('#timecreated').attr('hidden','');
		$('#datelabel').attr('hidden','');
		$('#timelabel').attr('hidden','');
		$('#passlabel').removeAttr('hidden');
		$('#pass').removeAttr('hidden');
		$('#confirmpasslabel').removeAttr('hidden');
		$('#confirmpass').removeAttr('hidden');
		$('#pass').attr('required','');
		$('#confirmpass').attr('required','');	
		$('.modal-title').html("Add Record");
		$('#action').val('addUserRecord');
		$('#save').val('Add');
	});
	
	
	// Update/Edit Table
	$("#userTable").on('click', '.update', function(){
		var id = $(this).attr("id");
		var ajaxcall = 'getusertable';
	
		$.ajax({
			url:"..//..//..//ajax//ajax.php",
			method:"POST",
			data:{ajaxcall:ajaxcall, id:id},
			dataType:"json",
			async:false,
			success:function(record){
				//alert(JSON.stringify(record[0].id));
				
				$('#recordModal').modal('show');
				$('#id').val(record[0].id);
				$('#username').val(record[0].username);
				$('#datecreated').val(record[0].date_created);
				$('#timecreated').val(record[0].time_created);				
				$('.modal-title').html("Edit Records");
				$('#action').val('updateUserRecord');
				$('#save').val('Save');
			}
		})
	
	});

	//Submit
	$("#recordModal").on('submit','#recordForm', function(event){
		event.preventDefault();
		$('#save').attr('disabled','disabled');
		var formData = $(this).serialize();
		$.ajax({
			url:"..//..//..//ajax//ajax.php",
			method:"POST",
			data:formData,
			success:function(data){	
				alert(data);			
				$('#recordForm')[0].reset();
				$('#recordModal').modal('hide');				
				$('#save').attr('disabled', false);
				location.reload();
			},error:function(){
				alert("error");
			}
		})
	});	
	
	//Delete record
	$("#userTable").on('click', '.delete', function(){
		var id = $(this).attr("id");		
		var ajaxcall = "deleteUserRecord";
		if(confirm("Are you sure you want to delete this record?")) {
			$.ajax({
				url:"..//..//..//ajax//ajax.php",
				method:"POST",
				data:{id:id, ajaxcall:ajaxcall},
				success:function(data) {					
					location.reload();
				}
			})
		}else{
		
			return false;
		}
	});
	
	//Export record
	function downloadCSV(csv, filename) {
		var csvFile;
		var downloadLink;

		// CSV file
		csvFile = new Blob([csv], {type: "text/csv"});

		// Download link
		downloadLink = document.createElement("a");

		// File name
		downloadLink.download = filename;

		// Create a link to the file
		downloadLink.href = window.URL.createObjectURL(csvFile);

		// Hide download link
		downloadLink.style.display = "none";

		// Add the link to DOM
		document.body.appendChild(downloadLink);

		// Click download link
		downloadLink.click();
	}

	function exportTableToCSV(filename) {
		var csv = [];
		//var rows = document.querySelectorAll("table tr");
		var rows = document.querySelectorAll("table tr");

		for (var i = 0; i < rows.length; i++) {
			var row = [], cols = rows[i].querySelectorAll("td, th");

			for (var j = 0; j < (cols.length-1); j++) 
				row.push(cols[j].innerText);

			csv.push(row.join(","));        
		}

		// Download CSV file
		downloadCSV(csv.join("\n"), filename);
	}
	
	$("#export").click(function(){ 
		var CSV = exportTableToCSV('User List.csv');
		window.navigator.msSaveBlob(CSV, 'User List.csv'); 
		
		});

});

/*

$.ajax({
        url: "http://localhost/fyp/statistic/ajax.php",
        type: "post",
        data: { 'ajaxcall': 'usertable' },
        success: function (tabledata) {
        
            $('#dataTable').DataTable({
                data: tabledata,  // Get the data object
                columns: [
                    { data: 'id' },
                    { data: 'user_type' },
                    { data: 'username' },
                    { data: 'date_created' },
                    { data: 'time_created' },
                ]
            });
        }
    });

*/