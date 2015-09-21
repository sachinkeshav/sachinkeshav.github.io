/*
CSE 190, Homework 4 (NerdLuv)
This script is to help the TAs grade HW4 by auto-filling out the student's form.
Students don't need to examine or modify it.
*/

(function() {
	parseQueryParams();

	// fix param names, e.g. __name -> name
	for (var key in $_REQUEST) {
		if (key.match(/^__/)) {
			var newkey = key.replace(/^__/, '');
			$_REQUEST[newkey] = $_REQUEST[key];
		}
	}

	if (window.addEventListener) {
		window.addEventListener('load', windowLoad, false);
	}

	function windowLoad() {
		if (typeof($_REQUEST['grading']) === 'undefined' || $_REQUEST['grading'] === '0' || $_REQUEST['grading'] === 'false') {
			return;
		}
		populateForm();
		geluso_main();
	}

	function populateForm() {
		// abort if not grading (if we haven't passed >= 8 special query params)
		var requiredParams = ['name', 'age', 'ptype', 'min', 'max', 'gender', 'os'];
		for (var i = 0; i < requiredParams.length; i++) {
			if (typeof($_REQUEST[requiredParams[i]]) === 'undefined') {
				return;
			}
		}

		var textboxes = $("input[type='text']");

		// patch: also grab inputs with no type  (no type -> type=text)
		$('input').each(function(idx) {
			if (!$(this).attr('type') || ($(this).attr('type') == 'text'
					&& textboxes.get().indexOf($(this)) < 0)) {
				textboxes.push($(this));
			}
		});

		if (textboxes.length >= 5) {
			$(textboxes[0]).attr('value', $_REQUEST['name']);
			$(textboxes[1]).attr('value', $_REQUEST['age']);
			//You shouldn't need to change for anyone.
			//Just be yourself.
			$(textboxes[2]).attr('value', $_REQUEST['ptype']);
			$(textboxes[3]).attr('value', $_REQUEST['min']);
			$(textboxes[4]).attr('value', $_REQUEST['max']);
		}

		//If only sex changes were this easy
		var radioButtons = $("input[type='radio']");
		if (radioButtons.length >= 2) {
			$(radioButtons[0]).attr('checked', $_REQUEST['gender'] == 'M');
			$(radioButtons[1]).attr('checked', $_REQUEST['gender'] == 'F');
		}

		var options = $('option');
		if (options.length >= 3) {
			options.each(function(idx) {
				$(this).attr('selected', $_REQUEST['os'] == $.trim(options[idx].innerHTML));
			});
		}

		var checkboxes = $("input[type='checkbox']");
		if (checkboxes.length >= 2) {
			$(checkboxes[0]).attr('checked', $_REQUEST['seeking'].match(/M/));
			$(checkboxes[1]).attr('checked', $_REQUEST['seeking'].match(/F/));
		}
		$('form').submit();
	}


	/* BEGIN STEVE GELUSO GRADING TESTS SCRIPT */
	var REGULAR = [];
	var EXTRA = [];
	var SUITE = REGULAR;

	REGULAR['Bjarne Stroustroup'] = ['Leia Organa', 'Mary Lou Jepsen', 'Roberta Williams', 'Sarah Connor'];
	EXTRA['Bjarne Stroustroup'] = ['Leia Organa', 'Mary Lou Jepsen', 'Roberta Williams', 'Sarah Connor'];

	REGULAR['Lara Croft'] = ['Anakin Skywalker', 'Nostalgia Critic'];
	EXTRA['Lara Croft'] = ['Anakin Skywalker', 'Leeloo', 'Nostalgia Critic', 'River Tam'];

	REGULAR['Leeloo'] = ['Anakin Skywalker','Edsger Dijkstra','James Gosling','Nostalgia Critic','Rasmus Lerdorf'];
	EXTRA['Leeloo'] = ['Anakin Skywalker','Edsger Dijkstra','James Gosling','Lara Croft','Nostalgia Critic','Rasmus Lerdorf','River Tam'];

	REGULAR['Nostalgia Critic'] = ['Ellen Ripley', 'Lara Croft', 'Leeloo', 'Marissa Mayer'];
	EXTRA['Nostalgia Critic'] = ['Anakin Skywalker', 'Lara Croft', 'Leeloo', 'Marissa Mayer', 'Rasmus Lerdorf'];

	REGULAR['Stewie Griffin'] = [];
	EXTRA['Stewie Griffin'] = ['Angry Video Game Nerd'];

	REGULAR['Stephen Colbert'] = ['Barbara Liskov','Dana Scully','Deanna Troi'];
	EXTRA['Stephen Colbert'] = ['Alan Turing','Barbara Liskov','Dana Scully','Deanna Troi','Vint Cerf'];

	REGULAR['Kate Austen'] = ['Anakin Skywalker','Marty Stepp','Nostalgia Critic','Rasmus Lerdorf'];
	EXTRA['Kate Austen'] = ['Anakin Skywalker','Lara Croft','Marty Stepp','Nostalgia Critic','Rasmus Lerdorf'];

	// Adds the result of a test to the table of test results.
	// Results are highlighted in green if the actual result matches
	// the given expected result.
	function add_row(test_name, expected, actual, th) {
		var result = expected === actual;
		var celltag = th ? th : 'td';

		// Create a row and color it depending on the result of the comparison.
		var row = $('<tr>');
		row.css('color', result ? 'green' : 'red');

		var test_name_cell = $('<' + celltag + '>');
		test_name_cell.text(test_name);
		row.append(test_name_cell);

		var expected_cell = $('<' + celltag + '>');
		expected_cell.text(expected);
		row.append(expected_cell);

		var actual_cell = $('<' + celltag + '>');
		actual_cell.text(actual);
		row.append(actual_cell);

		$('#results').append(row);
	}

	// Runs all ye tests.
	function run_tests() {
		clear_results();

		// Select which set of results to compare output to.
		SUITE = $('#regular').attr('checked') ? REGULAR : EXTRA;

		// Try to obtain the username.
		var page_text= $(document.body).text();
		console.log(page_text.match('Matches for (.*)?\n'));
		var user = $.trim(page_text.match('Matches for (.*)?\n')[1]);

		// Obtain the matches and compare
		// var matches = document.getElementsByClassName('match');
		var matches = $('.match p');

		var expected_length = SUITE[user].length;
		var actual_length = matches.length;

		// Tests to see if the number of matches is correct.
		add_row('length', expected_length, actual_length);

		// Tests to see if the order of the matches is correct.
		for (var i = 0; i < Math.max(expected_length, actual_length); i++) {
			var expected_match = SUITE[user][i];
			var actual_match = matches[i];
			if (actual_match) {
				// actual_match = matches[i].getElementsByTagName('p')[0];
				// actual_match = actual_match.textContent.trim();
				actual_match = (actual_match.textContent || actual_match.innerText).trim();
			}
			add_row('match', expected_match, actual_match);
		}
	}

	// Remove all but the first row in the table of test results.
	// The first row contains the titles for each column.
	function clear_results() {
		var rows = $('tr:not(:first-child)').remove();
	}

	// Initializes the area where results are reported.
	function create_results() {
		var test_results = $('<div>')
			.attr('id', 'tests')
			.css({
				'border': '1px solid gray',
				'position': 'fixed',
				'top': '5px',
				'right': '5px',
				'width': 'inherit'
			});

		var regular_label = $('<label>');
		regular_label.append($('<input>')
				.attr({
					'id': 'regular',
					'type': 'radio',
					'name': 'suite',
					'value': 'regular',
					'checked': ''
				})
			).append('Regular Output')
			.click(run_tests);

		var extra_label = $('<label>');
		extra_label.append($('<input>')
				.attr({
					'type': 'radio',
					'name': 'suite',
					'value': 'extra'
				})
			).append('Extra-credit output')
			.click(run_tests);

		test_results.append(regular_label);
		test_results.append(extra_label);

		var table = $('<table>')
			.attr({
				'id': 'results',
				'border': '1'
			}).css('border-collapse', 'collapse');

		test_results.append(table);
		$(document.body).append(test_results);

		add_row('Test', 'Expected', 'Actual', 'th');
		// Turnt the color back to black.
		$('tr').first().css('color', 'black');
	}

	function geluso_main() {
		create_results();
		run_tests();
	}

	// returns the page's query string as a hash.
	// Also sets up global hashes named $_REQUEST and $_GET.
	// $_REQUEST['name'] -> value of 'name' query param
	function parseQueryParams() {
		$_GET = $_REQUEST = {};   // PHP-like global var name
		var hash = $_REQUEST;

		if (location.search && location.search.length >= 1) {
			var url = window.location.search.substring(1);
			var chunks = url.split(/&/);
			for (var i = 0; i < chunks.length; i++) {
				var keyValue = chunks[i].split(/=/);
				if (keyValue[0] && keyValue[1]) {
					var thisValue = unescape(keyValue[1]);
					thisValue = thisValue.replace(/[+]/g, ' ');  // unescape URL spaces
					hash[keyValue[0]] = thisValue;
				}
			}
		}

		return hash;
	}
})();





