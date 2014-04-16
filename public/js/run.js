var Test = {

	params: {},

	number: 10,

	queue: 10,

	results: {
		time: [],
		memory: []
	},

	generateCache: false,

	excludeOutliers: false,

	reset: function() {
		$('#results').removeClass('hidden');
		$('tbody, tfoot', '#results').html('');
		this.results.time = [];
		this.results.memory = [];
		this.params = {};
		this.generateCache = false;
		this.exludeOutliers = false;
	},

	run: function(params) {

		this.reset();

		this.params = params;
		this.params._time = (+new Date);

		this.generateCache = this.params.cache === '1';

		this.excludeOutliers = this.params.outliers === '1';
		delete this.params.outliers;

		var number = parseInt(params.number, 10);
		this.number = number;
		this.queue = number;
		delete params.number;

		this.test();

	},

	test: function() {

		var row;

		if (!this.generateCache) {
			var testNum = this.number - this.queue + 1;
			row = $('<tr><td class="num">#' + testNum + '</td><td class="time">Running...</td><td class="memory"></td></tr>');
			$('tbody', '#results').append(row);
		}
		else {
			row = $('<tr><td colspan="2">Generating cache...</td></tr>');
			$('tbody', '#results').append(row);
		}

		var _this = this;

		$.getJSON('run.php', this.params, function(result) {

			var time = result.time;
			var memory = result.memory;

			if (_this.generateCache) {

				row.remove();

				_this.generateCache = false;

				_this.test();

			}
			else {

				_this.results.time.push(time);
				_this.results.memory.push(memory);

				$('.time', row).text(time);
				$('.memory', row).text(memory);

				_this.queue--;
				if (_this.queue > 0) {
					_this.test();
				}
				else {
					_this.processResults();
				}

			}

		});

	},

	processResults: function() {

		var outliers = 0;
		if (this.excludeOutliers && this.number >= 3) {
			outliers = Math.floor(this.number * 0.1);
			if (outliers === 0) {
				outliers = 1;
			}
		}

		this.results.time.sort();
		this.results.memory.sort();

		var number = this.number;

		for (var i=0; i<outliers; i++) {
			console.log('Excluding high time ', this.results.time.pop());
			console.log('Excluding low time ', this.results.time.shift());
			console.log('Excluding high memory ', this.results.memory.pop());
			console.log('Excluding low memory ', this.results.memory.shift());
			number -= 2;
		}

		var totalTime = 0;
		var totalMemory = 0;
		for (var i=0; i<number; i++) {
			totalTime += this.results.time[i];
			totalMemory += this.results.memory[i];
		}

		var averageTime = totalTime / number;
		var averageMemory = totalMemory / number;

		console.log(number);

		$('tfoot', '#results').html('<tr><th>Average Results</th><th>' + averageTime + ' seconds</th><th>' + averageMemory + '</th></tr>');

	}

};

$(function() {

	$('#form').on('submit', function(e) {
		e.preventDefault();

		var formVals = $(this).serialize().split('&');
		var params = {};

		for (var i=0; i<formVals.length; i++) {
			var parts = formVals[i].split('=');
			params[parts[0]] = parts[1];
		}

		Test.run(params);

	});

});