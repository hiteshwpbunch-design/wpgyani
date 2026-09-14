jQuery(document).ready(function($) {
	
	// Handle Git Pull
	$('#wpgc-btn-pull').on('click', function(e) {
		e.preventDefault();
		if (!confirm('Are you sure you want to pull from the remote repository? This might overwrite local changes.')) {
			return;
		}

		var $btn = $(this);
		$btn.addClass('wpgc-loading').prop('disabled', true);
		
		$.ajax({
			url: wpGitConnect.apiUrl + '/pull',
			method: 'POST',
			beforeSend: function ( xhr ) {
				xhr.setRequestHeader( 'X-WP-Nonce', wpGitConnect.nonce );
			},
			success: function(response) {
				alert(response.message || 'Pull successful.');
				location.reload();
			},
			error: function(xhr) {
				var msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'An error occurred.';
				alert('Error: ' + msg);
			},
			complete: function() {
				$btn.removeClass('wpgc-loading').prop('disabled', false);
			}
		});
	});

	// Handle Git Push/Commit
	$('#wpgc-form-commit').on('submit', function(e) {
		e.preventDefault();
		
		var message = $('#wpgc-commit-message').val();
		var files = [];
		$('.wpgc-file-checkbox:checked').each(function() {
			files.push($(this).val());
		});

		if (files.length === 0) {
			alert('Please select at least one file to commit.');
			return;
		}

		if (!message) {
			alert('Please enter a commit message.');
			return;
		}

		var $btn = $('#wpgc-btn-commit');
		$btn.addClass('wpgc-loading').prop('disabled', true);

		$.ajax({
			url: wpGitConnect.apiUrl + '/push',
			method: 'POST',
			beforeSend: function ( xhr ) {
				xhr.setRequestHeader( 'X-WP-Nonce', wpGitConnect.nonce );
			},
			data: JSON.stringify({ message: message, files: files }),
			contentType: 'application/json',
			success: function(response) {
				alert(response.message || 'Commit and Push successful.');
				location.reload();
			},
			error: function(xhr) {
				var msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'An error occurred.';
				alert('Error: ' + msg);
			},
			complete: function() {
				$btn.removeClass('wpgc-loading').prop('disabled', false);
			}
		});
	});

	// Handle DB Export
	$('#wpgc-btn-db-export').on('click', function(e) {
		e.preventDefault();
		
		var $btn = $(this);
		$btn.addClass('wpgc-loading').prop('disabled', true);
		
		$.ajax({
			url: wpGitConnect.apiUrl + '/db-export',
			method: 'POST',
			beforeSend: function ( xhr ) {
				xhr.setRequestHeader( 'X-WP-Nonce', wpGitConnect.nonce );
			},
			success: function(response) {
				alert(response.message || 'Database exported successfully.');
				location.reload();
			},
			error: function(xhr) {
				var msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'An error occurred.';
				alert('Error: ' + msg);
			},
			complete: function() {
				$btn.removeClass('wpgc-loading').prop('disabled', false);
			}
		});
	});

	// Handle DB Import
	$('#wpgc-btn-db-import').on('click', function(e) {
		e.preventDefault();
		if (!confirm('WARNING: This will overwrite your current WordPress database with the database.sql file. This is highly destructive! Are you completely sure?')) {
			return;
		}

		var $btn = $(this);
		$btn.addClass('wpgc-loading').prop('disabled', true);
		
		$.ajax({
			url: wpGitConnect.apiUrl + '/db-import',
			method: 'POST',
			beforeSend: function ( xhr ) {
				xhr.setRequestHeader( 'X-WP-Nonce', wpGitConnect.nonce );
			},
			success: function(response) {
				alert(response.message || 'Database imported successfully.');
				location.reload();
			},
			error: function(xhr) {
				var msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'An error occurred.';
				alert('Error: ' + msg);
			},
			complete: function() {
				$btn.removeClass('wpgc-loading').prop('disabled', false);
			}
		});
	});

});
