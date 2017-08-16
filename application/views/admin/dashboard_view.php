<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script>
	(function(w,d,s,g,js,fs){
		g=w.gapi||(w.gapi={});g.analytics={q:[],ready:function(f){this.q.push(f);}};
		js=d.createElement(s);fs=d.getElementsByTagName(s)[0];
		js.src='https://apis.google.com/js/platform.js';
		fs.parentNode.insertBefore(js,fs);js.onload=function(){g.load('analytics');};
	}(window,document,'script'));
</script>
<div class="row">
	<div class="card-panel white col s12 l7">
		<h5 style="margin: .7em 0 1em 0" class="red-text text-darken-4">Update Site Information</h5>
		<?php if( $site_data != '' ): foreach($site_data as $site): ?>
			<?php echo form_open('admin/dashboard');?>
			
			<div class="input-field"><label>Site Title</label>
				<input type="text" name="title" value="<?php echo $site->title ?>" required>
			</div>
			
			<div class="input-field"><label>Site Keywords</label>
				<textarea rows="36" cols="52%" name="keywords"  class="materialize-textarea" id="textarea" required><?php echo $site->keywords ?></textarea>
			</div>

			<div class="input-field">
				<label>Site Description</label>
				<textarea rows="36" cols="52%" name="description" class="materialize-textarea" id="textarea" required><?php echo $site->description ?></textarea>
			</div>
			
				<input type="submit" value="Submit" class="waves-effect waves-light btn red darken-4"/>
				<input type="reset" value="Reset" class="waves-effect waves-light btn red darken-4"/>	
		</form>
		<?php endforeach;endif; ?><br>
	</div>

	<div class="card-panel white col s12 l4 offset-l1" style="margin-left: 1em">

		<script type="text/javascript" src="http://hellolittlered.disqus.com/combination_widget.js?num_items=3&hide_mods=0&color=white&default_tab=recent&excerpt_length=30"></script>
	</div>
	</div>

	<div class="card-panel white lighten-5">
		<div id="embed-api-auth-container"></div>
		<div id="chart-container"></div>
		<div id="view-selector-container"></div>
	</div>



<script>

	gapi.analytics.ready(function() {

			  /**
			   * Authorize the user immediately if the user has already granted access.
			   * If no access has been created, render an authorize button inside the
			   * element with the ID "embed-api-auth-container".
			   */
			   gapi.analytics.auth.authorize({
			   	container: 'embed-api-auth-container',
			   	clientid: '109380645046-g42iprog6s7203duj8sjth5es48e4r40.apps.googleusercontent.com'
			   });


			  /**
			   * Create a new ViewSelector instance to be rendered inside of an
			   * element with the id "view-selector-container".
			   */
			   var viewSelector = new gapi.analytics.ViewSelector({
			   	container: 'view-selector-container'
			   });

			  // Render the view selector to the page.
			  viewSelector.execute();


			  /**
			   * Create a new DataChart instance with the given query parameters
			   * and Google chart options. It will be rendered inside an element
			   * with the id "chart-container".
			   */
			   var dataChart = new gapi.analytics.googleCharts.DataChart({
			   	query: {
			   		metrics: 'ga:sessions',
			   		dimensions: 'ga:date',
			   		'start-date': '30daysAgo',
			   		'end-date': 'yesterday'
			   	},
			   	chart: {
			   		container: 'chart-container',
			   		type: 'LINE',
			   		options: {
			   			width: '100%'
			   		}
			   	}
			   });


			  /**
			   * Render the dataChart on the page whenever a new view is selected.
			   */
			   viewSelector.on('change', function(ids) {
			   	dataChart.set({query: {ids: ids}}).execute();
			   });

			});
		</script>