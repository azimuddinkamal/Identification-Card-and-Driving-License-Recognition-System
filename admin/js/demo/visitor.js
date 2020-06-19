// Call the dataTables jQuery plugin

$(document).ready(function () {

	//Display Visitor Table
	$('#visitorTable').DataTable({
		"ajax": {
			url: "..//..//..//ajax//ajax.php",
			type: "POST",   // you can probably remove this
			datatype: 'json',   // you can probably remove this
			data: { 'ajaxcall': 'visitortable' },
		},
		columns: [
			{ 'data': 'id' },
			{ 'data': 'name' },
			{ 'data': 'id_no' },
			{ 'data': 'pic_name' },
			{ 'data': 'purpose' },
			{ 'data': 'check_in_time' },
			{ 'data': 'check_in_date' },
			{ 'data': 'check_out_time' },
			{ 'data': 'check_out_date' },
			{ 'data': 'update' },
		]
	});

	//Display Visitor Table add Dashboard
	$('#DashvisitorTable').DataTable({
		"searching": false,
		"lengthChange":false,
		"ajax": {
			url: "..//..//..//ajax//ajax.php",
			type: "POST",   // you can probably remove this
			datatype: 'json',   // you can probably remove this
			data: { 'ajaxcall': 'visitortable' },
		},
		columns: [
			{ 'data': 'id' },
			{ 'data': 'name' },
			{ 'data': 'id_no' },
			{ 'data': 'pic_name' },
			{ 'data': 'purpose' },
			{ 'data': 'check_in_time' },
			{ 'data': 'check_in_date' },
		]
	});




	//Display Add Visitor Modal
	$('#addvisitorrecord').click(function(){
		$('#recordModal').modal('show');
		$('#recordForm')[0].reset();
		$('#checkouttime').removeAttr('required');
		$('#checkoutdate').removeAttr('required');
		$('.modal-title').html("Add Record");
		$('#action').val('addVisitorRecord');
		$('#save').val('Add');
	});
	
	// Update/Edit Table
	$("#visitorTable").on('click', '.update', function(){
		var id = $(this).attr("id");
		var ajaxcall = 'getvisitortable';
	
		$.ajax({
			url:"..//..//..//ajax//ajax.php",
			method:"POST",
			data:{ajaxcall:ajaxcall, id:id},
			dataType:"json",
			success:function(record){
				//alert(JSON.stringify(record[0].id));
				$('#recordModal').modal('show');
				$('#id').val(record[0].id);
				$('#name').val(record[0].name);
				$('#ic_no').val(record[0].id_no);
				$('#pic').val(record[0].pic);				
				$('#purpose').val(record[0].purpose);
				$('#checkintime').val(record[0].checkintime);
				$('#checkindate').val(record[0].checkindate);
				$('#checkouttime').val(record[0].checkouttime);
				$('#checkoutdate').val(record[0].checkoutdate);
				$('.modal-title').html("Edit Records");
				$('#action').val('updateVisitorRecord');
				$('#save').val('Save');
			}
		})
	
	});

	//Submit
	$("#recordModal").on('submit','#recordForm', function(event){
		event.preventDefault();
		$('#save').attr('disabled','disabled');
		var formData = $(this).serialize();
		alert(formData);
		$.ajax({
			url:"..//..//..//statistic//ajax.php",
			method:"POST",
			data:formData,
			success:function(data){	
				//alert(data);			
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
	$("#visitorTable").on('click', '.delete', function(){
		var id = $(this).attr("id");		
		var ajaxcall = "deleteVisitorRecord";
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
		var CSV = exportTableToCSV('Visitor List.csv');
		window.navigator.msSaveBlob(CSV, 'Visitor List.csv'); 
		
		});
});

/*
$.ajax({
        url: "http://localhost/fyp/statistic/ajax.php",
        type: "post",
        data: { 'ajaxcall': 'visitortable' },
        success: function (visitortabledata) {			
            $('#visitorTable').DataTable({
                data: visitortabledata,				// Get the data object
                columns: [
                    { 'data': 'id' },
                    { 'data': 'name' },
                    { 'data': 'id_no' },
                    { 'data': 'pic_name' },
                    { 'data': 'purpose' },
                    { 'data': 'check_in_time' },
                    { 'data': 'check_in_date' },
					{ 'data': 'check_out_time' },
                    { 'data': 'check_out_date' },
                ]
				
            });
        }
    });

*/